<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){  unset($_SESSION['idConsulta']);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edita Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./public/css/editaQuiz.css">
  <link rel="stylesheet" href="./public/css/swiper.css">

  
  <style>
    @media only screen and (min-width: 990px) {
            .ml-lg-n5 {
                margin-left: -90px !important;
            }
            .pl-lg-2 {
                padding-left: 2vw !important;
            }
        }
    .swiper-container {
      width: 100%;
      height: 300px;
      margin-left: auto;
      margin-right: auto;
    }
    .swiper-slide {
      background-size: cover;
      background-position: center;
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


<div class="container" >

    <h2 style="text-align:center">EDITAR QUIZ </h2>

        <?php
            include_once("./dataBaseManager/conexao.php");
            $idQuiz = $_SESSION['idQuiz'];
            if(isset($_POST['idQuiz'])){ $idQuiz = filter_input(INPUT_POST, 'idQuiz', FILTER_SANITIZE_STRING);};
            $sql = "SELECT * FROM quiz WHERE id = $idQuiz";
            $resultado = mysqli_query($conn, $sql);
            if (mysqli_query($conn, $sql)) { 
                while($row = mysqli_fetch_assoc($resultado)) { $id = $row["id"]; $nome = $row["nome"]; $descricao = $row["descricao"]; 
        ?>
        
        <input type="text" style="display:none" value= "<?php echo $idQuiz?>" name="idQuiz"/>

        <div class="row">
            <label>Nome do Quiz</label>
            <input class="form-control campoDefault"  value= "<?php echo $nome ?>" name="nome" disabled/>
        </div>

        <div class="row mb-5">
            <label>Descrição</label>
            <input type="text" class="form-control campoDefault"  value= "<?php echo $descricao?>" name="descricao" disabled/>
        </div>

        <div class="row  mb-5">

            <?php for($n=1;$n<=20;$n++) { $cluster[$n] = $row["c".$n];}?>
                    <?php for($cont1=1;$cont1<=20;$cont1++) {  if( ($cluster[$cont1]) == null ){continue;}?>
                    <!-- >>>Fazer outra consulta no banco de dados aqui, recuperando o conteudo de cada cluster apontado <<< -->
                        <div class="col-xl-4 col-lg-6">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    <?php
                                        $idCluster =$cluster[$cont1];
                                        $sql = "SELECT * FROM cluster WHERE id = $idCluster";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_query($conn, $sql)) { 
                                            // Entrei no IF     
                                            while($row = mysqli_fetch_assoc($result)) { $cont2 = 1; $id = $row["id"]; $nome = $row["nome"]; $descricao = $row["descricao"]; 
                                                for($n=1;$n<=8;$n++) { $imagem[$n] = $row["img".$n]; $titulo[$n] = $row["t".$n]; $legenda[$n] = $row["leg".$n];}
                                                for($cont2=1; $cont2<=8; $cont2++) { if($imagem[$cont2]==""){ break;}
                                    ?>

                                            
                                        <div class="swiper-slide" style="background-image:url(<?php echo $imagem[$cont2]?>);background-size:100% 100%">
                                            <input class="titulo"  name="<?php echo "t".$n?>" value="<?php echo $titulo[$cont2]?>" disabled/>
                                            <input class="descricao" name="<?php echo "desc".$n?>" value="<?php echo $legenda[$cont2]?>" disabled/>
                                        </div>
                                    <?php
        
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="swiper-pagination swiper-pagination-black"></div>
                                <div class="swiper-button-next swiper-button-black"></div>
                                <div class="swiper-button-prev swiper-button-black"></div>
                            </div>
                        </div>
                    <?php 
                    }
                        
                    }}?>

        </div>



    <form method="POST"  action="./criar.php">
        <button class="btEstilo" type="submit" name='cancela'  style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">OK</button>
    </form>


</div>
</div>

 <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="./public/css/swiper.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <!-- Initialize Swiper -->
   <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      effect: 'fade',
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
</body>
   
    
    <!-- <script>
        
        function mostra(imagem,spinner){
            console.log("Carregou imagem");
            document.getElementById(imagem).style.display = "block";
            document.getElementById(spinner).style.display = "none";
        }
    </script> -->

</html>


<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ./login");	
}?>

