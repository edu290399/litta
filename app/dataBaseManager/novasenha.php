<?php
session_start();
include_once("conexao.php");  
$btnConfirma = filter_has_var(INPUT_POST, 'btnConfirma');
if($btnConfirma){
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $email =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
	if($stmt = mysqli_prepare($conn, $sql)){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ss",$senha, $email);
	    if(mysqli_stmt_execute($stmt)){
            $_SESSION['msgOk'] = "Senha alterada com sucesso";
            header("Location: ../login");
		} else{
			echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
		}
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
	}
}
else{
	$_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../login");
}
?>