<?php
session_start();
include_once("conexao.php");
$btnEdita = filter_has_var(INPUT_POST, 'btnEdita');
if($btnEdita){
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $telefone1 = filter_input(INPUT_POST, 'telefone1', FILTER_SANITIZE_STRING);
	$telefone2 = filter_input(INPUT_POST, 'telefone2', FILTER_SANITIZE_STRING);
	$datanas = filter_input(INPUT_POST, 'datanas', FILTER_SANITIZE_STRING);
	$pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_STRING);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $id = $_SESSION['id'];
	$sql = "UPDATE usuarios SET  sexo = ?, telefone1 = ?, telefone2 = ?, datanas = ?, pais = ?, estado = ?, cidade = ? WHERE id = ? ";
	if( $stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "ssssssss",$sexo,$telefone1,$telefone2,$datanas,$pais,$estado,$cidade,$id);
    
        if(mysqli_stmt_execute($stmt) ){
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
            $_SESSION['msgOk'] = "Alterações salvas";
			$_SESSION['sexo'] = $sexo;
			$_SESSION['telefone1'] = $telefone1;
			$_SESSION['telefone2'] = $telefone2;
			$_SESSION['datanas'] = $datanas;
			$_SESSION['idade'] = $idade;
			$_SESSION['pais'] = $pais;
			$_SESSION['estado'] = $estado;
			$_SESSION['cidade'] = $cidade;
			header("Location: ../perfil");	
		}
		else{
            $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
			header("Location: ../perfil");	
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
