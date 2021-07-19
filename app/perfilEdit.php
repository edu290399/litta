<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/perfil.css">
</head>
<body>

<nav id="navTest" class="navbar navbar-expand-md bg-white navbar-light fixed-top ">

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
            <a href="exibeQuiz">
                <span class="option align-baseline" id="option2"> QUIZ <span>
            </a>
            <br>
            <br>
            <a href="perfil">
                <span class="option align-baseline" id="option3"> VOLTAR <span>
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
                    <a  href="exibeQuiz" >
                        <span class="modalOption"> QUIZ <span>
                    </a>
                    <a  href="perfil" >
                        <span class="modalOption"> VOLTAR <span>
                    </a>
                </ul>
        </div>
        </div>
    </div>   

</nav>
<form method="POST" action="./dataBaseManager/editar.php">
<div class="container-fluid">
    <div class="row" style="margin-left:1vw;height:70vh">

    <div class="col-md-2 col-12 align-self-center" >
            <div class="row">
                <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $_SESSION['imgPerfil']?>" alt="profile" class="img-thumbnail" style="width:250px;height:250px"> 
                        </div>
                    </div>  
                </div>  
            </div>

            <div class="row my-2" style="margin-left:-20px">
                <strong style="color:white"><?php echo $_SESSION['nome']?></strong>
            </div>
        </div>  
                
        <div class="col-md-9 col-12  ml-md-4 align-self-center">
            <div class="row" >
                <div class="col-md-6">
                    <div class="row mx-auto" >
                        <input  name="datanas" placeholder="Data de nascimento" id="data"  value="<?php echo $_SESSION['datanas']?>" pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$" required/>
                    </div>
                    <div class="row mx-auto" >
                        <input name="sexo" placeholder="Sexo" value="<?php echo $_SESSION['sexo']?>" required/>
                    </div>

                    <div class="row mx-auto" >
                        <input  name="telefone1" placeholder="Telefone" onload="validateTel1()" onfocus="validateTel1()" onkeydown="validateTel1()" id="tel1" value="<?php echo $_SESSION['telefone1']?>" required/>
                    </div>
                    <div class="row mx-auto" >
                        <input name="telefone2" placeholder="Telefone 02" onload="validateTel2()" onfocus="validateTel2()" onkeydown="validateTel2()" id="tel2" value="<?php echo $_SESSION['telefone2']?>"/>
                    </div>

                </div> 

                <div class="col-md-5 align-self-center">
                    <div class="row mx-auto" >
                        <input name="pais" placeholder="País" value="<?php echo $_SESSION['pais']?>" required/>
                    </div>
                    <div class="row mx-auto" >
                        <input name="estado" placeholder="Estado" value="<?php echo $_SESSION['estado']?>" required/>
                    </div>
                    <div class="row mx-auto" >
                        <input name="cidade" placeholder="Cidade" value="<?php echo $_SESSION['cidade']?>" required/>
                    </div>
                    <div class="row" style="margin-top:20px" >
                        <button class="btEstilo"name="btnEdita" type="submit">Confirmar<img src="./public/open-iconic/svg/check.svg" class="icon" alt="check"></button>
                    </div>
                </div> 
            </div>
        </div>  
     
    </div>
</div>
</form>    
</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        jQuery(function($){
          $("#data").mask("99/99/9999");
          $("#tel1").mask("(+99) 99 99999-9999");
          $("#tel2").mask("(+99) 99 99999-9999");
        });

        var tel1 = document.getElementById('tel1');
        function validateTel1(){
          tel1 = document.getElementById('tel1');
          if (tel1.value.indexOf('_') > -1){
          tel1.setCustomValidity("Telefone inválido");
          } 
          else {
            tel1.setCustomValidity('');
          }
        }

        var tel2 = document.getElementById('tel2');
        function validateTel2(){
          tel2 = document.getElementById('tel2');
          if (tel2.value.indexOf('_') > -1){
          tel2.setCustomValidity("Telefone inválido");
          } 
          else {
            tel2.setCustomValidity('');
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
            $('.suboption').click(function(){
              $('.suboption').removeClass('active');
              $(this).addClass('active');
            });

        });
    </script>
</html>

    
<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ./login");	
}?>
