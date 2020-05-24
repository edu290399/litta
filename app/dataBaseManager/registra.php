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
	$sql = "INSERT INTO `usuarios`( `nome`, `sobrenome`, `sexo`, `datanas`, `telefone1`, `telefone2`, `email`, `usuario`, `senha`, `pais`, `estado`, `cidade`) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,?, ?,?,?)";
	$sqlUsuario = "SELECT id FROM usuarios where usuario = ? LIMIT 1";
	$sqlEmail = "SELECT id FROM usuarios where email = ? AND confirmado = '1' LIMIT 1";
	if( ($stmt = mysqli_prepare($conn, $sql)) && ($stmtUsuario = mysqli_prepare($conn, $sqlUsuario)) && ($stmtEmail = mysqli_prepare($conn,$sqlEmail)) ){
		mysqli_stmt_bind_param($stmt, "ssssssssssss", $nome,$sobrenome,$sexo,$datanas,$telefone1,$telefone2,$email,$usuario,$senha,$pais,$estado,$cidade);
		mysqli_stmt_bind_param($stmtEmail, "s", $email);
		mysqli_stmt_bind_param($stmtUsuario, "s", $usuario);
		if( mysqli_stmt_execute($stmtEmail) ){
			mysqli_stmt_bind_result($stmtEmail, $email);
		} 
		else{
			echo "ERROR: Could not execute query: Consulta no BD de email. \n" .  mysqli_stmt_error($stmtEmail) . "\n"  .mysqli_error($conn);
		}
		if(mysqli_stmt_fetch($stmtEmail)){
			$_SESSION['msgErro'] = "Email já está em uso \n";
			$_SESSION['nome'] = $nome;
			$_SESSION['sobrenome'] = $sobrenome;
			$_SESSION['sexo'] = $sexo;
			$_SESSION['datanas'] = $datanas;
			$_SESSION['telefone1'] = $telefone1;
			$_SESSION['telefone2'] = $telefone2;
			$_SESSION['usuario'] = $usuario;
			$_SESSION['pais'] = $pais;
			$_SESSION['estado'] = $estado;
			$_SESSION['cidade'] = $cidade;

			header("Location: ../register");
		}
		else{
			if(mysqli_stmt_execute($stmtUsuario) ){
				mysqli_stmt_bind_result($stmtUsuario, $usuario);
			}
			else{
				echo "ERROR: Could not execute query: Consulta no BD de usuario \n" .  mysqli_stmt_error($stmtUsuario) . "\n"  .mysqli_error($conn);
			}
			if(mysqli_stmt_fetch($stmtUsuario)){
				$_SESSION['msgErro'] = "Usuario já existe \n";
				$_SESSION['nome'] = $nome;
				$_SESSION['sobrenome'] = $sobrenome;
				$_SESSION['sexo'] = $sexo;
				$_SESSION['datanas'] = $datanas;
				$_SESSION['telefone1'] = $telefone1;
				$_SESSION['telefone2'] = $telefone2;
				$_SESSION['email'] = $email;
				$_SESSION['pais'] = $pais;
				$_SESSION['estado'] = $estado;
				$_SESSION['cidade'] = $cidade;
				header("Location: ../register");				
			}
			else{
				if(mysqli_stmt_execute($stmt)){
					$link = "https://littadesign.com/confirmacaoCadastro?utilizador=$usuario";
					if( mail($email, 'Cadastro LITTA', 'Olá '.$email.', clique aqui para confirmar o cadastro '.$link) ){
						$_SESSION['msgOk'] ="Verifique a caixa de entrada de <br> <strong> $email </strong> <br>Para confirmar o cadastro <br>Caso não encontre, verifique seus spams.";
						header("Location: ../login");  
					  } else {
						echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
					 }
					header("Location: ../login");
				} else{
					$_SESSION['msgErro'] = "Erro no Cadastro! \n";
					header("Location: ../register");
				}
			}
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
