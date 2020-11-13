$(window).scroll(function() {

  var target = $(this).scrollTop();

  if(target == 0) {

    $('nav').removeClass('navbar-dark').addClass('navbar-light');

  } else {

    $('nav').removeClass('navbar-light').addClass('navbar-dark');

  }

});