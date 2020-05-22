<?php
session_start();
include_once("conexao.php");
$idUsuario = $_SESSION['id'];
$idImage = filter_input(INPUT_POST, 'idImage', FILTER_SANITIZE_STRING);
$sql = "UPDATE galeria SET  deletada = 1 WHERE id = ? AND idUsuario = ?";
	if( $stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "ss",$idImage,$idUsuario);
    
        if(mysqli_stmt_execute($stmt) ){
            mysqli_stmt_close($stmt);
            header("Location: ../galeria");
        }
        else{
            $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
			header("Location: ../galeria");	
        }
    }
    else{
        echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
    }
?>