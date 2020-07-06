<?php
    session_start();
    $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;  

    for ($controle = 0; $controle < count($arquivo['name']); $controle++){

        $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name'][$controle];
        $nome = $_FILES[ 'arquivo' ][ 'name' ][$controle];
     
        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
     
        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        if ( strstr ( '.jpg;.jpeg;.png', $extensao ) ) {
            $novoNome = uniqid ( time () ) . '.' . $extensao;
            // Concatena a pasta com o nome
            $destino = '../public/imagens/galeria/' . $novoNome;
            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                session_start();
                include_once("conexao.php");
                $id = $_SESSION['id'];
                $sql = "INSERT INTO galeria (idUsuario,endereco) VALUES (?, ?)";
                $sqlNot = "UPDATE usuarios SET notificacao = '1' WHERE id = ?";

                if($stmt = mysqli_prepare($conn, $sqlNot)){
                    mysqli_stmt_bind_param($stmt, "s", $id);
                    if(!mysqli_stmt_execute($stmt)){
                        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                    }
                }
                else{
                    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
                }
                if( $stmt = mysqli_prepare($conn, $sql) ){
                    mysqli_stmt_bind_param($stmt, "ss", $id,$destino);
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
        else{
            echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.png"<br />';
        }
    }    
    header("Location: ../galeria");

        
