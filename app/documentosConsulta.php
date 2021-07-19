<?php
session_start();
?>

<?php if(!empty($_SESSION['idConsulta'])){?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LiitaDocs</title>
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

            <a href="criar">
                <span class="option align-baseline" id="option2"> CRIAR <span>
            </a>

            <br>
            <br>

            <a href="perfilConsulta">
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
                    <a  href="perfilConsulta" >
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

    <h2 class="ml-sm-0 ml-md-3">Documentos p/ <?php echo $_SESSION['nomeConsulta']?></h2>
    
    <div class="container-fluid">
        <button id="addDoc" onclick="document.getElementById('arquivo').click();">Adicionar Documento<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="pencil" style="margin-bottom:3px" ></button>
    </div>

    <div id="spinner" class="text-center" style="display:none">
      <div class="spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <form method="post" onsubmit="carregando();" enctype="multipart/form-data" action="./dataBaseManager/recebeUploadDocumento.php" style="display:none" > 
      <input id="arquivo" name="arquivo[]" onchange="document.getElementById('salvar').click()" multiple="multiple" type="file" />
      <br/>
      <input type="submit" id="salvar" value="Salvar"/>
    </form>

    <?php
        include_once("./dataBaseManager/conexao.php");
        $idConsulta = ($_SESSION['idConsulta']);
        $sql = "SELECT * FROM documentos WHERE idUsuario = $idConsulta ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) {  
            $endereco =  $row["endereco"]; 
            $nome =  $row["nome"]; 
            $dataCriacao = $row["dataCriacao"]; 
            $idDoc = $row["id"];
            $visivel=$row["visivel"];  
            $ano = substr($dataCriacao, 0, 4);
            $mes = substr($dataCriacao, 5, 2);
            $dia = substr($dataCriacao, 8, 2);
            $hora = substr($dataCriacao, 11, 2);
            $minuto = substr($dataCriacao, 14, 2);
            $segundo = substr($dataCriacao, 17, 2);
            $dataCriacao = "$dia/$mes/$ano   $hora:$minuto:$segundo"; 

    ?>

    <div class="row pl-lg-2 py-3 border-bottom border-white">

        <div class="col-md-5 col-lg-5 col-12" >

            <div class="row ml-0">
                <p>Nome: </p>
                <strong style="  max-width: 25ch;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo $nome?></strong>
            </div>

            <div class="row ml-0" >
                <form method="POST" action="./dataBaseManager/visibilidadeDocumento.php">
                    <input type="checkbox" name="visivel" onclick="this.form.submit()"  <?php if ($visivel == '1') {?> checked  <?php } ?> ><img src="./public/open-iconic/svg/eye.svg" class="icon" alt="eye" style="margin-top:-26px"></button>
                    <input value = "<?php echo $idDoc?>" name="idDoc" style="display:none"/>
                </form> 
            </div> 

        </div> 

                
        <div class="col-md-5 col-lg-5 col-12 " >
            <p>Upload em: </p>
            <strong style="letter-spacing:2px"><?php echo $dataCriacao?></strong>
        </div>
        
        <div class="col-md-2 col-lg-2 ml-lg-n5 mt-lg-n1 ml-3 col-12" style="text-align:left" >

            <div class="row" style="text-align:left" >
                <form method="POST" action="./documentos/<?php echo $endereco?>">
                    <button class="btEstilo" name="usuario" value=" <?php echo $id?> " type="submit" style="padding-left: 10px; padding-right:10px;width:120px;margin-left:2px">Download<img src="./public/open-iconic/svg/data-transfer-download.svg" class="icon" alt="pencil"></button>
                </form>    

                <form method="POST" onsubmit="return confirm('O documento será deletado, tem certeza?');" action="./dataBaseManager/deletaDocumento.php">
                    <input value = "<?php echo $idDoc?>" name="idDoc" style="display:none"/>
                    <button type="submit" style="border:none!important"> <img src="./public/open-iconic/svg/x.svg" class="icon" alt="close" style="margin-top:10px !important"></button>
                </form>    

            </div>

        </div>  
       
    </div>

    <?php
        } 
    }else {
        echo "mysqli_error($conn)";
    }?>
        
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

        function carregando() {
            document.getElementById("addDoc").style.display = "none";
            document.getElementById("spinner").style.display = "block";
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
