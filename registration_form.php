<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Regidtration form</title>
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

          	<p class="h5 my-4">Форма регистрации пользователей </p>

          	<form name="reg_form" id="reg_form" method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
							<table>
								<?php if ($errors) { ?>
								<tr>
									<td>You need to correct the following errors:</td>
									<td>
										<ul>
											<?php foreach ($errors as $error) { ?>
											<li><?= $form->encode($error) ?></li>
											<?php } ?>
										</ul>
									</td>
								<?php } ?>
								<tr>
									<td>Укажите Ваш логин:</td>
									<td><?= $form->input('text', ['name' => 'user_login'], 36) ?></td>
								</tr>

								<tr>
									<td>Придумайте свой пароль:</td>
									<td><?= $form->input('password', ['name' => 'user_password'], 36) ?></td>
								</tr>

								<tr>
									<td>Укажите Ваше Имя:</td>
									<td><?= $form->input('text', ['name' => 'user_name'], 36) ?></td>
								</tr>

								<tr>
									<td>Укажите Вашe Фамилию:</td>
									<td><?= $form->input('text', ['name' => 'user_surname'], 36) ?></td>
								</tr>

								<tr>
									<td>Укажите Ваш номер телефона:</td>
									<td><?= $form->input('tel', ['name' => 'user_phone'], 36) ?></td>
								</tr>

								<tr>
									<td>Укажите Вашу дату рождения :</td>
									<td><?= $form->input('text', ['name' => 'dob'], 36) ?></td>
								</tr>

								<tr>
									<td>Укажите удобный для Вас адрес доставки:</td>
									<td><?= $form->textarea(['name' => 'delivery_address'], 80, 3, 255) ?></td>
								</tr>
								
								<tr>
									<td colspan="2" align="center"><?= $form->input('submit',['name' => 'save', 'value' => 'Сохранить']) ?></td>
								</tr>
							</table>
						</form>

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
	    $( "#reg_form" ).submit(function( event ) {
	    	$("#reg_form")[0].reset();
			  alert( "Данные отправлены на сервер" );
			  event.preventDefault();
			});

		});
	</script>
 -->
</body>

</html>



