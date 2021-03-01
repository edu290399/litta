<?php
    session_start();
    include_once("conexao.php");

    $switch = filter_input(INPUT_POST, 'switch', FILTER_SANITIZE_STRING);
    $idTema = filter_input(INPUT_POST, 'idTema', FILTER_SANITIZE_STRING);
    $contInput = filter_input(INPUT_POST, 'cont', FILTER_SANITIZE_STRING);

    switch ($switch) {
        case 0:
            $entrevistaArray = $_POST['entrevista'];
            $entrevistaDeleteArray = $_POST['entrevistaDelete'];
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($entrevistaArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaEntrevista(idTema,idEntrevista) VALUES ('$idTema','$entrevistaArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";;
                    };
                }else{
                    $sql = "DELETE FROM linkTemaEntrevista WHERE idTema = '$idTema' AND idEntrevista = '$entrevistaDeleteArray[$cont]' ";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";
                    };
                }
            }
            header("Location: ../temasEntrevista");
            break;
        case 1:
            $quizArray = $_POST['quiz'];
            $quizDeleteArray = $_POST['quizDelete'];
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($quizArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaQuiz(idTema,idQuiz) VALUES ('$idTema','$quizArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";;
                    };
                }else{
                    $sql = "DELETE FROM linkTemaQuiz WHERE idTema = '$idTema' AND idQuiz = '$quizDeleteArray[$cont]' ";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";
                    };
                }
            }
            header("Location: ../temasQuiz");
            break;
        case 2:
            $clusterArray = $_POST['cluster'];
            $clusterDeleteArray = $_POST['clusterDelete'];
            for($cont=0; $cont <= $contInput; $cont++){
                if(isset($clusterArray[$cont])){ 
                    $sql = "INSERT INTO linkTemaCluster(idTema,idCluster) VALUES ('$idTema','$clusterArray[$cont]')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";;
                    };
                }else{
                    $sql = "DELETE FROM linkTemaCluster WHERE idTema = '$idTema' AND idCluster = '$clusterDeleteArray[$cont]' ";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msgOk'] = "Alterações salvas";
                    };
                }
            }


            header("Location: ../temasCluster");
            break;
    }


        
