<?php
session_start();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'],$_SESSION['idConsulta'],$_SESSION['boss']);
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
                      <span class="option align-baseline active" id="option3"> LOGIN <span>
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
          <div class="alert alert-success alert-dismissible mx-auto fade show">
            <strong><?php echo $_SESSION['msgOk']?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <?php unset($_SESSION['msgOk']);
          } ?>

          <?php if(isset($_SESSION['msgErro'])){ ?>
          <div class="alert alert-danger">
            <strong><?php echo $_SESSION['msgErro']?></strong>
          </div>
            <?php unset($_SESSION['msgErro']);
          } ?>

        <form method="POST" action="./dataBaseManager/valida.php" id="loginForm">
            <h2 style="margin-left:10px">LOGIN</h2>
            <button disabled="true" class="btIcon"><img src="./public/open-iconic/svg/person.svg" class="iconLogin" alt="check" style="margin-bottom:1px ; width:18px"></button>
            <input name="usuario" class="inputLogin" placeholder="Usuário ou E-mail" required/>
            <br>
            <button disabled="true" class="btIcon"><img src="./public/open-iconic/svg/lock-locked.svg" class="iconLogin" alt="check" style="width:20px"></button>
            <input name="senha" class="inputLogin" type="password" placeholder="Senha" autocomplete="off" onKeyPress="return submitenter(this,event)" required/>
            <br>
            <button id="btcadastrar" name="btnLogin" type="submit" style="margin-left:10px">Entrar</button>
            </form>
            
            <br>
            <br>
            <a href="register"><span id="dica" style="float:left;margin-left:2%">CADASTRAR</span></a>
            <a href="perdisenha"><span id="dica"style="float:right;margin-right:2%" >Esqueceu a senha?</span></a>

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
        function submitenter(myfield,e){
          var keycode;
          if (window.event) keycode = window.event.keyCode;
          else if (e) keycode = e.which;
          else return true;

          if (keycode == 13)
          {
          document.getElementById("loginForm").submit();
          // myfield.form.submit();
          return false;
          }
          else
          return true;
        }
  </script>

  </html>