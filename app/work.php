<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./public/css/work.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>LITTA</title>
  </head>

  <body>
    
    <nav id="navTest" class="navbar navbar-expand-md bg-white navbar-light fixed-top">

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
                    <span class="option align-baseline active" id="option1"> WORK <span>
                </a>
                <br>
                <br>
                <?php if($_SESSION['boss']==0){ ?>
                          <a  href="exibeQuiz" >
                              <span class="option align-baseline" id="option2" translate="no">QUIZ<span>
                          </a>
                        <?php
                        }else{?>
                          <a  href="criar" >
                              <span class="option align-baseline" id="option2" translate="no">CRIAR<span>
                          </a>
                  <?}?>
                <br>
                <br>
                <?php if(!empty($_SESSION['id'])){
                  if($_SESSION['boss']==0){ ?>
                    <a  href="perfil" >
                        <span class="option align-baseline" id="option3" translate="no">PERFIL<span>
                    </a>
                  <?php
                  }else{?>
                    <a  href="adiministrativo" >
                        <span class="option" id="option3" translate="no">ADM<span>
                    </a>
                  <?}
                } else{ ?>
                    <a  href="login" >
                      <span class="option" id="option3" translate="no"> LOGIN <span>
                    </a>
                <?php }?>


                <div id="navFilters">
                  <a href="#Residencial" class="filter-button" data-filter="residencial">
                    <span class="suboption align-baseline" id="suboption4" > Residencial <span>
                  </a>
                  <a href="#Produto" class="filter-button" data-filter="produto">
                    <span class="suboption align-baseline" id="suboption5" > Produto <span>
                  </a>
                  <a href="#Comercial" class="filter-button" data-filter="comercial">
                    <span class="suboption align-baseline" id="suboption6" > Comercial <span>
                  </a>
                  <a href="#Cenografia" class="filter-button" data-filter="cenografia">
                    <span class="suboption align-baseline" id="suboption7" > Cenografia <span>
                  </a>
                  <a href="#Todos" class="filter-button" data-filter="todos">
                    <span class="suboption align-baseline active" id="suboption8" > Todos <span>
                  </a>
              </div>
        </ul>

      </div>
      
      <div class="modal  fade" id="myModal" >

          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content d-block text-centered" style="border:none !important">
                    <ul class="navbar-nav ">
                      <a  href="work" >
                          <span class="modalOption"> WORK <span>
                      </a>
                      <?php if($_SESSION['boss']==0){ ?>
                          <a  href="exibeQuiz" >
                              <span class="modalOption" translate="no">QUIZ<span>
                          </a>
                        <?php
                        }else{?>
                          <a  href="criar" >
                              <span class="modalOption" translate="no">CRIAR<span>
                          </a>
                        <?}?>
                      <?php if(!empty($_SESSION['id'])){
                        if($_SESSION['boss']==0){ ?>
                          <a  href="perfil" >
                              <span class="modalOption" translate="no">PERFIL<span>
                          </a>
                        <?php
                        }else{?>
                          <a  href="adiministrativo" >
                              <span class="modalOption" translate="no">ADM<span>
                          </a>
                        <?}
                      } else{ ?>
                          <a  href="login" >
                            <span class="modalOption" translate="no"> LOGIN <span>
                          </a>
                      <?php }?>
                    </ul>
            </div>
          </div>
      </div>
      <br>
      <br>
      <br>      
    </nav>   

    <div class="container-fluid">

      <div class="row">
        <div class="col-xl-4 col-lg-6 filter residencial todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/residencial/esmeralda/esmeralda1.JPG" title="Esmeralda"  alt="Esmeralda">
                <div class="carousel-caption">
                  <h3>Esmeralda 01</h3>
                  <p>2020</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/esmeralda/esmeralda2.JPG" title="Esmeralda"  alt="Esmeralda" >
                <div class="carousel-caption">
                  <h3>Esmeralda 02</h3>
                  <p>2019</p>
                </div>   
              </div>
            </div>  
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 filter residencial todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/residencial/geometrizacao/geometrizacao1.JPG" title="Geometria"  alt="Geometria">
                <div class="carousel-caption">
                  <h3>Geometrização 01</h3>
                  <p>2019</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/geometrizacao/geometrizacao2.JPG" title="Geometria"  alt="Geometria">
                <div class="carousel-caption">
                  <h3>Geometrização 02</h3>
                  <p>2020</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/geometrizacao/geometrizacao3.JPG" title="Geometria"  alt="Geometria">
                <div class="carousel-caption">
                  <h3>Geometrização 03</h3>
                  <p>2020</p>
                </div>
              </div> 
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/geometrizacao/geometrizacao4.JPG" title="Geometria"  alt="Geometria">
                <div class="carousel-caption">
                  <h3>Geometrização 04</h3>
                  <p>2019</p>
                </div>    
              </div>
            </div>  
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 filter residencial todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/residencial/goth/goth1.JPG" title="Goth"  alt="Goth">
                <div class="carousel-caption">
                  <h3>Goth 01</h3>
                  <p>2016</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/goth/goth2.JPG" title="Goth"  alt="Goth">
                <div class="carousel-caption">
                  <h3>Goth 02</h3>
                  <p>2017</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/residencial/goth/goth3.JPG" title="Goth"  alt="Goth">
                <div class="carousel-caption">
                  <h3>Goth 03</h3>
                  <p>2020</p>
                </div>   
              </div>
            </div>  
          </div>
        </div>
     

        <!-- >>>>>>>>>>>>>>>>ROW<<<<<<<<<<<<<< -->

      
        <div class="col-xl-4 col-lg-6 filter produto todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="intro" >
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble1.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 01</h3>
                  <p>2015</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble2.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 02</h3>
                  <p>2017</p>
                </div>    
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble3.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 03</h3>
                  <p>2017</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble4.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 04</h3>
                  <p>2018</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble5.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 05</h3>
                  <p>2019</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/bubble/bubble6.JPG" title="Bubble"  alt="Bubble">
                </a>
                <div class="carousel-caption">
                  <h3>Bubble 06</h3>
                  <p>2020</p>
                </div>   
              </div>
            </div>  
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 filter produto todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/produto/puff/puff1.JPG" title="Puff" alt="Puff">
                <div class="carousel-caption">
                  <h3>Puff 01</h3>
                  <p>2016</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/puff/puff2.JPG" title="Puff" alt="Puff">
                <div class="carousel-caption">
                  <h3>Puff 02</h3>
                  <p>2017</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/puff/puff3.JPG" title="Puff" alt="Puff">
                <div class="carousel-caption">
                  <h3>Puff 03</h3>
                  <p>2018</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/puff/puff4.JPG" title="Puff" alt="Puff">
                <div class="carousel-caption">
                  <h3>Puff 04</h3>
                  <p>2019</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/produto/puff/puff5.JPG" title="Puff" alt="Puff">
                <div class="carousel-caption">
                  <h3>Puff 05</h3>
                  <p>2017</p>
                </div>   
              </div>
            </div>  
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 filter comercial todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/comercial/ovni/ovni1.JPG" title="Ovni" alt="Ovni">
                <div class="carousel-caption">
                  <h3>Ovni 01</h3>
                  <p>2017</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/comercial/ovni/ovni2.JPG" title="Ovni" alt="Ovni">
                <div class="carousel-caption">
                  <h3>Ovni 02</h3>
                  <p>2018</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/comercial/ovni/ovni3.JPG" title="Ovni" alt="Ovni">
                <div class="carousel-caption">
                  <h3>Ovni 03</h3>
                  <p>2019</p>
                </div>  
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/comercial/ovni/ovni4.JPG" title="Ovni" alt="Ovni">
                <div class="carousel-caption">
                  <h3>Ovni 04</h3>
                  <p>2020</p>
                </div>  
              </div>
            </div>  
          </div>
        </div>
        
        <!-- >>>>>>>>>>>>>>>>ROW<<<<<<<<<<<<<< -->


        <div class="col-xl-4 col-lg-6 filter cenografia todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/cenografia/canos/canos1.JPG" title="Canos"  alt="Canos">
                <div class="carousel-caption">
                  <h3>Canos 01</h3>
                  <p>2019</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/cenografia/canos/canos2.JPG" title="Canos"  alt="Canos">
                <div class="carousel-caption">
                  <h3>Canos 02</h3>
                  <p>2019</p>
                </div>  
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/cenografia/canos/canos3.JPG" title="Canos"  alt="Canos">
                <div class="carousel-caption">
                  <h3>Canos 03</h3>
                  <p>2020</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/cenografia/canos/canos4.JPG" title="Canos"  alt="Canos">
                <div class="carousel-caption">
                  <h3>Canos 04</h3>
                  <p>2020</p>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <div class="col-xl-4 col-lg-6 filter todos">
          <div class="carousel slide carousel-fade" data-pause="hover" data-interval="6000" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./public/appThemes/carouselPics/ripas/ripas1.JPG" title="Ripas" alt="Ripas">
                <div class="carousel-caption">
                  <h3>Ripas 01</h3>
                  <p>2019</p>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/ripas/ripas2.JPG" title="Ripas" alt="Ripas">
                <div class="carousel-caption">
                  <h3>Ripas 02</h3>
                  <p>2019</p>
                </div> 
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/ripas/ripas3.JPG" title="Ripas" alt="Ripas">
                <div class="carousel-caption">
                  <h3>Ripas 03</h3>
                  <p>2020</p>
                </div>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/ripas/ripas4.JPG" title="Ripas" alt="Ripas">
                <div class="carousel-caption">
                  <h3>Ripas 04</h3>
                  <p>2020</p>
                </div>
                </div>   
              </div>
              <div class="carousel-item">
                <img src="./public/appThemes/carouselPics/ripas/ripas5.JPG" title="Ripas" alt="Ripas">
                <div class="carousel-caption">
                  <h3>Ripas 05</h3>
                  <p>2020</p>
                </div>
                </div>   

        </div>
        <div class="col-xl-4 col-lg-6 filter">
        </div>

    </div>
    

</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>

<script>


    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
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