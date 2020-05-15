<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_has_var(INPUT_POST, 'btnLogin');
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senhahtml = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	$sql = "SELECT  id,nome,sobrenome,sexo,datanas,telefone1,telefone2,email,usuario, senha, pais,estado,cidade,imgPerfil,boss FROM usuarios WHERE usuario = ? LIMIT 1";
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $usuario);
	    if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_bind_result($stmt, $id,$nome,$sobrenome,$sexo,$datanas,$telefone1,$telefone2,$email,$usuario,$senha,$pais,$estado,$cidade,$imgPerfil,$boss);
		} else{
			echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
		}
	} else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
	}
	if(mysqli_stmt_fetch($stmt)){
			mysqli_stmt_close($stmt);
			$dia = substr($datanas, 0, 2);
			$mes = substr($datanas, 3, 2);
			$ano = substr($datanas, 6, 4);
			$dataSql = "$ano-$mes-$dia";
			$sql = "SELECT TIMESTAMPDIFF(YEAR,'$dataSql',CURRENT_DATE) AS idade";
			$result = mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sql)) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$idade =  $row["idade"];
				}
			} else {
				echo mysqli_error($conn);
			}
		if(password_verify($senhahtml, $senha)){
			$_SESSION['id'] = $id;
			$_SESSION['boss'] = $boss;
			$_SESSION['nome'] = $nome;
			$_SESSION['sobrenome'] = $sobrenome;
			$_SESSION['sexo'] = $sexo;
			$_SESSION['datanas'] = $datanas;
			$_SESSION['idade'] = $idade;
			$_SESSION['telefone1'] = $telefone1;
			$_SESSION['telefone2'] = $telefone2;
			$_SESSION['email'] = $email;
			$_SESSION['usuario'] = $usuario;
			$_SESSION['pais'] = $pais;
			$_SESSION['estado'] = $estado;
			$_SESSION['cidade'] = $cidade;
			$_SESSION['imgPerfil'] = $imgPerfil;
			header("Location: ../perfil");
		}
		else{
			$_SESSION['msgErro'] = "Senha incorreta";
			header("Location: ../login");
		}
		// Close statement
		mysqli_stmt_close($stmt);
		
		// Close connection
		mysqli_close($conn);
	}
	else{
		$sql = "SELECT id,nome,sobrenome,sexo,datanas,telefone1,telefone2,email,usuario, senha, pais,estado,cidade,imgPerfil FROM usuarios WHERE email = ? LIMIT 1";
		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $usuario);
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt, $id,$nome,$sobrenome,$sexo,$datanas,$telefone1,$telefone2,$email,$usuario,$senha,$pais,$estado,$cidade,$imgPerfil,$boss);
			} else{
				echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
			}
		} else{
			echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
		}
		if(mysqli_stmt_fetch($stmt)){
			mysqli_stmt_close($stmt);
			$dia = substr($datanas, 0, 2);
			$mes = substr($datanas, 3, 2);
			$ano = substr($datanas, 6, 4);
			$dataSql = "$ano-$mes-$dia";
			$sql = "SELECT TIMESTAMPDIFF(YEAR,'$dataSql',CURRENT_DATE) AS idade";
			$result = mysqli_query($conn, $sql);
			if (mysqli_query($conn, $sql)) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$idade =  $row["idade"];
				}
			} else {
				echo mysqli_error($conn);
			}
		if(password_verify($senhahtml, $senha)){
			$_SESSION['id'] = $id;
			$_SESSION['boss'] = $boss;
			$_SESSION['nome'] = $nome;
			$_SESSION['sobrenome'] = $sobrenome;
			$_SESSION['sexo'] = $sexo;
			$_SESSION['datanas'] = $datanas;
			$_SESSION['idade'] = $idade;
			$_SESSION['telefone1'] = $telefone1;
			$_SESSION['telefone2'] = $telefone2;
			$_SESSION['email'] = $email;
			$_SESSION['usuario'] = $usuario;
			$_SESSION['pais'] = $pais;
			$_SESSION['estado'] = $estado;
			$_SESSION['cidade'] = $cidade;
			$_SESSION['imgPerfil'] = $imgPerfil;
			header("Location: ../perfil");
		}
			else{
				$_SESSION['msgErro'] = "Senha incorreta";
				header("Location: ../login");
			}				
		}
		else{
			$_SESSION['msgErro'] = "Cadastro inexistente";
			header("Location: ../login");
		}
		// Close statement
		mysqli_stmt_close($stmt);
		
		// Close connection
		mysqli_close($conn);
	}
}
else{
	$_SESSION['msg'] = "Página não encontrada fim";
	header("Location: login");
}
?>

 

 
