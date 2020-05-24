<?php
            if( empty($_GET['utilizador'])  )
              die('<p>Erro na confirmação do cadastro</p>');
            include_once("./dataBaseManager/conexao.php");          
            $user = ($_GET['utilizador']);
            $sql = "UPDATE usuarios SET confirmado = '1' WHERE usuario = ?";

            if ( $stmt = mysqli_prepare($conn, $sql)  ){

              mysqli_stmt_bind_param($stmt, "s", $user);
        
              if( mysqli_stmt_execute($stmt) ){
                  session_start();
                $_SESSION['msgOk'] ="Confirmação realizada com sucesso.";
                header("Location: ./login");  
            } 
              else{
                echo "ERROR: Could not execute query. \n" .  mysqli_stmt_error($stmt) . "\n"  .mysqli_error($conn);
              }

            } 
            else{
              echo "ERROR: Could not prepare query to access DB. " . mysqli_error($conn);
            }
?>


        
