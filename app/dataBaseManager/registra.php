<?php
session_start();
include_once("conexao.php");
$btnCadastra = filter_has_var(INPUT_POST, 'btnCadastra');
if($btnCadastra){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $datanas = filter_input(INPUT_POST, 'datanas', FILTER_SANITIZE_STRING);
    $telefone1 = filter_input(INPUT_POST, 'telefone1', FILTER_SANITIZE_STRING);
    $telefone2 = filter_input(INPUT_POST, 'telefone2', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
	$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
	$senha = password_hash($senha, PASSWORD_DEFAULT);
	$sql = "INSERT INTO `usuarios`( `nome`, `sobrenome`, `sexo`, `datanas`, `telefone1`, `telefone2`, `email`, `usuario`, `senha`, `pais`, `estado`, `cidade`) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?, 'Brasil', 'Goias', 'Goiania')";
	
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "sssssssss", $nome,$sobrenome,$sexo,$datanas,$telefone1,$telefone2,$email,$usuario,$senha);
	    if(mysqli_stmt_execute($stmt)){
			$_SESSION['msgOk'] = "Cadastro realizado! Olá $nome";
			header("Location: ../login.php");
		} else{
			$_SESSION['msgErro'] = "Erro no Cadastro! \n";
			header("Location: ../register.php");
		}
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
	}

}

else{
    $_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../register.php");
}
