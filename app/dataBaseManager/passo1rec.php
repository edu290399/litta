<?php
  session_start();
  if( !empty($_POST) ){
    // processar o pedido
    include_once("conexao.php");
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $sqlEmail = "SELECT email FROM usuarios where email = ? AND confirmado = '1' LIMIT 1";
    $sqlInsert = "INSERT INTO recuperacao (utilizador,confirmacao) VALUES (?, ?)";
    if ( ($stmtEmail = mysqli_prepare($conn, $sqlEmail)) && ($stmtInsert = mysqli_prepare($conn, $sqlInsert)) ){

      mysqli_stmt_bind_param($stmtEmail, "s", $email);

      if( mysqli_stmt_execute($stmtEmail) ){
        mysqli_stmt_bind_result($stmtEmail, $email);
      } 
      else{
        echo "ERROR: Could not execute query: Consulta no BD de email. \n" .  mysqli_stmt_error($stmtEmail) . "\n"  .mysqli_error($conn);
      }
      if(mysqli_stmt_fetch($stmtEmail)){
        // o utilizador existe, vamos gerar um link único e enviá-lo para o e-mail
        mysqli_stmt_free_result($stmtEmail); 
        // gerar a chave
        $chave = sha1(uniqid( mt_rand(), true));
        mysqli_stmt_bind_param($stmtInsert, "ss", $email,$chave);
        // guardar este par de valores na tabela para confirmar mais tarde
        if( mysqli_stmt_execute($stmtInsert)){
  
          $link = "https://littadesign.com/recuperacao?utilizador=$email&confirmacao=$chave";
  
          if( mail($email, 'Recuperação de password', 'Olá '.$email.', visite este link '.$link) ){
            $_SESSION['msgOk'] ="Verifique a caixa de entrada de <br> <strong> $email </strong> <br>Onde poderá encontrar um link único para alterar sua senha. <br>Caso não encontre, verifique seus spams.";
            header("Location: ../resultadoSol.php");  
          } else {
            echo '<p>Houve um erro ao enviar o email (o servidor suporta a função mail?)</p>';
          }
        } else {
          echo "ERROR: Could not execute query: Consulta no BD de usuario \n" .  mysqli_stmt_error($stmtInsert) . "\n"  .mysqli_error($conn);
        }
      }
      else {
        $_SESSION['msgErro'] = "Esse utilizador não existe ou não foi confirmado";
        header("Location: ../perdisenha.php");
      }
      
    } 
    else{
      echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
    }
  } else {
    // mostrar formulário de recuperação
    header("Location: passo2rec.php");
  }
?>