<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>LITTA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./public/css/soon.css">
  <!-- Demo styles -->


</head>
<body onload="wpp()" onresize="wpp()">
    <div id="spinner" class="text-center">
      <div class="spinner-border text-dark" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <div id="loaded">
        <img id="corpo" >
        <div class="container">
            <span>Em Breve</span>
        </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <script>
    var imagem = document.getElementById("corpo");
    corpo.addEventListener("load",function(){
        document.getElementById("spinner").style.display = "none";
        document.getElementById("corpo").style.opacity = "1";
        $(document).ready(function(){
            $('img').toggleClass('active');
            $('span').toggleClass('active');
        });
    })
    
    function wpp(){
        if( (((window.innerWidth > 0) ? window.innerWidth : screen.width) /((window.innerHeight > 0) ? window.innerHeight : screen.height)) > 1){
            document.getElementById("corpo").src =  "./public/appThemes/desktopWp/soon.jpg";
        }else{
            document.getElementById("corpo").src  =  "./public/appThemes/mobileWp/img3mbLow.jpg";
        }
    }  
  </script>
</body>
</html>