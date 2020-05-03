<?php
session_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/neumorphic.css">
</head>
<body style="overflow-x:hidden">
    
    
    <!-- <img id="corpo" src="./public/appThemes/carouselPics/residencial/esmeralda/esmeralda2.JPG"> -->
    <nav id="navTest" class="navbar navbar-expand-md bg-white navbar-light fixed-top">

        <a class="navbar-brand" href="index" id="logoLitta">LITTA</a>
  
        <button id="toggleBt"  class="navbar-toggler" data-toggle="modal" data-target="#myModal">
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
                      <span class="option align-baseline " id="option1"> WORK <span>
                  </a>
                  <br>
                  <br>
                  <a href="#notJump">
                      <span class="option align-baseline" id="option2"> QUIZ <span>
                  </a>
                  <br>
                  <br>
                  <a href="login">
                      <span class="option align-baseline" id="option3"> LOGIN <span>
                  </a>
          </ul>
  
        </div>
        
        <div class="modal  fade" id="myModal" >
  
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content d-block text-centered" style="border:none !important">
                      <ul class="navbar-nav ">
                        <a  href="work" >
                            <span class="modalOption"> WORK <span>
                        </a>
                        <a  href="index" >
                            <span class="modalOption"> QUIZ <span>
                        </a>
                        <a  href="login" >
                            <span class="modalOption"> LOGIN <span>
                        </a>
                      </ul>
              </div>
            </div>
        </div>    
      </nav>

        <div id="containerLogin">

        <?php if(isset($_SESSION['msgOk'])){ ?>
            <h2>Email enviado</h2>
            <br> 
            <p><?php echo $_SESSION['msgOk']?></p>
            <?php unset($_SESSION['msgOk']);
          } ?>


        </div>
        
</body>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script>
       $(document).ready(function(){
            $('.toggle').click(function(){
              $('.toggle').toggleClass('active');
              $('.navbar-brand').toggleClass('active');
              $('.navbar').toggleClass('active');
            });
            $('.modal').click(function(){
              $('.toggle').toggleClass('active');
              $('.navbar-brand').toggleClass('active');
              $('.navbar').toggleClass('active');
            });
        });

  </script>
  </html>