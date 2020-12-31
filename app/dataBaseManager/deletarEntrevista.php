<?php
session_start();
include_once("conexao.php");
$idEntrevista = filter_input(INPUT_POST, 'idEntrevista', FILTER_SANITIZE_STRING);
$sqlEntrevista = "DELETE FROM entrevistas WHERE id = ?";
$sqlEntrevistados = "DELETE FROM entrevistados WHERE idPergunta = ?";

	if( ($stmt = mysqli_prepare($conn, $sqlEntrevista))  &&  ($stmt2 = mysqli_prepare($conn, $sqlEntrevistados)) ){
		mysqli_stmt_bind_param($stmt, "s",$idEntrevista);
        mysqli_stmt_bind_param($stmt2, "s",$idEntrevista);

        if(mysqli_stmt_execute($stmt) ){
            mysqli_stmt_close($stmt);
            if(mysqli_stmt_execute($stmt2) ){
                mysqli_stmt_close($stmt2);
                $_SESSION['msgOk'] = "Deletado com Sucesso";
                header("Location: ../criar");	
            }
            else{
                $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
                header("Location: ../criar");	
            }
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