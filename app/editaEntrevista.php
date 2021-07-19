<?php
session_start();
?>
<?php if(!empty($_SESSION['id'])){  unset($_SESSION['idConsulta']);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Nova Entrevista</title>
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


<div class="container-fluid" >

    
    <h2 style="text-align:center">EDITAR ENTREVISTA </h2>

    <div class="container-fluid">
        <form method="POST" action="./dataBaseManager/editaEntrevista.php">

            <?php
                include_once("./dataBaseManager/conexao.php");
                $idEntrevista = filter_input(INPUT_POST, 'idEntrevista', FILTER_SANITIZE_STRING);
                $sql = "SELECT * FROM entrevistas WHERE id = $idEntrevista ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_query($conn, $sql)) { 
                    while($row = mysqli_fetch_assoc($result)) { $cont = 1; $contValido=0; $id = $row["id"]; $nome = $row["nome"]; $descricao = $row["descricao"]; 
            ?>

                <div class="row">
                    <label>Nome da Entrevista</label>
                    <input class="form-control campoDefault"  value= "<?php echo $nome ?>" placeholder="Campo obrigatório" name="nome" required/>
                </div>
                <div class="row mb-5">
                    <label>Descrição</label>
                    <input type="text" class="form-control campoDefault"  value= "<?php echo $descricao?>" placeholder="Campo obrigatório" name="descricao" required/>
                </div>

                <?php while($cont <= 20) { $pergunta = "p".$cont; if($row["$pergunta"]!=""){ $contValido++; $perguntaValida = "p".$contValido; ?>

                    <div class="row">
                        <label>Pergunta <?php echo $cont ?></label>
                        <input class="form-control campoDefault" value= "<?php echo $row["$pergunta"]?>" placeholder="Campo obrigatório" name="<?php echo $perguntaValida?>"/>
                    </div>
                <?php 
                    }
                    $cont++;
            }}}?>

        <div id="imendaHTML"></div>       
        <button class="btEstilo" id="btnAdiciona" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Nova Pergunta<img src="./public/open-iconic/svg/plus.svg" class="icon" alt="plus"></button>
        <button class="btEstilo" type="submit" name='btnEdita' value="<?php echo $idEntrevista ?>" style="padding-left: 10px; padding-right:10px;width:100px;margin-left:2px">Salvar Entrevista</button>

            </div>

        </form>
    </div>

</div>

</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>


var idContador = <?php echo $contValido ?>;
console.log(idContador);	
	function exclui(id){
		var campo = $("#"+id.id);
		campo.hide(200);
	}

	$( document ).ready(function() {
		
		$("#btnAdiciona").click(function(e){
			e.preventDefault();
			adicionaCampo();
		})
		

		
		function adicionaCampo(){

			idContador++;
			
            if(idContador <= 20){
                var idCampo = "pid"+idContador;
                var nomeCampo = "p"+idContador;
                var idForm = "formExtra"+idContador;
            
                var html = "";

                html += "<div style='margin-top: 8px;' class='input-group' id='"+idForm+"'>";
                html += "<input type='text' id='"+idCampo+"' name='"+nomeCampo+"' class='form-control novoCampo' placeholder='Nova Pergunta'/>";
                html += "<span class='input-group-btn'>";
                html +=	"<button class='btn' onclick='exclui("+idForm+")' type='button'> <img src='./public/open-iconic/svg/x.svg' class='icon' alt='close'></button>";
                html += "</span>";
                html += "</div>";
                
                $("#imendaHTML").append(html);
            }else{
                alert("Uma entrevista pode ter no máximo 20 perguntas");
            }
		}
		
		$(".btnExcluir").click(function(){
			console.log("clicou");
			$(this).slideUp(200);
		})
		
		$("#btnSalvar").click(function(){
		
		var mensagem = "";
		var novosCampos = [];
		var camposNulos = false;
		
			$('.campoDefault').each(function(){
				if($(this).val().length < 1){
					camposNulos = true;
				}
			});
			$('.novoCampo').each(function(){
				if($(this).is(":visible")){
					if($(this).val().length < 1){
						camposNulos = true;
					}
					//novosCampos.push($(this).val());
					mensagem+= $(this).val()+"\n";
				}
			});
			
			if(camposNulos == true){
				alert("Atenção: existem campos nulos");
			}else{
				alert("Novos campos adicionados: \n\n "+mensagem);
			}
			
			novosCampos = [];
		})
		
	});

    </script>
</html>


<?php }else{
	$_SESSION['msgErro'] = "Faça login para continuar";
	header("Location: ./login");	
}?>

