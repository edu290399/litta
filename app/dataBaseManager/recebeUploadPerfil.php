<?php
/******
 * Upload de imagens
 ******/
 
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) { 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../public/imagens/perfil/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            session_start();
            include_once("conexao.php");
            $sql = "SELECT imgPerfil FROM usuarios WHERE id = ?";

            if( $stmt = mysqli_prepare($conn, $sql) ){
                $id = $_SESSION['id'];
                mysqli_stmt_bind_param($stmt, "s",$id);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_bind_result($stmt,$imgPerfilOld);
                    if(mysqli_stmt_fetch($stmt)){
                        mysqli_stmt_close($stmt);
                    }
                } 
                else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            }
            else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }


            $sql = "UPDATE usuarios SET imgPerfil = ? WHERE id= ?";
            
            if( $stmt = mysqli_prepare($conn, $sql) ){
                mysqli_stmt_bind_param($stmt, "ss",$destino, $id);
                if(mysqli_stmt_execute($stmt)){
                    if($imgPerfilOld != "./public/appThemes/default.png")
                        unlink($imgPerfilOld);
                    $_SESSION['imgPerfil'] = $destino;
                    header("Location: ../perfil");
                } else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            } else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita em '.$destino;
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';