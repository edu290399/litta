<?php
session_start();
?>
<?php if($_SESSION['boss'] == '1'){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Consulta</title>
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
            <a href="exibeQuizConsulta">
                <span class="option align-baseline" id="option2"> QUIZ <span>
            </a>
            <br>
            <br>
            <a href="adiministrativo">
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
                    <a  href="exibeQuizConsulta" >
                        <span class="modalOption"> QUIZ <span>
                    </a>
                    <a  href="adiministrativo" >
                        <span class="modalOption"> VOLTAR <span>
                    </a>
                </ul>
        </div>
        </div>
    </div>   

</nav>



<div class="container-fluid" >
    <?php if(isset($_SESSION['msgOk'])){ ?>
            <div class="alert alert-success alert-dismissible mx-auto fade show" style="height:50px;width:250px" role="alert">
                <strong style="color:black;text-align:center">  <?php echo $_SESSION['msgOk']?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php unset($_SESSION['msgOk']); } ?>

    <?php if(isset($_SESSION['msgErro'])){ ?>
            <div class="alert alert-danger alert-dismissible mx-auto fade show" style="height:50px;width:250px" role="alert">
                <strong style="color:black;text-align:center"><?php echo $_SESSION['msgErro']?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    <?php unset($_SESSION['msgErro']);} ?>
    <div class="row" id="rowGeral" >



                
        <div class="col-md-4 col-12 order-2 order-md-1  align-self-center"  >


                    <div class="row mx-auto" >
                        <p>Usuário: </p>
                        <strong><?php echo $_SESSION['usuarioConsulta']?></strong>
                    </div>
                    <div class="row mx-auto my-4" >
                        <p>Email: </p>
                        <strong><?php echo $_SESSION['emailConsulta']?></strong>
                    </div>
                    <div class="row mx-auto my-4" >
                        <p>Nome: </p>
                        <strong><?php echo $_SESSION['nomeConsulta']." ".$_SESSION['sobrenomeConsulta']?></strong>
                    </div>
                    <div class="row mx-auto my-4" >
                        <p>Data de Nascimento: </p>
                        <strong><?php echo $_SESSION['datanasConsulta']?></strong>
                    </div>
                    <div class="row mx-auto my-4" >
                        <p>Idade: </p>
                        <strong><?php echo $_SESSION['idadeConsulta']?></strong>
                    </div>
                    <div class="row mx-auto" >
                        <p>Gênero: </p>
                        <strong><?php echo $_SESSION['sexoConsulta']?></strong>
                    </div>
        </div>
        <div class="col-md-3 col-12 order-1 order-md-2 align-self-center">
            <div class="row mx-1 mb-1">
                <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $_SESSION['imgPerfilConsulta']?>" id="profilePic" alt="profile" class="img-thumbnail" style="width:200px;height:250px">  
                        </div>
                    </div>  
                </div>  
            </div>

            <div class="row my-2 mx-1" >
                <form method="POST" action="./documentosConsulta">
                    <button class="btEstilo "name="btnGaleria" type="submit" style="margin-left:5px" >Documentos<img src="./public/open-iconic/svg/document.svg" class="icon" alt="document"></button>
                </form>
            </div>

            <div class="row mb-3 mb-md-0" >
                <form method="POST" action="./galeriaConsulta">
                    <button class="btEstilo "name="btnGaleria" id="btGaleria" type="submit" >Galeria</button>
                    <img src="./public/open-iconic/svg/aperture.svg" class="icon" alt="aperture" id="galeriaIcone">
                </form>
            </div>


        </div> 
        <div class="col-md-4 col-12 order-last align-self-center" >
        

                    <div class="row mx-auto " >
                        <p>Telefone: </p>
                        <strong><?php echo $_SESSION['telefone1Consulta']?></strong>
                    </div>

                    <div class="row mx-auto my-4" >
                        <p>Telefone 2: </p>
                        <strong><?php echo $_SESSION['telefone2Consulta']?></strong>
                    </div>

                    <div class="row mx-auto my-4" >
                        <p>País: </p>
                        <strong><?php echo $_SESSION['paisConsulta']?></strong>
                    </div>

                    <div class="row mx-auto my-4" >
                        <p>Estado: </p>
                        <strong><?php echo $_SESSION['estadoConsulta']?></strong>
                    </div>

                    <div class="row mx-auto my-4" >
                        <p>Cidade: </p>
                        <strong><?php echo $_SESSION['cidadeConsulta']?></strong>
                    </div>

                    <div class="row mx-auto" >
                        <p>Data de Cadastro: </p>
                        <strong><?php echo $_SESSION['dataCadastroConsulta']?></strong>
                    </div>



                
                
        </div>
    </div>

</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function submitForm() {
            document.getElementById("myForm").submit();
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
	$_SESSION['msgErro'] = "Endereço restrito";
	header("Location: ./login");	
}?>
