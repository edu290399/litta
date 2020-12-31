<?php
session_start();
include_once("conexao.php");
$idCluster = filter_input(INPUT_POST, 'idCluster', FILTER_SANITIZE_STRING);
$sql = "UPDATE cluster SET  visivel = 0  WHERE id = ?";
	if( $stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "s",$idCluster);
    
        if(mysqli_stmt_execute($stmt) ){
            mysqli_stmt_close($stmt);
            header("Location: ../criar");
            $_SESSION['msgOk'] = "Deletado com sucesso";

        }
        else{
            $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
			header("Location: ../criar");	
        }
    }
    else{
        echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
    }
?>