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

          
          <?php
            if( empty($_GET['utilizador']) || empty($_GET['confirmacao']) )
              die('<p>Não é possível alterar a password: dados em falta</p>');
            include_once("./dataBaseManager/conexao.php");          
            $email = ($_GET['utilizador']);
            $hash = ($_GET['confirmacao']);
            $sqlValida = "SELECT COUNT(*) FROM recuperacao WHERE utilizador = ? AND confirmacao = ?";
            if ( $stmtValida = mysqli_prepare($conn, $sqlValida)  ){

              mysqli_stmt_bind_param($stmtValida, "ss", $email,$hash);
        
              if( mysqli_stmt_execute($stmtValida) ){
                mysqli_stmt_bind_result($stmtValida, $resultado);
              } 
              else{
                echo "ERROR: Could not execute query: Consulta no BD de email. \n" .  mysqli_stmt_error($stmtEmail) . "\n"  .mysqli_error($conn);
              }
              if(mysqli_stmt_fetch($stmtValida)){
                if($resultado == 1){
                  // o utilizador existe, vamos gerar um link único e enviá-lo para o e-mail
                  mysqli_stmt_free_result($stmtValida); 
                  $sqlDelete = "DELETE FROM recuperacao WHERE utilizador = '$email' AND confirmacao = '$hash'";
                  mysqli_query($conn, $sqlDelete);
                  ?>

                  <form method="POST" action="./dataBaseManager/novasenha.php">
                      <h2>Alterar password</h2>
                      <button type="button" disabled="true" class="btIcon"><img src="./public/open-iconic/svg/lock-locked.svg" class="iconLogin" alt="check" style="margin-bottom:1px ; width:18px"></button>
                      <input name="senha" id="senha" onchange="validatePassword()" type="password" minlength="8" placeholder="Senha" autocomplete="nope" style="transform: translate(0vw, 0%) !important;" required><img src="./public/open-iconic/svg/eye.svg" id="eye" class="icon" alt="eye" style=" transform: translate(-4vw, 0%); !important"/></input>
                      <br>
                      <button type="button" disabled="true" class="btIcon"><img src="./public/open-iconic/svg/loop-circular.svg" class="iconLogin" alt="check" style="width:20px"></button>
                      <input name="senhaconf" id="senhaConf" onkeyup="validatePassword()" type="password" minlength="8" placeholder="Confirmar senha" autocomplete="nope" required><img src="./public/open-iconic/svg/check.svg" id="checked" class="icon" alt="check"/></input>
                      <br>
                      <button id="btcadastrar" name="btnConfirma" type="submit">Confirmar</button>
                      <br>
                      <br>
                      <a href="register"><span id="dica" style="margin-left:2%">CADASTRAR</span></a>
                      <input name="email" value="<?php echo $email?>" style="display:none" required />
                  </form>
          
                  </div>
                  
                <?php
                
                }              
                else {
                  echo '<h2>Alterar password</h2> <br> <br> <br> <p>Token inválido.<br><a href="perdisenha"> <span id="dica"style="display:inline;text-decoration: underline"> Faça uma nova solicitação clicando aqui</span></a></p>';
                }
              mysqli_stmt_free_result($stmtValida); 
              }
            } 
            else{
              echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
            }
          ?>

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
        $( "#eye" ).mousedown(function() {
          $("#senha").attr("type", "text");
        });

        $( "#eye" ).mouseup(function() {
          $("#senha").attr("type", "password");
        });
        $( "#eye" ).mouseout(function() { 
          $("#senha").attr("type", "password");
        });
        
        
        $( "#eye" ).on("touchstart",function() {
          $("#senha").attr("type", "text");
        });

        $( "#eye" ).on("touchend",function() {
          $("#senha").attr("type", "text");
        });
       var senha1 = document.getElementById('senha');
       var senha2 = document.getElementById('senhaConf');
        function validatePassword(){
          senha1 = document.getElementById('senha');
          senha2 = document.getElementById('senhaConf');
          ckecked = document.getElementById('checked');
          if(senha1.value != senha2.value) {
            senha2.setCustomValidity("Senhas diferentes!");
            senha2.style.color = "black";
            checked.style.filter = "invert(1) sepia(0) saturate(1) hue-rotate(0deg) brightness(1.5)"; 
          } else {
            senha2.setCustomValidity('');
            senha2.style.backgroundColor = "white";
            senha2.style.color = "green";
            checked.style.filter = "invert(0.4) sepia(1) saturate(20) hue-rotate(97.2deg) brightness(1)"; 
          }
        }
  </script>
  </html>