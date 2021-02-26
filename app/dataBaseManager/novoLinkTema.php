<?php
    session_start();
    include_once("conexao.php");

    $switch = filter_input(INPUT_POST, 'switch', FILTER_SANITIZE_STRING);
    $idTema = filter_input(INPUT_POST, 'idTema', FILTER_SANITIZE_STRING);
    $contInput = filter_input(INPUT_POST, 'cont', FILTER_SANITIZE_STRING);

    switch ($switch) {
        case 0:
            $entrevistaArray = $_POST['entrevista'];
            $entrevistaSelecionado = 0;
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($entrevistaArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaEntrevista(idTema,idEntrevista) VALUES ('$idTema','$entrevistaArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Entrevista adicionada ao tema";
                    }else{
                        $_SESSION['msgErro'] = "Entrevista já adicionada";
                    };
                }
            }
            header("Location: ../temasEntrevista");
            break;
        case 1:
            $quizArray = $_POST['quiz'];
            $quizSelecionado = 0;
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($quizArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaQuiz(idTema,idQuiz) VALUES ('$idTema','$quizsArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Quiz adicionada ao tema";
                    }else{
                        $_SESSION['msgErro'] = "Quiz já adicionado";
                    };
                }
            }
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


        
