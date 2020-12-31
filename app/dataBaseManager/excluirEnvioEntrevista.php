<?php
session_start();
include_once("conexao.php");
$btnExclui = filter_has_var(INPUT_POST, 'idEnvio');
if($btnExclui){
    $idEnvio =  filter_input(INPUT_POST, 'idEnvio', FILTER_SANITIZE_STRING);    
    $sql = "DELETE FROM entrevistados WHERE idEnvio = ?";

	if ($stmt = mysqli_prepare($conn, $sql) ){

        mysqli_stmt_bind_param($stmt, "s", $idEnvio);

        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msgOk'] = "Envio Excluído";
            header("Location: ../criar");  
        } 
        else{
			$_SESSION['msgErro'] = "Erro ao excluir \n ]" . mysqli_error($conn);;
			header("Location: ../criar");
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
?>