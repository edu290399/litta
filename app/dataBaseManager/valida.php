<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_has_var(INPUT_POST, 'btnLogin');
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$result_usuario = "SELECT id, nome, email, senha FROM usuarios WHERE usuario='$usuario' LIMIT 1";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	$total = mysqli_num_rows($resultado_usuario); 
	if($total !== 0){
		$row_usuario = mysqli_fetch_assoc($resultado_usuario);
		if(password_verify($senha, $row_usuario['senha'])){
			$_SESSION['id'] = $row_usuario['id'];
			$_SESSION['nome'] = $row_usuario['nome'];
			$_SESSION['email'] = $row_usuario['email'];
			header("Location: administrativo.php");
		}
		else{
			$_SESSION['msg'] = "Login e senha incorreto 1! \n";
			$_SESSION['nome'] = $row_usuario['nome'];
			$_SESSION['total'] = total;
			header("Location: login.php");
		}
	}
	else{
		$result_usuario = "SELECT id, nome, email, senha FROM usuarios WHERE email='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$total = mysqli_num_rows($resultado_usuario); 		
		if($total !== 0){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if(password_verify($senha, $row_usuario['senha'])){
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['email'] = $row_usuario['email'];
				header("Location: administrativo.php");
			}
			else{
				$_SESSION['msg'] = "Login e senha incorreto 2!";
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['total'] = total;
				header("Location: login.php");
			}				
		}
		else{
			echo "dentro do else";
			$_SESSION['msg'] = "Login e senha incorreto 2!";
			$_SESSION['nome'] = $row_usuario['nome'];
			$_SESSION['total'] = total;
			header("Location: login.php");
		}
	}
}
else{
	$_SESSION['msg'] = "Página não encontrada fim";
	header("Location: login.php");
}
