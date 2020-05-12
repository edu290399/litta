<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Galeria</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
      margin: 0;
      padding: 0;
      overflow:hidden;
    }
    .swiper-pagination-bullet:focus{
        outline:none; 
    }

    .swiper-container {
      width: 100%;
      height:100%;
      padding-top: 30vh;
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


    
    @media only screen and (max-width: 760px) {

        .swiper-wraper{
          width:100%;
        }
        .swiper-pagination{
          margin-left:50px; 
          margin-top: -30%; 

        }    
        .swiper-container {
          padding-top: 15vh;
          
        }
        #photoEdit{
            top: 60px;
            left:7vw ;
        }
        .swiper-slide {
          margin-top:-275px;
          transform:  rotateX(90deg) rotateY(0deg)   !important;
          transition: transform;
          transition-duration: .5s; 
          transition: transform;
        }
        .swiper-slide-active{
          margin-bottom: 140px;
          margin-top:-80px;
          transform:  rotateX(0deg) rotateY(0deg) !important;
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
<body onresize="reload()">
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
            <a href="./dataBaseManager/sair.php">
                <span class="option align-baseline" id="option3"> SAIR <span>
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
                    <a  href="./dataBaseManager/sair.php" >
                        <span class="modalOption"> SAIR <span>
                    </a>
                </ul>
        </div>
        </div>
    </div>   

</nav>

  <!-- Swiper -->
  <div class="containerGeral">

    <button id="photoEdit" onclick="document.getElementById('arquivo').click()">Adicionar Imagem<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="pencil" style="margin-bottom:3px" ></button>

    <form method="post" enctype="multipart/form-data" action="./dataBaseManager/recebeUploadGaleria.php" style="display:none" > 
                  <input id="arquivo" name="arquivo" onchange="document.getElementById('salvar').click()" multiple accept='image/*' type="file" />
                  <br />
                  <input type="submit" id="salvar" value="Salvar"/>
    </form>
    
    <div class="swiper-container">
      <div class="swiper-wrapper">
      <?php
        include_once("./dataBaseManager/conexao.php");
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM galeria WHERE idUsuario = $id ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
          while($row = mysqli_fetch_assoc($result)) { $endereco = $row["endereco"]; ?>
             <div class="swiper-slide" style="background-image:url(<?php echo $endereco ?>);background-size:100% 100%"></div>
        <?php
          } 
        }else {
          echo "mysqli_error($conn)";
        }?>
      </div>
      <div class="swiper-pagination"style="z-index:10;filter: invert(0.4) sepia(0) saturate(1) hue-rotate(0deg) brightness(0.1)"></div>
    </div>
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
      var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';
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
  </script>
</body>
</html>
<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ../login");	
}?>