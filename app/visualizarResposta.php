<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){?>
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
            <?php if(isset($_SESSION['idConsulta'])){?>
                <a href="exibeQuizConsulta">
                    <span class="option align-baseline" id="option3"> VOLTAR <span>
                </a>
            <?php }else{ ?>
                <a href="exibeQuiz">
                    <span class="option align-baseline" id="option3"> VOLTAR <span>
                </a>
            <?php }?> 
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
                    <?php if(isset($_SESSION['idConsulta'])){?>
                        <a href="exibeQuizConsulta">
                            <span class="modalOption"> VOLTAR <span>
                        </a>
                    <?php }else{ ?>
                        <a href="exibeQuiz">
                            <span class="modalOption"> VOLTAR <span>
                        </a>
                    <?php }?>    
                </ul>
        </div>
        </div>
    </div>   

</nav>


<div class="container-fluid" >

    

    <div class="container-fluid">
            <?php
                include_once("./dataBaseManager/conexao.php");
                $idQuiz = filter_input(INPUT_POST, 'idQuiz', FILTER_SANITIZE_STRING);
                $idEnvio = filter_input(INPUT_POST, 'idEnvio', FILTER_SANITIZE_STRING);
                if (isset($_SESSION['idConsulta'])){
                    $idUsuario = $_SESSION['idConsulta'];
                }else{
                    $idUsuario = $_SESSION['id'];
                }
                $sqlQuiz = "SELECT * FROM quiz WHERE id = $idQuiz";
                $sqlRespostas = "SELECT * FROM respostasQuiz WHERE idEnvio = $idEnvio";


                $resultEntrevistas = mysqli_query($conn, $sqlEntrevistas);
                $resultRespostas = mysqli_query($conn, $sqlRespostas);

                if (mysqli_query($conn, $sqlEntrevistas) && mysqli_query($conn, $sqlRespostas)) {
                while( ($rowEntrevistas = mysqli_fetch_assoc($resultEntrevistas)) && ($rowRespostas = mysqli_fetch_assoc($resultRespostas)) ) { $cont = 1; $nome = $rowEntrevistas["nome"]; $descricao = $rowEntrevistas["descricao"]; 
            ?>

                        <h2 style="text-align:center"><?php echo $nome?> </h2>
                        <h3 style="text-align:center;margin-top:-30px;color:white"><?php echo $descricao?> </h3>

                        <?php while($cont <= 20) { $pergunta = "p".$cont; if($rowEntrevistas["$pergunta"]!=""){ $resposta = "r".$cont ?>
                            <div class="row">
                                <label><?php echo $cont.". ".$rowEntrevistas["$pergunta"]?></label>
                            </div>
                            <div class="row">
                                <label style="font-weight:bold"><?php echo $rowRespostas["$resposta"]?></label>
                            </div>
                        <?php 
                            }
                            $cont++;
                        }
                    }?>
    </div>

</div>

</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>

    </script>
</html>


<?php 
        }else {
            echo "mysqli_error($conn)";
        }
}
else{
    $_SESSION['msgErro'] = "Faça login para continuar";
    header("Location: ./login");	
}?>

