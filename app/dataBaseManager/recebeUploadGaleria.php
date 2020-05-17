<?php
/******
 * Upload de imagens
 ******/
$legenda = filter_input(INPUT_POST, 'legenda', FILTER_SANITIZE_STRING);
// verifica se foi enviado um arquivo
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
                if( $_SESSION['boss'] == 0 ){
                    $id = $_SESSION['id'];
                }else{
                    $id = $_SESSION['idConsulta'];
                }
                $sql = "INSERT INTO galeria (idUsuario,endereco,legenda) VALUES (?, ?,?)";
                if( $stmt = mysqli_prepare($conn, $sql) ){
                    mysqli_stmt_bind_param($stmt, "sss", $id,$destino,$legenda);
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
    
    if( $_SESSION['boss'] == 0 ){
        header("Location: ../galeria");
    }else{
        header("Location: ../galeriaConsulta");
    }
