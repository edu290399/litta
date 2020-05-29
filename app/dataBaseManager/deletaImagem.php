<?php
session_start();
include_once("conexao.php");
$usuardio = $_SESSION['usuario'];
$idImage = filter_input(INPUT_POST, 'idImage', FILTER_SANITIZE_STRING);
$sql = "UPDATE galeria SET  deletada = 1 , deletadaPor = ? WHERE id = ?";
	if( $stmt = mysqli_prepare($conn, $sql) ){
		mysqli_stmt_bind_param($stmt, "ss",$usuardio,$idImage);
    
        if(mysqli_stmt_execute($stmt) ){
            mysqli_stmt_close($stmt);
            if(!isset($_SESSION['idConsulta'])){
                header("Location: ../galeria");
            }else{
                header("Location: ../galeriaConsulta");
            }
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