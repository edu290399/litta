<?php
session_start();
if( $_SESSION['boss'] == '1' ){
    $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;  

    for ($controle = 0; $controle < count($arquivo['name']); $controle++){

        $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name'][$controle];
        $nome = $_FILES[ 'arquivo' ][ 'name' ][$controle];
     
        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
     
        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        
            $novoNome = uniqid ( time () ) . '.' . $extensao;
            // Concatena a pasta com o nome
            $destino = '../public/documentos/' . $novoNome;
            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                session_start();
                include_once("conexao.php");
                $id = $_SESSION['idConsulta'];
                $sql = "INSERT INTO documentos (idUsuario,endereco,nome) VALUES (?, ?, ?)";
                if( $stmt = mysqli_prepare($conn, $sql) ){
                    mysqli_stmt_bind_param($stmt, "sss", $id,$destino,$nome);
                    if(mysqli_stmt_execute($stmt)){
                        
                    } else{
                        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                    }
                } else{
                    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
                }
            }
            else{
                echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita em '.$destino;
            }

    }
    header("Location: ../documentosConsulta");    
}
else{
    $_SESSION['msgErro'] = "Página restrita";
	header("Location: ../login");
}
