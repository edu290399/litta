<?php
session_start();
include_once("conexao.php");
$btnCadastra = filter_has_var(INPUT_POST, 'btnCadastra');
if($btnCadastra){
    $idPergunta = filter_input(INPUT_POST, 'btnCadastra', FILTER_SANITIZE_STRING);
    $idEnvio = filter_input(INPUT_POST, 'idEnvio', FILTER_SANITIZE_STRING);
    $idUsuario = $_SESSION['id'];
    $r1 = filter_input(INPUT_POST, 'r1', FILTER_SANITIZE_STRING);
    if(isset($_POST['r2'])){ $r2 = filter_input(INPUT_POST, 'r2', FILTER_SANITIZE_STRING);}else{$r2="";};
    if(isset($_POST['r3'])){ $r3 = filter_input(INPUT_POST, 'r3', FILTER_SANITIZE_STRING);}else{$r3="";};
    if(isset($_POST['r4'])){ $r4 = filter_input(INPUT_POST, 'r4', FILTER_SANITIZE_STRING);}else{$r4="";};
    if(isset($_POST['r5'])){ $r5 = filter_input(INPUT_POST, 'r5', FILTER_SANITIZE_STRING);}else{$r5="";};
    if(isset($_POST['r6'])){ $r6 = filter_input(INPUT_POST, 'r6', FILTER_SANITIZE_STRING);}else{$r6="";};
    if(isset($_POST['r7'])){ $r7 = filter_input(INPUT_POST, 'r7', FILTER_SANITIZE_STRING);}else{$r7="";};
    if(isset($_POST['r8'])){ $r8 = filter_input(INPUT_POST, 'r8', FILTER_SANITIZE_STRING);}else{$r8="";};
    if(isset($_POST['r9'])){ $r9 = filter_input(INPUT_POST, 'r9', FILTER_SANITIZE_STRING);}else{$r9="";};
    if(isset($_POST['r10'])){ $r10 = filter_input(INPUT_POST, 'r10', FILTER_SANITIZE_STRING);}else{$r10="";};
    if(isset($_POST['r11'])){ $r11 = filter_input(INPUT_POST, 'r11', FILTER_SANITIZE_STRING);}else{$r11="";};
    if(isset($_POST['r12'])){ $r12 = filter_input(INPUT_POST, 'r12', FILTER_SANITIZE_STRING);}else{$r12="";};
    if(isset($_POST['r13'])){ $r13 = filter_input(INPUT_POST, 'r13', FILTER_SANITIZE_STRING);}else{$r13="";};
    if(isset($_POST['r14'])){ $r14 = filter_input(INPUT_POST, 'r14', FILTER_SANITIZE_STRING);}else{$r14="";};
    if(isset($_POST['r15'])){ $r15 = filter_input(INPUT_POST, 'r15', FILTER_SANITIZE_STRING);}else{$r15="";};
    if(isset($_POST['r16'])){ $r16 = filter_input(INPUT_POST, 'r16', FILTER_SANITIZE_STRING);}else{$r16="";};
    if(isset($_POST['r17'])){ $r17 = filter_input(INPUT_POST, 'r17', FILTER_SANITIZE_STRING);}else{$r17="";};
    if(isset($_POST['r18'])){ $r18 = filter_input(INPUT_POST, 'r18', FILTER_SANITIZE_STRING);}else{$r18="";};
    if(isset($_POST['r19'])){ $r19 = filter_input(INPUT_POST, 'r19', FILTER_SANITIZE_STRING);}else{$r19="";};
    if(isset($_POST['r20'])){ $r20 = filter_input(INPUT_POST, 'r20', FILTER_SANITIZE_STRING);}else{$r20="";};


	$sql = "INSERT INTO respostas(idEnvio, idPergunta , idUsuario , r1 , r2 , r3 , r4 , r5 , r6 , r7 , r8 , r9 , r10 , r11 , r12 , r13 , r14 , r15 , r16 , r17 , r18 , r19 , r20) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if ($stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssss",$idEnvio,$idPergunta,$idUsuario,$r1,$r2,$r3,$r4,$r5,$r6,$r7,$r8,$r9,$r10,$r11,$r12,$r13,$r14,$r15,$r16,$r17,$r18,$r19,$r20);
                
        if(mysqli_stmt_execute($stmt)){
            $sqlRespondido = "UPDATE entrevistados SET respondido = '1' WHERE idEnvio = ? ";
            $sqlNotificacao = "UPDATE usuarios SET notificacao = '1' WHERE id= ?";
            if ( ($stmt = mysqli_prepare($conn, $sqlRespondido)) && ($stmt2 = mysqli_prepare($conn, $sqlNotificacao)) ){
                mysqli_stmt_bind_param($stmt, "s",$idEnvio);
                mysqli_stmt_bind_param($stmt2, "s",$idUsuario);
                if(mysqli_stmt_execute($stmt)){
                    $_SESSION['msgOk'] ="Entrevista Respondida";
                    mysqli_stmt_execute($stmt2);
                }
            }
            $_SESSION['msgOk'] ="Entrevista Respondida";
            $hora = date('Y-m-d H:i:s', time());
            // var_dump($hora);
            $sql2 = "UPDATE entrevistados SET respondidoEm = '$hora' WHERE idEnvio = '$idEnvio' ";
            mysqli_query($conn, $sql2);
            header("Location: ../exibeQuiz");  
        } 
        else{
            $_SESSION['msgErro'] = "Erro! \n".mysqli_error($conn);
			header("Location: ../exibeQuiz");
        }
	} 
	else{
		echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
    }

}
else{
    $_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../perfil");
}
?>
