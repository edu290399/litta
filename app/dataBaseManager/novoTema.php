<?php
    session_start();
    include_once("conexao.php");

    $switch = filter_input(INPUT_POST, 'switch', FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, 'nomeTema', FILTER_SANITIZE_STRING);

    switch ($switch) {
        case 0:
            $sql = "INSERT INTO temaEntrevista(nome) VALUES ('$nome')";
            if(mysqli_query($conn, $sql)){
                $_SESSION['msgOk'] = "Tema de Entrevista cadastrado";
            }else{
                $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
            };
            header("Location: ../temasEntrevista");
            break;
        case 1:
            $sql = "INSERT INTO temaQuiz(nome) VALUES ('$nome')";
            if(mysqli_query($conn, $sql)){
                $_SESSION['msgOk'] = "Tema de Quiz cadastrado";
            }else{
                $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
            };
            header("Location: ../temasQuiz");
            break;
        case 2:
            $sql = "INSERT INTO temaCluster(nome) VALUES ('$nome')";
            if(mysqli_query($conn, $sql)){
                $_SESSION['msgOk'] = "Tema de Cluster cadastrado";
            }else{
                $_SESSION['msgErro'] = "Um erro ocorreu, tente novamente";
            };
            header("Location: ../temasCluster");
            break;
    }


        
