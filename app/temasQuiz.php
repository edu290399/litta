<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){  unset($_SESSION['idConsulta']); unset($_SESSION['idCluster'])?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Criar</title>
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
            <a href="#">
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
                    <a  href="#" >
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

    
    <div class="row mb-5 ml-1" style="text-align:center">
        <div class="col-lg-4 col-12">
            <div class="row mb-5">
                    <button class="btEstiloGrande"  id="btnAdiciona" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px" data-toggle="modal" data-target="#exampleModalCenter">Adicionar tema de Quiz<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
            </div>

            <form method="POST" action="./dataBaseManager/novoTema.php">
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-lg-85 mw-md-100" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title w-100"" id="exampleModalCenterTitle">Adicionar Tema</h5>
                            </div>
                            <div class="modal-body mx-0 my-0">      
                                <div class="row mb-lg-0 mb-5">
                                        <input class="w-100 text-center" name="nomeTema"/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btEstilo mr-auto " data-dismiss="modal">Cancelar</button>
                                <button type="submit" name="switch" value="1" class="btEstilo">Adicionar<img src="./public/open-iconic/svg/check.svg" class="icon" alt="check"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4 col-12">
            <form method="POST" action="./novoQuiz">
                <button class="btEstiloGrande" name="usuario" value=" <?php echo $id?> " type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Criar Quiz<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
            </form>    
        </div>

        <div class="col-lg-4 col-12">
            <form method="POST" action="./todosQuiz">
                <button class="btEstiloGrande" name="idTema" value='1' type="submit" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Ver Quiz<img src="./public/open-iconic/svg/eye.svg" class="icon" alt="eye"></button>
            </form>    
        </div>

    </div> 


<!-- QUIZ -->
<h2 class="mt-5 mb-n1">TEMAS DE QUIZ</h2>
    
    <?php
        include_once("./dataBaseManager/conexao.php");
        
        $sql = "SELECT id, nome FROM temaQuiz ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) { $id = $row["id"]; $nome = $row["nome"]?>
            


            <div class="row pl-lg-2 py-3 border-bottom border-white">

                <div class="col-md-5 col-lg-5 col-12">
                    <p>Tema: </p>
                    <strong><?php echo $nome?></strong>        
                </div> 

                <div class="col-md-5 col-lg-5 col-12">
                    <form method="POST" action="./linkTemaQuiz">
                        <input value="<?php echo $nome?>" name="nome" style="display:none"/>  
                        <button class="btEstiloGrande"  id="btnAdiciona" name="idTema" value=" <?php echo $id?> " style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Adicionar ao Tema<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
                    </form> 
                </div> 

            
                <div class="col-md-2 col-lg-2 ml-lg-n5 mt-lg-n1 col-12" style="text-align:left" >
                    <form method="POST" action="./criarQuiz">
                        <button type="submit" class="btEstilo" name="idTema" value=" <?php echo $id?> " style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px;">Consulta</button>
                    </form>    
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
