<?php
session_start();
include_once("conexao.php");
if(isset($_SESSION['idConsulta'])){
    $visivel = (isset($_POST['visivel']) == '1' ? '1' : '0');
    $idDoc = filter_input(INPUT_POST, 'idDoc', FILTER_SANITIZE_STRING);
    $sql = "UPDATE documentos SET  visivel = ? WHERE id = ?";
        if( $stmt = mysqli_prepare($conn, $sql) ){
            mysqli_stmt_bind_param($stmt, "ss",$visivel,$idDoc);
        
            if(mysqli_stmt_execute($stmt) ){
                mysqli_stmt_close($stmt);
                header("Location: ../documentosConsulta");
        
            }
            else{
                $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
                header("Location: ../documentosConsulta");	
            }
        }
        else{
            echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
        }
}
else{
    $_SESSION['msgErro'] = "Faça login para continuar";
    header("Location: ../login");	
}
?>