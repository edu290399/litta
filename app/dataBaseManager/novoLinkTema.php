<?php
    session_start();
    include_once("conexao.php");

    $switch = filter_input(INPUT_POST, 'switch', FILTER_SANITIZE_STRING);
    $idTema = filter_input(INPUT_POST, 'idTema', FILTER_SANITIZE_STRING);
    $contInput = filter_input(INPUT_POST, 'cont', FILTER_SANITIZE_STRING);

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
            $clusterArray = $_POST['cluster'];
            $clusterSelecionado = 0;
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($clusterArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaCluster(idTema,idCluster) VALUES ('$idTema','$clusterArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Tema de Cluster cadastrado";
                    }else{
                        $_SESSION['msgErro'] = "Cluster já adicionado";
                    };
                }
            }


            header("Location: ../temasCluster");
            break;
    }


        
