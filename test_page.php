<?php
date_default_timezone_set('Europe/Kiev');
define('CLASS_DIR', $_SERVER['DOCUMENT_ROOT'] . '/classes/');

 
spl_autoload_register(function($class) {
  $string = explode('\\', $class);
  $last = array_pop($string);
  $fn = $last . '.php';
  $fn = CLASS_DIR . str_replace('\\', '/', $fn);
  if (file_exists($fn)) require $fn; 
}, $throw = true);


// подключиться к базе данных
$db = \Classes\DataBase::connect();


	$post = $_POST;
	$form = new \Classes\FormHelper();
	$validate = new \Classes\Validate($db);


abstract class Select {
  private $table;
  private $params = [];

  public function select($table, $params, $valid_inputs){
    $sql = 'SELECT cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE art_id = ?';
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array($valid_inputs['art_id']));
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if (! $result) {
      $errors[] = 'Please enter the correct title of the article.';
      return $errors;
    } else {
      return $result; 
    }
  }


  public function from($table_name, $fields) {
    $from = "";
    if ($fields == "*") $from = "*";
    else {
      for ($i = 0; $i < count($fields); $i++) {
        if (($pos_1 = strpos($fields[$i], "(")) !== false) {
          $pos_2 = strpos($fields[$i], ")");
          $from .= substr($fields[$i], 0, $pos_1)."(".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."),";
        }
        else $from .= "".$fields[$i].",";
      }
      $from = substr($from, 0, -1);
    }
    $from .= " FROM $table_name`";
    $this->from = $from;
    return $this;
  }

  public function where($where, $values = array(), $and = true) {
    if ($where) {
      $where = $this->db->getQuery($where, $values);
      $this->addWhere($where, $and);
    }
    return $this;
  }


}


function from($table_name, $fields) {
    $from = "";
    if ($fields == "*") $from = "*";
    else {
      for ($i = 0; $i < count($fields); $i++) {
        if (($pos_1 = strpos($fields[$i], "(")) !== false) {
          $pos_2 = strpos($fields[$i], ")");
          $from .= substr($fields[$i], 0, $pos_1)."(".substr($fields[$i], $pos_1 + 1, $pos_2 - $pos_1 - 1)."),";
        }
        else $from .= $fields[$i].",";
      }
      $from = substr($from, 0, -1);
    }
    $from .= " FROM $table_name";
    //$this->from = $from;
    //return $this;
    return $from;
  }



  function getQuery($query, $params) {
		if ($params) {
			$offset = 0;
			$sq = "?";
			$len_sq = strlen($sq); 

			for ($i = 0; $i < count($params); $i++) {
				$pos = strpos($query, $sq, $offset);
				if (is_null($params[$i])) $arg = "NULL";
				else $arg = "'".$params[$i]."'";
				$query = substr_replace($query, $arg, $pos, $len_sq);
				$offset = $pos + strlen($arg);
			}
		}
		return $query;
	}

	function where($where, $values = array(), $and = true) {
		if ($where) {
			$where = getQuery($where, $values);
			$this->addWhere($where, $and);
		}
		return $this;
	}

$table_name = 'article';
$fields = ['cat', 'title', 'slug'];

  function query(){
  	$db = $GLOBALS['db'];
  	$table_name = 'article';
		$fields = ['cat', 'title', 'slug'];
  	$select = from($table_name, $fields);
  	$where = "art_id";
  	$where .="=?";

    $sql = "SELECT "; 
    $sql .= "$select ";
    $sql .= "WHERE ";
    $sql .= $where;
    $stmt = $db->prepare($sql);  // использовать вместо переменной $db переменную $pdo ?
    $stmt->execute(array(36));
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if (! $result) {
      $errors[] = 'Please enter the correct title of the article.';
      return $errors;
    } else {
      return $result; 
    }
  }

  function addWhere($where, $and = false) {
		if ($where) {
			$where .= "=?";
			if ($and) $where .= " AND ";
			else $where .= " OR ";
			$where .= $where;
		}
		else $where = "WHERE $where";
		return $where;
	}

print from($table_name, $fields);

print "<br>";

//$query = 'query';
//$params = array('params1', 'params2', 'params3');

//print getQuery($query, $params);
//print "<br>";
//print_r (query());
//print "<br>";

//$where = "art_id";
//print addWhere($where);



  ?>