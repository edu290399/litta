<?php
session_start();
include_once("./dataBaseManager/conexao.php");
?>
<?php if(!empty($_SESSION['id'])){  unset($_SESSION['idConsulta']);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Novo Cluster</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/novoCluster.css">
  <style>
    @media only screen and (min-width: 990px) {
            .ml-lg-n5 {
                margin-left: -90px !important;
            }
            .pl-lg-2 {
                padding-left: 2vw !important;
            }
        }
  </style>
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
            <a href="criar">
                <span class="option active align-baseline" id="option2"> CRIAR <span>
            </a>
            <br>
            <br>
            <a href="criar">
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
                    <a  href="criar" >
                        <span class="modalOption"> CRIAR <span>
                    </a>
                    <a  href="criar" >
                        <span class="modalOption"> VOLTAR <span>
                    </a>
                </ul>
        </div>
        </div>
    </div>   

</nav>


<div class="container-fluid" >

    
    <h2 style="text-align:center">Novo Cluster</h2>

    <div class="container">

        <form method="POST" action="./dataBaseManager/novoCluster.php" enctype="multipart/form-data" onsubmit="loading()">
        
            <div class="row">
                <label>Nome do Cluster</label>
                <input class="form-control campoDefault" name="nome" required/>
            </div>
            <div class="row mb-2">
                <label>Descrição</label>
                <input type="text" class="form-control campoDefault" name="descricao"/>
            </div>
            <div class="row mb-5">
                <button class="btEstilo" type="button" id="photoEdit" onclick="document.getElementById('arquivo').click()" style="padding-left: 10px; padding-right:10px;width:170px!important;margin-left:2px">Adicionar Imagem<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
            </div>

            <input id="arquivo" name="arquivo[]" multiple="multiple" onchange="document.getElementById('salvar').click()"  accept='image/*' type="file" style="display:none"/>

            
            <div class="row">
                <button class="btEstilo" id="salvar" type="submit" name='btnCadastra' style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Salvar Cluster</button>

        </form>

        <form method="POST" onsubmit="return confirm('Cancelar alterações?');" action="./criar.php">
            <button class="btEstilo" id="cancelar" type="submit" name='cancela'  style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Cancelar</button>
        </form>
            </div>

    </div>

    <div id="spinner" class="text-center" style="display:none">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
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
    function loading(){
        document.getElementById("salvar").style.display = "none";
        document.getElementById("cancelar").style.display = "none";
        document.getElementById("photoEdit").style.display = "none";
        document.getElementById("spinner").style.display = "block";
    }
    </script>
</html>


<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ./login");	
}?>

