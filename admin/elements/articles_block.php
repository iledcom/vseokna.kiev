<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>editing fom</title>
  <meta name="description" content="">
  <meta name="Keywords" content="">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/style.min.css" rel="stylesheet">
  <link href="../css/landing.css" rel="stylesheet">
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>
	</header>
	<main class="mt-5 pt-5">
    <div class="container">
    	<section class="mt-4">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-md-12 mb-4">
            <?php
            if($articles) {
                foreach ($articles as $article) {
                  $art_id = $article['art_id'];
                  $cat = $article['cat'];
                  $title = $article['title'];
                  $description = $article['description'];
                  $art_text = $article['art_text'];
                  $art_date = $article['art_date'];
                  $metatitle = $article['metatitle'];
                  $metadesc = $article['metadesc'];
                  $metakeys = $article['metakeys'];
                  $slug = $article['slug'];
                  ?>
                <table cellspacing="2" border="1" cellpadding="5" width="1200" cols="8" rules="all">
                  <tr>
                    <td width="5%"><?php print $art_id?></td>
                    <td width="5%"><?php print $cat?></td>
                    <td width="10%"><?php print $title?></td>
                    <td width="30%"><?php print $description?></td>
                    <td width="10%"><?php print $art_date?></td>
                    <td width="5%">
                      <form name="edit_form" id="edit_form" method="POST" action="articleEdit.php">
                        <?= $form->input('hidden', ['name' => 'art_id', 'value' => $art_id]) ?>
                        <?= $form->input('submit', ['name' => 'edit', 'value' => 'Редактировать']) ?>
                      </form>
                    </td>
                  </tr>
                </table>
                <?php }

              
              } ?>
            

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Post-->

    </div>
  </main>
    <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer font-small unique-color-dark pt-0">
    <div class="primary-color">
      <div class="container">
        <div class="row py-4 d-flex align-items-center">

      </div>
    </div>
  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="../js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <!-- Initializations -->

  <script type="text/javascript" src="../js/common.js"></script>
<!-- 
  <script type="text/javascript">
		$(document).ready(function() { 
	    $( "#editing_form" ).submit(function( event ) {
	    	$("#editing_form")[0].reset();
			  alert( "Данные отправлены на сервер" );
			  event.preventDefault();
			});

		});
	</script>
-->
</body>

</html>



