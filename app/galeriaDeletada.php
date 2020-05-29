<?php
session_start();
?>
<?php if(!empty($_SESSION['idConsulta'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Imanges Deletadas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="./public/open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./public/css/galeria.css">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

  <!-- Demo styles -->
  <style>
    body {
      background: #fff;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color:#000;
      overflow:hidden;
    }
    .swiper-pagination-bullet:focus{
        outline:none; 
    }
    #closeBt{
      display:none;
    }

    .swiper-slide-active #closeBt{
         display: block;
    }
        
    .swiper-container {
      width: 100%;
      height:100%;
      padding-top: 150px;
      padding-bottom: 50px;    
    }
    .swiper-slide {
      background-position: center;
      background-size: cover;
      opacity: 0.3;
      width: 300px;
      height: 300px;
    }
    .swiper-slide-active{
          opacity: 1 !important;
        }

        ::-webkit-input-placeholder {
          position:relative;
          color: white;  
          text-align:center;
          top:45%;
        }
        
        textarea:-moz-placeholder { /* Firefox 18- */
          position:absolute;
          color: white;  
          text-align:center;
          top:45%;
          line-height: 250px;
        }
        
        textarea::-moz-placeholder {  /* Firefox 19+ */
          position:absolute;
          color: white;  
          text-align:center;
          top:45%;
          line-height: 250px;

        }
        
        :-ms-input-placeholder {  
          position:relative;
          color: white;  
          text-align:center;
          top:45%;
        }

        input:-moz-placeholder{
          position:relative;
          color: white;  
          text-align:center;
          top:45%;
        }

        textarea:-moz-placeholder {
          position:relative;
          color: white;  
          text-align:center;
          top:45%;
        }
     
    @media only screen and (max-width: 760px) {

        .swiper-wraper{
          width:100%;
          position:fixed;
        }
        .swiper-pagination{
          margin-left:50px; 
          margin-top: -120px; 

        }    
        .swiper-container {
          padding-top: 15vh;
          margin-top: -50px;

        }
        #photoEdit{
            top: 60px;
            left:7vw ;
        }
        .swiper-slide {
          margin-top:-275px;
          transform:  rotateX(90deg) rotateY(0deg)  !important;
          transition: transform;
          transition-duration: .5s; 
        }


        .swiper-slide-active{
          margin-bottom: 50px;
          margin-top:-50px;
          transform:  rotateX(0deg) rotateY(0deg) translate(0%, 0px)!important;
          opacity: 1 !important;
          transition: transform;
          transition-duration: .5s;
        }
        .containerGeral{
          margin-left:8%;
          margin-top:15%;
          width:90vw;
        }
        body {
        position:fixed;
      }
    }

  </style>
</head>
<body>
<nav id="navTest" class="navbar navbar-expand-md bg-white navbar-light fixed-top mb-5 ">

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
            <a href="#notJump">
                <span class="option align-baseline" id="option2"> QUIZ <span>
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
                    <a  href="index" >
                        <span class="modalOption"> QUIZ <span>
                    </a>
                    <a  href="perfilConsulta" >
                        <span class="modalOption"> VOLTAR <span>
                    </a>
                </ul>
        </div>
        </div>
    </div>   

</nav>

  <!-- Swiper -->
  <div class="containerGeral">



    <div class="swiper-container">
            <div class="mx-auto mt-n5" style="width:50px">
              <div class="row" style="margin-bottom:70px">

                <a href="galeriaConsulta">
                  <span class="option "  style="margin-left:-60px">ATIVAS <span>
                </a>

                <a href="galeriaDeletada">
                  <span class="option active" style="margin-left:60px"> DELETADAS <span>
                </a>
              </div>
            </div>
      <div class="swiper-wrapper">
      <?php
        session_start();
        include_once("./dataBaseManager/conexao.php");
        $idConsulta = $_SESSION['idConsulta'];
        $sql = "SELECT * FROM galeria WHERE idUsuario = $idConsulta AND deletada = '1' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $cont = 0;
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) { 
            $endereco = $row["endereco"]; $idImage = $row["id"];$indicacao = $row["indicacao"]; $deletadaEm = $row["deletadaEm"]; $deletada = $row["deletada"]; $deletadaPor = $row["deletadaPor"];   
            $sqlLegenda = "SELECT * FROM legendas WHERE idImagem = $idImage ORDER BY id ASC";
            ?>
          
          <div class="swiper-slide" style="background-image:url(<?php echo $endereco ?>);background-size:100% 100%">
            <?php if($indicacao == '1'){?>
              <span style="bottom: 40px!important;position: relative;font-family:bigJohn;font-weight:bold">LITTA</span>
            <?}else{?>
                <span style="bottom: 40px!important;position: relative;font-family:bigJohn;font-weight:bold">Imagem por: <?php echo $_SESSION['usuarioConsulta'] ?></span>
            <?}?>
            <?php
              			$ano = substr($deletadaEm, 0, 4);
                    $mes = substr($deletadaEm, 5, 2);
                    $dia = substr($deletadaEm, 8, 2);
                    $hora = substr($deletadaEm, 11, 2);
                    $minuto = substr($deletadaEm, 14, 2);
                    $segundo = substr($deletadaEm, 17, 2);
                    $dataDeletada = "$dia/$mes/$ano   $hora:$minuto:$segundo"; ?>
              <br><span style="bottom: 40px!important;position: relative;font-family:bigJohn;font-weight:bold">Deletada em: <strong style="letter-spacing:2px"> <?php echo $dataDeletada ?> </strong> </span>
            

                
              <div class="inside">
                      <textarea name="legenda" class="legenda" placeholder="Ainda não há comentários" id="textoLegenda" readonly  
                      <?php $resultLegenda = mysqli_query($conn, $sqlLegenda);
                        if (mysqli_query($conn, $sqlLegenda)) { ?>><?php 
                          while($row = mysqli_fetch_assoc($resultLegenda)) {
                            $idUsuario = $row["idUsuario"]; $usuario = $row["usuario"];  $legenda = $row["texto"]; $feitaEm = $row["feitaEm"]; 
                            echo $usuario.' - '.$legenda."\n"; } } ?></textarea>
                    <form method="POST" class="formulario" onsubmit="insereLegenda(event , <?php echo $cont ?>)" action="./dataBaseManager/alteraLegenda.php" > 
                      <input name="idImage" style="display:none" value="<?php echo $idImage ?>"></input>
                      <input placeholder = "Adicione um comentário" name="texto" class="comentario" id="comentario" autocomplete="off"></input>
                      <button type="submit" class="legendaBt" id="legendaBt" onclick=""><span class="oi oi-arrow-thick-right"></span></button>
                    </form>
                </div>
                <input value="Deletada por: <?php echo $deletadaPor ?> " name="naoEnvia" class="comentario" id="deletadaPor" disabled="true"></input>

            </div>
            <?php
              $cont++;
              } 
            }else {
              echo "mysqli_error($conn)";
            }?>
            
          </div>
      <div class="swiper-pagination"style="z-index:10;filter: invert(0.4) sepia(0) saturate(1) hue-rotate(0deg) brightness(0.1)"></div>
    </div>
    <div class="container-fluid">
      <button id="photoEdit" onclick="document.getElementById('arquivo').click()">Adicionar Amostra<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="pencil" style="margin-bottom:3px" ></button>
    </div>
    <form method="post" enctype="multipart/form-data" action="./dataBaseManager/recebeUploadAmostra.php" style="display:none" > 
      <input id="arquivo" name="arquivo[]" onchange="document.getElementById('salvar').click()" multiple="multiple" accept='image/*' type="file" />
      <br/>
      <input type="submit" id="salvar" value="Salvar"/>
    </form>
  </div>
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      speed: 700,
      updateOnWindowResize: true,
      direction: getDirection(),
      touchRatio: 0.35,
      touchReleaseOnEdges: true,
      centeredSlides: true,
      slidesPerView: getNumber(),
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable	: true,
      },
      on: {
        resize: function () {
          swiper.changeDirection(getDirection());
          
        }
      },
        on: {
          imagesReady:function () {
            swiper.changeDirection(getDirection());
          }
        }
    });

    function getDirection() {
      var windowWidth = window.innerWidth;
      var direction = ( (window.innerWidth / window.innerHeight ) <= 1 ? 'vertical' : 'horizontal' );
      return direction;
    }
    function getNumber() {
      var windowWidth = window.innerWidth;
      var number = window.innerWidth <= 760 ? 'auto' : 4;
      return number;
    }
    function reload() {
      console.log("reloading...");
      return location.reload();
    }
    var text = document.getElementsByClassName('legenda');
    var formularios = document.getElementsByClassName('formulario');
    var comentarios = document.getElementsByClassName('comentario');

     function insereLegenda(e,cont){
      var form = document.querySelector('form');
      e.preventDefault(); // <--- isto pára o envio da form
      var url = form.action;
      var formData = new FormData(formularios[cont]); // <--- os dados da form
      console.log(form);
      var xhttp;
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("txtHint").innerHTML = this.responseText;
        text[cont].value += this.responseText;
        comentarios[cont].value = "";
        }
      };
      xhttp.open("POST", "./dataBaseManager/alteraLegenda.php", true);
      xhttp.send(formData);
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
            window.addEventListener("orientationchange", function() {
              reload();
            });
        });
  </script>
</body>
</html>
<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ../login");	
}?>