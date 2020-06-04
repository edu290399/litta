<?php
session_start();
include_once("conexao.php");
$sql = "DELETE FROM documentos WHERE id = ? ";
$id = filter_input(INPUT_POST, 'idDoc', FILTER_SANITIZE_STRING);
if(isset($_SESSION['idConsulta'])){
    if( $stmt = mysqli_prepare($conn, $sql) ){
        mysqli_stmt_bind_param($stmt, "s",$id);
        if(mysqli_stmt_execute($stmt) ){
            mysqli_stmt_close($stmt);
            header("Location: ../documentosConsulta");
        }else{
            $_SESSION['msgErro'] = "Erro ao apagar documento";
            header("Location: ../documentosConsulta");
        }
    }
    else{
        echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
    }
}else{
    $_SESSION['msgErro'] = "Faça login para continuar";
    header("Location: ../login");	
}
?>