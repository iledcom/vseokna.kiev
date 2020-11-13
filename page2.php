<?php

try {
  $db = new PDO('mysql:host=localhost; dbname=test_db', 'root', '');
} catch (PDOException $e) {
  print "Can't connect: " . $e->getMessage();
  exit();
}
// установить исключения при ошибках в базе данных
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$art_id = 36;
// Сначала заключить переданное на обработку значение в кавычки
$art_id = $db->quote($art_id);

// После санобработки значение переменной $dish может
// быть вставлено в запрос SQL

$q = $db->query("SELECT art_id, cat, title, description, art_text, art_date, metatitle, metadesc, metakeys, slug FROM article WHERE art_id = $art_id");
while ($row = $q->fetch()) {

  $cat = $row[cat];
  $title = $row[title];
  $description = $row[description];
  $art_text = $row[art_text];
  $art_date = $row[art_date];
  $metatitle = $row[metatitle];
  $metadesc = $row[metadesc];
  $metakeys = $row[metakeys];
  $slug = $row[slug];
}

//В данном коде в качестве сокращенного способа отображения результатов вызовов
//различных методов применяется короткий эхо-дескриптор (<?= ).
// Начало блока кода РНР с короткого эхо-дескриптора <?= равнозначно его началу
//с дескриптора <php echo. Это удобно для HTML-разметки формы, поскольку различные
//методы из класса FormHelper возвращают HTML-разметку, которая должна быть отображена.

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?=$title?></title>
  <meta name="description" content="<?=$metadesc?>">
  <meta name="Keywords" content="<?=$metakeys?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <link href="css/landing.css" rel="stylesheet">
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index.html" target="_self">
          <strong class="blue-text">Vseokna</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto smooth-scroll">
            <li class="nav-item">
              <a href="#intro" class="nav-link waves-effect waves-light">Home</a>
            </li>
            <li class="nav-item">
              <a href="#profile" class="nav-link waves-effect waves-light">Профиль</a>
            </li>
            <li class="nav-item">
              <a href="#fittings" class="nav-link waves-effect waves-light">Фурнитура</a>
            </li>
            <li class="nav-item">
              <a href="#examples" class="nav-link waves-effect waves-light">Виды изделий</a>
            </li>
            <li class="nav-item">
              <a href="#gallery" class="nav-link waves-effect waves-light">News</a>
            </li>
            <li class="nav-item">
              <a href="#contact" class="nav-link waves-effect waves-light">Support</a>
            </li>
          </ul>

          <!-- Right -->
         <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a href="#" class="nav-link waves-effect waves-light">
              <i class="fas fa-car-side"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link waves-effect waves-light">
              <i class="fas fa-lightbulb"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link waves-effect waves-light">
              <i class="fas fa-book"></i>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link waves-effect waves-light float-left">
              <i class="fas fa-phone"> (044)232-90-20</i>
            </a>
            <a href="#" class="nav-link waves-effect waves-light">
              <i class="fa fa-mobile"> (067)408-16-14</i>
            </a>
          </li>
        </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-5 pt-5">
    <div class="container">

      <!--Section: Post-->
      <section class="mt-4">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-md-8 mb-4">

            <!--Featured Image-->
            <div class="card mb-4 wow fadeIn">

              <img src="/img/article/article-rehau.png" class="img-fluid" alt="">

            </div>
            <!--/.Featured Image-->

            <!--Card-->
            <div class="card mb-4 wow fadeIn">

              <!--Card content-->
              <div class="card-body justify">

              <?=$art_text?>

              </div>

            </div>
            <!--/.Card-->

            <!--Card-->
            <div class="card mb-4 wow fadeIn">

              <div class="card-header font-weight-bold">
                <span>About author</span>
                <span class="pull-right">
                  <a href="">
                    <i class="fab fa-facebook-f mr-2"></i>
                  </a>
                  <a href="">
                    <i class="fab fa-twitter mr-2"></i>
                  </a>
                  <a href="">
                    <i class="fab fa-instagram mr-2"></i>
                  </a>
                  <a href="">
                    <i class="fab fa-linkedin-in mr-2"></i>
                  </a>
                </span>
              </div>

              <!--Card content-->
              <div class="card-body">

                <div class="media d-block d-md-flex mt-3">
                  <img class="d-flex mb-3 mx-auto z-depth-1" src="https://mdbootstrap.com/img/Photos/Avatars/img (30).jpg"
                    alt="Generic placeholder image" style="width: 100px;">
                  <div class="media-body text-center text-md-left ml-md-3 ml-0">
                    <h5 class="mt-0 font-weight-bold">Caroline Horwitz
                    </h5>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti
                    quos dolores et quas molestias excepturi sint occaecati cupiditate non provident,
                    similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum
                    fuga.
                  </div>
                </div>

              </div>

            </div>
            <!--/.Card-->
            
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-4 mb-4">

            <!--Card: Jumbotron-->
            <div class="card blue-gradient mb-4 wow fadeIn">

              <!-- Content -->
              <div class="card-body text-white text-center">

                <h4 class="mb-4">
                  <strong>Learn Bootstrap 4 with MDB</strong>
                </h4>
                <p>
                  <strong>Best & free guide of responsive web design</strong>
                </p>
                <p class="mb-4">
                  <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video
                    and written versions available. Create your own, stunning website.</strong>
                </p>
                <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-outline-white btn-md">Start
                  free tutorial
                  <i class="fas fa-graduation-cap ml-2"></i>
                </a>

              </div>
              <!-- Content -->
            </div>
            <!--Card: Jumbotron-->

            <!--Card : Dynamic content wrapper-->
            <div class="card mb-4 text-center wow fadeIn">

              <div class="card-header">Хотите получать информацию о новых статьях?</div>

              <!--Card content-->
              <div class="card-body">

                <!-- Default form login -->
                <form>

                  <!-- Default input email -->
                  <label for="defaultFormEmailEx" class="grey-text">Ваш email</label>
                  <input type="email" id="defaultFormLoginEmailEx" class="form-control">

                  <br>

                  <!-- Default input password -->
                  <label for="defaultFormNameEx" class="grey-text">Ваше имя</label>
                  <input type="text" id="defaultFormNameEx" class="form-control">

                  <div class="text-center mt-4">
                    <button class="btn btn-info btn-md" type="submit">Оформить подписку</button>
                  </div>
                </form>
                <!-- Default form login -->

              </div>

            </div>
            <!--/.Card : Dynamic content wrapper-->

            <!--Card-->
            <div class="card mb-4 wow fadeIn">

              <div class="card-header">Related articles</div>

              <!--Card content-->
              <div class="card-body">

                <ul class="list-unstyled">
                  <li class="media">
                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder7.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                      <a href="">
                        <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                      </a>
                      Cras sit amet nibh libero, in gravida nulla (...)
                    </div>
                  </li>
                  <li class="media my-4">
                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder6.jpg" alt="An image">
                    <div class="media-body">
                      <a href="">
                        <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                      </a>
                      Cras sit amet nibh libero, in gravida nulla (...)
                    </div>
                  </li>
                  <li class="media">
                    <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder5.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                      <a href="">
                        <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                      </a>
                      Cras sit amet nibh libero, in gravida nulla (...)
                    </div>
                  </li>
                </ul>

              </div>

            </div>
            <!--/.Card-->

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
          <div class="col-lg-5 col-md-6 text-center text-md-left mb-4 mb-0">
            <h6 class="mb-0 white-text">Get connected with us on social networks!</h6>
          </div>
          <div class="col-lg-7 col-md-6 text-center text-md-right">
            <a href="#" class="fb-ic ml-0">
              <i class="fab fa-facebook-f white-text mr-4"></i>
            </a>
            <a href="#" class="fb-ic ml-0">
              <i class="fab fa-twitter white-text mr-4"></i>
            </a>
            <a href="#" class="fb-ic ml-0">
              <i class="fab fa-vk white-text mr-4"></i>
            </a>
            <a href="#" class="fb-ic ml-0">
              <i class="fab fa-instagram white-text mr-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5 mb-4 text-center text-md-left">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
          <h6 class="text-uppercase font-weight-bold"><strong>Our Company</strong></h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis ipsam esse voluptatibus sequi!</p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase font-weight-bold"><strong>Products</strong></h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p><a href="#">MDBootstrap</a></p>
          <p><a href="#">MDBootstrap</a></p>
          <p><a href="#">MDBootstrap</a></p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase font-weight-bold"><strong>Links</strong></h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p><a href="#">Account</a></p>
          <p><a href="#">Help</a></p>
          <p><a href="#">MDBootstrap</a></p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3">
          <h6 class="text-uppercase font-weight-bold"><strong>Contacts</strong></h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
            <p><i class="fa fa-home mr-3"></i> Киев</p>
            <p><i class="fa fa-envelope mr-3"></i> office@vseokna.kiev.ua</p>
            <p><i class="fa fa-phone mr-3"></i> (044)232-90-20</p>
            <p><i class="fa fa-mobile mr-3"></i> (067)408-16-14</p>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->

  <script type="text/javascript" src="js/common.js"></script>

</body>

</html>
