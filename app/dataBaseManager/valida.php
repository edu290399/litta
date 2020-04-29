<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_has_var(INPUT_POST, 'btnLogin');
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senhahtml = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$sql = "SELECT  id,nome, email, senha FROM usuarios WHERE usuario = ? LIMIT 1";
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $usuario);
	    if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_bind_result($stmt, $id,$nome,$email,$senha);
		} else{
			echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
		}
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
	}
	if(mysqli_stmt_fetch($stmt)){
		if(password_verify($senhahtml, $senha)){
			$_SESSION['id'] = $id;
			$_SESSION['nome'] = $nome;
			$_SESSION['email'] = $email;
			header("Location: administrativo.php");
		}
		else{
			$_SESSION['msgErro'] = "Senha incorreta";
			header("Location: ../login.php");
		}
		// Close statement
		mysqli_stmt_close($stmt);
		
		// Close connection
		mysqli_close($link);
	}
	else{
		$sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = ? LIMIT 1";
		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $usuario);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt, $id,$nome,$email,$senha);
			} else{
				echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
			}
		} else{
			echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
		}
		if(mysqli_stmt_fetch($stmt)){
			if(password_verify($senhahtml, $senha)){
				$_SESSION['id'] = $id;
				$_SESSION['nome'] = $nome;
				$_SESSION['email'] = $email;
				header("Location: administrativo.php");
			}
			else{
				$_SESSION['msgErro'] = "Senha incorreta";
				header("Location: ../login.php");
			}				
		}
		else{
			$_SESSION['msgErro'] = "Cadastro inexistente";
			header("Location: ../login.php");
		}
		// Close statement
		mysqli_stmt_close($stmt);
		
		// Close connection
		mysqli_close($conn);
	}
}
else{
	$_SESSION['msg'] = "Página não encontrada fim";
	header("Location: login.php");
}
?>

 

 
