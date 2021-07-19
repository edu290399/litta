<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Enviados</title>
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
            <a href="adiministrativo">
                <span class="option align-baseline" id="option3"> ADM <span>
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
                    <a  href="adiministrativo" >
                        <span class="modalOption"> ADM <span>
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

    
    <!-- ENTREVISTA -->
    <h2 class="mb-n1">ENVIADOS</h2>
    
    <?php
        include_once("./dataBaseManager/conexao.php");
        $idEntrevista = filter_input(INPUT_POST, 'idEntrevista', FILTER_SANITIZE_STRING);
        $sql = "SELECT idEnvio,respondido,enviadoEm,respondidoEm FROM entrevistados WHERE idPergunta = '$idEntrevista' ";

        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          $cont=0;$contPreenche=0;
          while($row = mysqli_fetch_assoc($result)) { $idEnvio = $row["idEnvio"]; $respondido =  $row["respondido"]; $enviadoEm = $row["enviadoEm"]; $respondidoEm = $row["respondidoEm"]; 
                 $sql2 =  "SELECT nome FROM usuarios INNER JOIN entrevistados ON usuarios.id = entrevistados.idUsuario WHERE idPergunta = '$idEntrevista' " ;
                         $result2 = mysqli_query($conn, $sql2);
                         if (mysqli_query($conn, $sql2)) {
                             while($row2 = mysqli_fetch_assoc($result2)) { $nome[$cont] = $row2["nome"]; $cont++;}
                        }
            else {                    
                var_dump($sql2);   
                echo "mysqli_error($conn)";
            } ?>
         
            <div class="row pl-lg-2 py-3 border-bottom border-white">

            <div class="col-md-4 col-lg-4 col-12">
                
                <p>Nome: </p>
                <strong><?php echo $nome[$contPreenche]?></strong>
                
            </div> 
    
                    
            <div class="col-md-4 col-lg-4 col-12" >
    
                <p>Enviado em: </p>
                <strong><?php echo $enviadoEm?></strong>
     
            </div>
    
            <div class="col-md-4 col-lg-4 col-12" >
                
                <?php if($respondido == '1'){ ?>
                    <p>Respondido em: </p>
                    <strong><?php echo $respondidoEm;?></strong>
                <?php;}else{?>
                    <form method="POST" action="./dataBaseManager/excluirEnvioEntrevista.php">
                        <button class="btEstilo" name="idEnvio" value="<?php echo $idEnvio?>" type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:70px;">Excluir</button>
                    </form>
                <?php;}?>

    
            </div>
            
           
        </div>
        <?php
            $contPreenche++;
            }
        }
        else{
            
            var_dump($sql);   
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
