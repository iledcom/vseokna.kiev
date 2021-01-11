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

  <script src='https://cdn.tiny.cloud/1/k73imt48sc2285ng0hmll7d33k6lcdg6hda5nzqvgff42sd3/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>
  <script>
    tinymce.init({
      selector: '#art_text'
    });
  </script>
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

          	<form name="editing_headers_form" id="editing_headers_form" method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
							<table>
								<?php if ($errors) { ?>
								<tr>
									<td>You need to correct the following errors:</td>
									<td>
										<ul>
											<?php if(!$headers)
											foreach ($errors as $error) { ?>
											<li><?= $form->encode($error) ?></li>
											<?php } ?>
										</ul>
									</td>
									<?php } else {
	                  $page_name = $header['page_name'];
	                  $title = $header['title'];
	                  $description = $header['description'];
	                  $metakeys = $header['metakeys'];
									}?>

								<tr>
                  <td>Название страницы:</td>
                  <td><?= $form->input('text', ['name' => 'page_name', 'value' => $page_name], 60) ?></td>
                </tr>
								<tr> 
								<tr>
									<td>Заголовок:</td>
									<td><?= $form->input('text', ['name' => 'title', 'value' => $title], 60) ?></td>
								</tr>
								<tr>
									<td>Описание</td>
									<td><?= $form->input('text', ['name' => 'description', 'value' => $description], 80) ?></td>
								</tr>
								<tr>
									<td>Мета ключевые слова</td>
									<td><?= $form->input('text', ['name' => 'metakeys', 'value' => $metakeys], 60) ?></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><?= $form->input('submit',['name' => 'save', 'value' => 'Сохранить изменения в базе данных']) ?></td>
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

   <script>
    tinymce.init({
      selector: 'art_text',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
  </script>
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



