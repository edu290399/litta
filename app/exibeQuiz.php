<?php
session_start();
unset($_SESSION['idEnvio']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/listagem.css">
  <style>
    @media only screen and (min-width: 990px) {
            .ml-lg-n5 {
                margin-left: -90px !important;
            }
            .ml-lg-n4 {
                margin-left: -70px !important;
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
            <a href="galeria">
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
                    <a  href="galeria" >
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




 <!-- QUIZ -->
 <h2 class="mb-n1">QUIZ</h2>
    
    <?php
        include_once("./dataBaseManager/conexao.php");
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM quiz INNER JOIN quizados ON quiz.id = quizados.idQuiz AND quizados.idUsuario =  $id AND quizados.respondido = '0' ";
        $sql2 = "SELECT * FROM quiz INNER JOIN quizados ON quiz.id = quizados.idQuiz AND quizados.idUsuario =  $id AND quizados.respondido = '1' ";


        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) { $idQuiz = $row["idQuiz"]; $idEnvio = $row["idEnvio"]; $nome = $row["nome"]; $descricao = $row["descricao"]; ?>
            


    <div class="row pl-lg-2 py-3 border-bottom border-white">

        <div class="col-md-5 col-lg-5 col-12">
            
            <p>Nome: </p>
            <strong><?php echo $nome?></strong>
            
        </div> 

                
        <div class="col-md-5 col-lg-5 col-12" >

            <p>Descrição: </p>
            <strong><?php echo $descricao?></strong>
 
        </div>
        
        <div class="col-md-2 col-lg-2 ml-lg-n4 col-12" style="text-align:center" >
        
            <form method="POST" action="responderQuiz">
                <?php $_SESSION['clusterAtual'] = 1 ?>
                <input value="<?php echo $idEnvio?>" name="idEnvio" style="display:none"></input>
                <button class="btEstilo" name="idQuiz" value="<?php echo $idQuiz ?>" type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Responder<img src="./public/open-iconic/svg/external-link.svg" class="icon" alt="external"></button>
            </form>    

        </div>  
       

    </div>

    <?php
          } 
        }else {
          echo "mysqli_error($conn)";
        }?>




<?php

$result = mysqli_query($conn, $sql2);
        if (mysqli_query($conn, $sql2)) {
          while($row = mysqli_fetch_assoc($result)) { $idQuiz = $row["idQuiz"]; $nome = $row["nome"]; $descricao = $row["descricao"]; ?>
            


    <div class="row pl-lg-2 py-3 border-bottom border-white">

        <div class="col-md-5 col-lg-5 col-12">
            
            <p>Nome: </p>
            <strong><?php echo $nome?></strong>
            
        </div> 

                
        <div class="col-md-5 col-lg-5 col-12" >

            <p>Descrição: </p>
            <strong><?php echo $descricao?></strong>
 
        </div>
        
        <div class="col-md-2 col-lg-2 ml-lg-n4 col-12" style="text-align:center" >
        
        <form method="POST" action="visualizarResposta" >
            <button class="btEstilo" name="idQuiz" value="<?php echo $idQuiz ?>" type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Ver Resposta<img src="./public/open-iconic/svg/eye.svg" class="icon" alt="eye"></button>
        </form>

        </div>  
       

    </div>

<?php
     } 
}else {
    echo "mysqli_error($conn)";
}?>











    <!-- ENTREVISTA -->
    <h2 class="mt-5 mb-n1">ENTREVISTAS</h2>
    
    <?php
        include_once("./dataBaseManager/conexao.php");
        $id = $_SESSION['id'];
        $sql = "SELECT a.* , b.idEnvio, b.idPergunta FROM entrevistas a, entrevistados b WHERE a.id = b.idPergunta AND b.idUsuario =  $id AND b.respondido = '0' ";
        $sql2 = "SELECT a.* , b.idEnvio, b.idPergunta FROM entrevistas a, entrevistados b WHERE a.id = b.idPergunta AND b.idUsuario =  $id AND b.respondido = '1' ";


        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) { $idPergunta = $row["idPergunta"]; $idEnvio = $row["idEnvio"];$nome = $row["nome"]; $descricao = $row["descricao"]; ?>
            


    <div class="row pl-lg-2 py-3 border-bottom border-white">

        <div class="col-md-5 col-lg-5 col-12">
            
            <p>Nome: </p>
            <strong><?php echo $nome?></strong>
            
        </div> 

                
        <div class="col-md-5 col-lg-5 col-12" >

            <p>Descrição: </p>
            <strong><?php echo $descricao?></strong>
 
        </div>


        
        <div class="col-md-2 col-lg-2 ml-lg-n4 col-12" style="text-align:center" >
        
            <form method="POST" action="responderEntrevista">
                <input value="<?php echo $idEnvio?>" name="idEnvio" style="display:none"></input>
                <button class="btEstilo" name="idEntrevista" value="<?php echo $idPergunta ?>" type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Responder<img src="./public/open-iconic/svg/external-link.svg" class="icon" alt="external"></button>
            </form>    

        </div>  

    </div>

    <?php
          } 
        }else {
          echo "mysqli_error($conn)";
        }?>




<?php

$result = mysqli_query($conn, $sql2);
        if (mysqli_query($conn, $sql2)) {
          while($row = mysqli_fetch_assoc($result)) { $idPergunta = $row["idPergunta"];  $idEnvio = $row["idEnvio"]; $nome = $row["nome"]; $descricao = $row["descricao"]; ?>
            


    <div class="row pl-lg-2 py-3 border-bottom border-white">

        <div class="col-md-5 col-lg-5 col-12">
            
            <p>Nome: </p>
            <strong><?php echo $nome?></strong>
            
        </div> 

                
        <div class="col-md-5 col-lg-5 col-12" >

            <p>Descrição: </p>
            <strong><?php echo $descricao?></strong>
 
        </div>


        <div class="col-md-2 col-lg-2 ml-lg-n4 col-12" style="text-align:center" >
        
        <form method="POST" action="visualizarRespostaEntrevista" >
            <input value="<?php echo $idEnvio?>" name="idEnvio" style="display:none" />
            <button class="btEstilo" name="idEntrevista" value="<?php echo $idPergunta ?>" type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Ver Resposta<img src="./public/open-iconic/svg/eye.svg" class="icon" alt="eye"></button>
        </form>

        </div>  
       

    </div>

<?php
     } 
}else {
    echo "mysqli_error($conn)";
}?>


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
