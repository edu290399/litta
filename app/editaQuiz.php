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
    <form method="POST" action="./dataBaseManager/editaQuiz.php">

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
            <input class="form-control campoDefault"  value= "<?php echo $nome ?>" name="nome" required/>
        </div>

        <div class="row mb-5">
            <label>Descrição</label>
            <input type="text" class="form-control campoDefault"  value= "<?php echo $descricao?>" name="descricao" required/>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-lg-85 mw-md-100" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Clusters</h5>
                        </div>
                        <div class="modal-body mx-0 my-0">
                            <?php include_once("./dataBaseManager/conexao.php");
                                
                                $sql = "SELECT id,nome,descricao FROM cluster ORDER BY id DESC";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_query($conn, $sql)) {$cont=0;
                                while($row = mysqli_fetch_assoc($result)) { $idCluster = $row["id"]; $nome = $row["nome"]; $descricao = $row["descricao"];$cont++;
                                    $sqlBox = "SELECT id FROM quiz  WHERE (c1 = '$idCluster' OR c2 = '$idCluster' OR c3 = '$idCluster' OR c4 = '$idCluster' OR c5 = '$idCluster' OR c6 = '$idCluster' OR c7 = '$idCluster' OR c8 = '$idCluster' OR c9 = '$idCluster' OR c10 = '$idCluster' OR c11 = '$idCluster' OR c12 = '$idCluster' OR c13 = '$idCluster' OR c14 = '$idCluster' OR c15 = '$idCluster' OR c16 = '$idCluster' OR c17 = '$idCluster' OR c18 = '$idCluster' OR c19 = '$idCluster' OR c20 = '$idCluster') AND visivel = '1' ";
                                    if ($reg = mysqli_query($conn, $sqlBox)) { 
                                        $total = mysqli_num_rows($reg); ?>

                                    <div class="row mb-lg-0 mb-5">

                                        <div class="col-md-5 col-lg-5 col-12">
                                            <div class="row ">
                                                <p>Nome: </p>
                                                <strong><?php echo $nome?></strong>
                                            </div> 
                                        </div> 

                                                
                                        <div class="col-md-5 col-lg-5 col-12" >
                                            <div class="row ">
                                                <p>Descrição: </p>
                                                <strong><?php echo $descricao?></strong>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-lg-2 col-12" >
                                            <?php if($total > 0){ ?>
                                                <input  type="checkbox" value="<?php echo $idCluster?>" name="cluster[<?php echo $cont?>]" checked/>
                                                <input  type="checkbox" value="<?php echo $idCluster?>" name="clusterDelete[<?php echo $cont?>]" style="display:none" checked/>  
                                            <?php } else{ ?>
                                                <input  type="checkbox" value="<?php echo $idCluster?>" name="cluster[<?php echo $cont?>]"/>
                                                <input  type="checkbox" value="<?php echo $idCluster?>" name="clusterDelete[<?php echo $cont?>]" style="display:none" checked/>
                                            <?php } ?>
                                        </div>
                                    </div>
                            <?php
                                }}}} 
                                    }else {
                                        echo "mysqli_error($conn)";
                                    }?>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btEstilo">Adicionar<img src="./public/open-iconic/svg/check.svg" class="icon" alt="check"></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <button class="btEstilo" type="submit" name='btnCadastra' style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Salvar Quiz</button>
            </div>

        </div>
        
    </form>
    <div class="row mb-5">
            <button class="btEstilo"  id="btnAdiciona" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px" data-toggle="modal" data-target="#exampleModalCenter">Adicionar Cluster<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
    </div>
    </div>

</div>
    <form method="POST" onsubmit="return confirm('Cancelar alterações?');" action="./criar.php">
        <button class="btEstilo" type="submit" name='cancela'  style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Cancelar</button>
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

