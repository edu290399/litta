<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/neumorphic.css">
</head>
<body>
    
    
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
                      <span class="option align-baseline" id="option1"> WORK <span>
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

     
      <div id="container">
        <h2>Cadastro</h2>

        <?php if(isset($_SESSION['msgErro'])){ ?>
          <div class="alert alert-danger">
          <strong><?php echo $_SESSION['msgErro']?></strong>
          </div>
          <?php unset($_SESSION['msgErro']);
        } ?>
        <form method="POST" action="./dataBaseManager/registra.php" id="regForm">
            <input name="nome" placeholder="Nome" value="<?php echo $_SESSION['nome']?>" required/>
            <input name="sobrenome" placeholder="Sobrenome" value="<?php echo $_SESSION['sobrenome']?>" required/>
            <input name="sexo" placeholder="Sexo" value="<?php echo $_SESSION['sexo']?>" required/>
            <input name="datanas" id="data" oninput="M_datanas(this)" placeholder="Data de nascimento" value="<?php echo $_SESSION['datanas']?>" pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$" required/>
            <input name="telefone1" id="tel1" placeholder="Telefone 01" value="<?php echo $_SESSION['telefone1']?>" oninput="M_tel(this)" required/>
            <input name="telefone2" id="tel2" placeholder="Telefone 02 (Opcional)" value="<?php echo $_SESSION['telefone2']?>" oninput="M_tel(this)"/>
            <input name="email" value="<?php echo $_SESSION['email']?>"pattern="(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|&quot(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*&quot)@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])" placeholder="E-mail" required/>
            <input name="usuario" value="<?php echo $_SESSION['usuario']?>" placeholder="Usuário" required/>
            <input name="senha" id="senha" onchange="validatePassword()" type="password" minlength="8" placeholder="Senha" required/>
            <input name="senhaconf" id="senhaConf" onkeyup="validatePassword()" type="password" minlength="8" placeholder="Confirmar senha" required/>
            <br>
            <select id="paises">
              <option name="pais" value="pais 01"></option>
            </select>
            <select id="estados">
              <option name="estado" id="estados" value="estado 01"></option>
            </select>
            <select name="cidade" id="cidades" value="cidade 01">
            </select>
          
            <button id="btcadastrar"name="btnCadastra" type="submit"><img src="./public/open-iconic/svg/check.svg" class="icon" alt="check">Certo</button>
        </form>  
      </div>

      
</body>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script>
   function M_number(e){
          var N = e.value;

          if(isNaN(N[N.length-1])){ 
              e.value = N.substring(0, N.length-1);
              return;
          }
        }
        function M_datanas(e){
   
          var dat = e.value;
          
          M_number(e);
          
          e.setAttribute("maxlength", "10");
          if (dat.length == 2 || dat.length == 5) e.value += "/";
        
        
        }
        function M_tel(e){
          var T = e.value;

          M_number(e);

            e.setAttribute("maxlength", "17");
            if (T.length == 1) e.value = "("+e.value;
            if (T.length == 3) e.value += ")";
            if (T.length == 6) e.value += " ";
            if (T.length == 12) e.value += "-";
        }


        senha1 = document.getElementById('senha');
        senha2 = document.getElementById('senhaConf');

        function validatePassword(){
          if(senha1.value != senha2.value) {
            senha2.setCustomValidity("Senhas diferentes!");
          } else {
            senha2.setCustomValidity('');
          }
        }


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
<?php
  session_destroy();
?>
  </html>