<?php
session_start();
include_once("conexao.php");
$btnCadastra = filter_has_var(INPUT_POST, 'btnCadastra');
if($btnCadastra){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $p1 = filter_input(INPUT_POST, 'p1', FILTER_SANITIZE_STRING);
    if(isset($_POST['p2'])){ $p2 = filter_input(INPUT_POST, 'p2', FILTER_SANITIZE_STRING);}else{$p2="";};
    if(isset($_POST['p3'])){ $p3 = filter_input(INPUT_POST, 'p3', FILTER_SANITIZE_STRING);}else{$p3="";};
    if(isset($_POST['p4'])){ $p4 = filter_input(INPUT_POST, 'p4', FILTER_SANITIZE_STRING);}else{$p4="";};
    if(isset($_POST['p5'])){ $p5 = filter_input(INPUT_POST, 'p5', FILTER_SANITIZE_STRING);}else{$p5="";};
    if(isset($_POST['p6'])){ $p6 = filter_input(INPUT_POST, 'p6', FILTER_SANITIZE_STRING);}else{$p6="";};
    if(isset($_POST['p7'])){ $p7 = filter_input(INPUT_POST, 'p7', FILTER_SANITIZE_STRING);}else{$p7="";};
    if(isset($_POST['p8'])){ $p8 = filter_input(INPUT_POST, 'p8', FILTER_SANITIZE_STRING);}else{$p8="";};
    if(isset($_POST['p9'])){ $p9 = filter_input(INPUT_POST, 'p9', FILTER_SANITIZE_STRING);}else{$p9="";};
    if(isset($_POST['p10'])){ $p10 = filter_input(INPUT_POST, 'p10', FILTER_SANITIZE_STRING);}else{$p10="";};
    if(isset($_POST['p11'])){ $p11 = filter_input(INPUT_POST, 'p11', FILTER_SANITIZE_STRING);}else{$p11="";};
    if(isset($_POST['p12'])){ $p12 = filter_input(INPUT_POST, 'p12', FILTER_SANITIZE_STRING);}else{$p12="";};
    if(isset($_POST['p13'])){ $p13 = filter_input(INPUT_POST, 'p13', FILTER_SANITIZE_STRING);}else{$p13="";};
    if(isset($_POST['p14'])){ $p14 = filter_input(INPUT_POST, 'p14', FILTER_SANITIZE_STRING);}else{$p14="";};
    if(isset($_POST['p15'])){ $p15 = filter_input(INPUT_POST, 'p15', FILTER_SANITIZE_STRING);}else{$p15="";};
    if(isset($_POST['p16'])){ $p16 = filter_input(INPUT_POST, 'p16', FILTER_SANITIZE_STRING);}else{$p16="";};
    if(isset($_POST['p17'])){ $p17 = filter_input(INPUT_POST, 'p17', FILTER_SANITIZE_STRING);}else{$p17="";};
    if(isset($_POST['p18'])){ $p18 = filter_input(INPUT_POST, 'p18', FILTER_SANITIZE_STRING);}else{$p18="";};
    if(isset($_POST['p19'])){ $p19 = filter_input(INPUT_POST, 'p19', FILTER_SANITIZE_STRING);}else{$p19="";};
    if(isset($_POST['p20'])){ $p20 = filter_input(INPUT_POST, 'p20', FILTER_SANITIZE_STRING);}else{$p20="";};


    $sql = "INSERT INTO entrevistas(nome , descricao , p1 , p2 , p3 , p4 , p5 , p6 , p7 , p8 , p9 , p10 , p11 , p12 , p13 , p14 , p15 , p16 , p17 , p18 , p19 , p20) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";


	if ($stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", $nome,$descricao,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$p15,$p16,$p17,$p18,$p19,$p20);
        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msgOk'] ="Sucesso";
            header("Location: ../criar");  
        } 
        else{
			$_SESSION['msgErro'] = "Erro! \n";
			header("Location: ../criar");
        }
	} 
	else{
		echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
	}
}
else{
    $_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../register");
}
?>
