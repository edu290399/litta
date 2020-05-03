<?php
session_start();
include_once("conexao.php");
$btnEdita = filter_has_var(INPUT_POST, 'btnEdita');
if($btnEdita){
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $telefone1 = filter_input(INPUT_POST, 'telefone1', FILTER_SANITIZE_STRING);
    $telefone2 = filter_input(INPUT_POST, 'telefone2', FILTER_SANITIZE_STRING);
	$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $id = $_SESSION['id'];
	$sql = "UPDATE usuarios SET  sexo = ?, telefone1 = ?, telefone2 = ?, pais = ?, estado = ?, cidade = ? WHERE id = ? ";
	if( $stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "sssssss",$sexo,$telefone1,$telefone2,$pais,$estado,$cidade,$id);
    
        if(mysqli_stmt_execute($stmt) ){
            $_SESSION['msgOk'] = "Alterações salvas";
			$_SESSION['sexo'] = $sexo;
			$_SESSION['telefone1'] = $telefone1;
			$_SESSION['telefone2'] = $telefone2;
			$_SESSION['pais'] = $pais;
			$_SESSION['estado'] = $estado;
			$_SESSION['cidade'] = $cidade;
			header("Location: ../perfil.php");	
		}
		else{
            $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
			header("Location: ../perfil.php");	
		}
	} 
	else{
		echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
	}
}
else{
    $_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../register.php");
}
