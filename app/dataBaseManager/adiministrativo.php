<?php
session_start();
include_once("conexao.php");
$botao = filter_has_var(INPUT_POST, 'usuario');

if($botao){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$sql = "SELECT id, nome, sobrenome, sexo, datanas, telefone1, telefone2, email, usuario, senha, pais, estado, cidade, imgPerfil, dataCadastro, boss, confirmado FROM usuarios WHERE id = ?";
	$sqlNot = "UPDATE usuarios SET notificacao = '0' WHERE id = ?";

	if($stmt = mysqli_prepare($conn, $sqlNot)){
		mysqli_stmt_bind_param($stmt, "s", $usuario);
		if(!mysqli_stmt_execute($stmt)){
			echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
		}
	}
	else{
		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
	}
	if($stmt = mysqli_prepare($conn, $sql)){
		mysqli_stmt_bind_param($stmt, "s", $usuario);
	    if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_bind_result($stmt, $idConsulta,$nome,$sobrenome,$sexo,$datanas,$telefone1,$telefone2,$email,$usuario,$senha,$pais,$estado,$cidade,$imgPerfil,$dataCadastro,$boss,$confirmado);
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
			$ano = substr($dataCadastro, 0, 4);
			$mes = substr($dataCadastro, 5, 2);
			$dia = substr($dataCadastro, 8, 2);
			$hora = substr($dataCadastro, 11, 2);
			$minuto = substr($dataCadastro, 14, 2);
			$segundo = substr($dataCadastro, 17, 2);
			$dataCadastro = "$dia/$mes/$ano "; 
			$_SESSION['idConsulta'] = $idConsulta;
			$_SESSION['nomeConsulta'] = $nome;
			$_SESSION['sobrenomeConsulta'] = $sobrenome;
			$_SESSION['sexoConsulta'] = $sexo;
			$_SESSION['datanasConsulta'] = $datanas;
			$_SESSION['idadeConsulta'] = $idade;
			$_SESSION['telefone1Consulta'] = $telefone1;
			$_SESSION['telefone2Consulta'] = $telefone2;
			$_SESSION['emailConsulta'] = $email;
			$_SESSION['usuarioConsulta'] = $usuario;
			$_SESSION['paisConsulta'] = $pais;
			$_SESSION['estadoConsulta'] = $estado;
			$_SESSION['cidadeConsulta'] = $cidade;
			$_SESSION['imgPerfilConsulta'] = $imgPerfil;
			$_SESSION['dataCadastroConsulta'] = $dataCadastro;
			header("Location: ../perfilConsulta");
			// Close connection
			mysqli_close($conn);
	}else{
		$_SESSION['msg'] = "Falha na recuperacao do registro";
		header("Location: login");
	}
}
else{
	$_SESSION['msg'] = "Página não encontrada";
	header("Location: login");
}
?>

 

 
