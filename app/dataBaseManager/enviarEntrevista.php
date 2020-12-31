<?php
session_start();
include_once("conexao.php");
$btnEnvia = filter_has_var(INPUT_POST, 'btnEnvia');
if($btnEnvia){
    $idUsuario =  filter_input(INPUT_POST, 'idUsuario', FILTER_SANITIZE_STRING);
    $idEntrevista = filter_input(INPUT_POST, 'btnEnvia', FILTER_SANITIZE_STRING);
    
    $sql = "INSERT INTO entrevistados(idUsuario,idPergunta) VALUES (?,?)";

	if ($stmt = mysqli_prepare($conn, $sql) ){

        mysqli_stmt_bind_param($stmt, "ss", $idUsuario,$idEntrevista);

        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msgOk'] ="Enviado";
            header("Location: ../criar");  
        } 
        else{
			$_SESSION['msgErro'] = "Erro! \n ]" . mysqli_error($conn);;
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
