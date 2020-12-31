<?php
session_start();
?>
<!DOCTYPE html>
<html translate="no">
<head>
  <meta charset="utf-8">
  <meta name="google" content="notranslate" />
  <title>LITTA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="./public/css/swiper.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/index.css">
  <!-- Demo styles -->

</head>
<body onload="wpp()" onresize="wpp()">
    <nav id="navTest" class="navbar navbar-expand-xl navbar-light fixed-top">
       
        <a class="navbar-brand" href="index" id="logoLitta">LITTA</a>
        <button id="toggleBt"  class="navbar-toggler " data-toggle="modal" data-target="#myModal">
            <div class="toggle">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>   
        </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <a  href="work" >
                <span class="option" id="option1" translate="no"> WORK<span>
            </a>
            <br>
            <br>
            <a  href="exibeQuiz" >
                <span class="option" id="option2" translate="no"> QUIZ <span>
            </a>
            <br>
            <br>
            <?php if(!empty($_SESSION['id'])){ ?>
            <a  href="perfil" >
                <span class="option" id="option3" translate="no">PERFIL<span>
            </a>
            <?php } else{ ?>
              <a  href="login" >
                <span class="option" id="option3" translate="no"> LOGIN <span>
              </a>
            <?php }?>
    </ul>
    </div>
    <div class="modal fade" id="myModal" >
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content" style="background: transparent !important;border:none !important">
            <div class="modal-body">
                <ul class="navbar-nav">
                    <a  href="work" >
                        <span class="modalOption" translate="no"> WORK <span>
                    </a>
                    <a  href="exibeQuiz" >
                        <span class="modalOption" translate="no"> QUIZ <span>
                    </a>
                    <?php if(!empty($_SESSION['id'])){ ?>
                        <a  href="perfil" >
                            <span class="modalOption"  translate="no">PERFIL<span>
                        </a>
                      <?php } else{ ?>
                          <a  href="login" >
                            <span class="modalOption" translate="no"> LOGIN <span>
                          </a>
                      <?php }?>
            </ul>
            </div>              
          </div>
        </div>
      </div>
</nav>
  <!-- Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"></div>
      <div class="swiper-slide"></div>
      <div class="swiper-slide"></div>
      <div class="swiper-slide"></div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
   
  </div>

  <!-- Swiper JS -->
  <script src="./public/css/swiper.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      effect: 'fade',
      autoplay: {
        delay: 7000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,

      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    $(document).ready(function(){
        $('.toggle').click(function(){
            $('.toggle').toggleClass('active');
        });
        $('.toggle').click(function(){
            $('.navbar-brand').toggleClass('active');
        });
        $('.modal').click(function(){
            $('.toggle').toggleClass('active');
        });
        $('.modal').click(function(){
            $('.navbar-brand').toggleClass('active');
        });
    });
    function wpp(){
        if( (((window.innerWidth > 0) ? window.innerWidth : screen.width) /((window.innerHeight > 0) ? window.innerHeight : screen.height)) > 1){
            document.getElementsByClassName("swiper-slide")[0].style.backgroundImage =  "url('./public/appThemes/desktopWp/img1low.jpg')";
            document.getElementsByClassName("swiper-slide")[1].style.backgroundImage =  "url('./public/appThemes/desktopWp/img2low.jpg')";
            document.getElementsByClassName("swiper-slide")[2].style.backgroundImage =  "url('./public/appThemes/desktopWp/img3low.jpg')";
            document.getElementsByClassName("swiper-slide")[3].style.backgroundImage =  "url('./public/appThemes/desktopWp/img4low.jpg')";
        }else{
            document.getElementsByClassName("swiper-slide")[0].style.backgroundImage =  "url('./public/appThemes/mobileWp/img1mbLow.jpg')";
            document.getElementsByClassName("swiper-slide")[1].style.backgroundImage =  "url('./public/appThemes/mobileWp/img2mbLow.jpg')";
            document.getElementsByClassName("swiper-slide")[2].style.backgroundImage =  "url('./public/appThemes/mobileWp/img3mbLow.jpg')";
            document.getElementsByClassName("swiper-slide")[3].style.backgroundImage =  "url('./public/appThemes/mobileWp/img4mbLow.jpg')";
        }
    }  
  </script>
</body>
</html>