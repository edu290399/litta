<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){  unset($_SESSION['idConsulta']);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>QUIZ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/editaCluster.css">
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
            <a href="exibeQuiz">
                <span class="option active align-baseline" id="option2"> QUIZ <span>
            </a>
            <br>
            <br>
            <a href="exibeQuiz">
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
                    <a  href="exibeQuiz" >
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


    <form method="POST" action="./dataBaseManager/responderQuiz.php">
        <div class="container-fluid">
                <?php
                    include_once("./dataBaseManager/conexao.php");
                    $id = $_SESSION['id'];
                    $clusterAtual = 'c'.$_SESSION['clusterAtual']; 
                    $idQuiz = filter_input(INPUT_POST, 'idQuiz', FILTER_SANITIZE_STRING);
                    $idEnvio = filter_input(INPUT_POST, 'idEnvio', FILTER_SANITIZE_STRING);
                    if($idEnvio==NULL){
                        $idEnvio = $_SESSION['idEnvio'];
                    }
                    if(!empty($_SESSION['idQuiz'])){
                        $idQuiz = $_SESSION['idQuiz'];
                    }
                    $sql1 = "SELECT $clusterAtual FROM quiz WHERE id = $idQuiz ";
                    $result = mysqli_query($conn, $sql1);
                    if ($result = mysqli_query($conn, $sql1)) {
                        while($row = mysqli_fetch_assoc($result)) {  $idCluster = $row["$clusterAtual"];}
                    }
                    $sql2 = "SELECT * FROM cluster WHERE id = $idCluster ";
                    $result = mysqli_query($conn, $sql2);
                    if (mysqli_query($conn, $sql2)) { 
                        while($row = mysqli_fetch_assoc($result)) { $cont = 1; $contValido=0; $id = $row["id"]; $nome = $row["nome"]; $descricao = $row["descricao"]; 
                ?>
            
                            <div class="row">
                                <label>Nome do Cluster</label>
                                <input class="form-control campoDefault"  value= "<?php echo $nome ?>" name="nome"  disabled/>
                            </div>
                        
                            <div class="row mb-5">
                                <label>Descrição</label>
                                <input type="text" class="form-control campoDefault"  value= "<?php echo $descricao?>" name="descricao"  disabled/>
                            </div>
                        
                            <div class="row mb-5">
                        
                                <?php while($cont <= 8) { $img = "img".$cont; if($row["$img"]!=""){ $contValido++; $imgValida = "img".$contValido;  $spinnerValido = "spinner".$contValido; $tValido = "t".$contValido; $legValida = "leg".$contValido ?>
                        
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="carousel slide carousel-fade" data-pause="hover" data-ride="carousel" >
                                            <div class="carousel-inner">
                                                <div id="<?php echo $imgValida?>" class="carousel-item active" onload="mostra(<?php echo $imgValida?>,<?php echo $spinnerValido?>)">
                                                    <img  src=<?php echo $row["$imgValida"]?> >
                                                    <input class="titulo"  name="<?php echo $tValido?>" value="<?php echo $row["$tValido"]?>" disabled/>
                                                    <input class="descricao" name="<?php echo $legValida?>" value="<?php echo $row["$legValida"]?>"  disabled/>
                                                </div>
                                            </div>  
                                        </div>
                                        <input type='radio' name='nImage' value="<?php echo $contValido?>" required/>
                                        <input name='idCluster' value="<?php echo $idCluster?>" style="display:none" required/>
                                        <input name='idQuiz' value="<?php echo $idQuiz?>" style="display:none" required/>
                                    </div>
                        

                                <?php 
                                    }
                                    $cont++;
                                }
                        }
                    }?>

        </div>
        <div class="col-md-12 text-center">
            <input value="<?php echo $idEnvio?>" name="idEnvio" style="display:none"></input>
            <button class="btEstilo" type="submit" name='btnResposta' value="<?php echo $id?>" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Enviar</button>
        </div>
    </form>
</div>

</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        function uncheckOthers(cluster){
            for(cont = 1; cont <=8; cont++){
                if(cluster != cont ){
                    document.getElementById(cont).checked = false;
                }
            }
        }
    </script>
</html>


<?php 

}
else{
    $_SESSION['msgErro'] = "Faça login para continuar";
    header("Location: ./login");	
}?>

