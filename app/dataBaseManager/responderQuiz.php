<?php
session_start();
include_once("conexao.php");
$btnResposta = filter_has_var(INPUT_POST, 'btnResposta');
if($btnResposta){
    $idQuiz = filter_input(INPUT_POST, 'idQuiz', FILTER_SANITIZE_STRING);             
    $idCluster = filter_input(INPUT_POST, 'idCluster', FILTER_SANITIZE_STRING);
    $idEnvio = filter_input(INPUT_POST, 'idEnvio', FILTER_SANITIZE_STRING);
    $nImage = filter_input(INPUT_POST, 'nImage', FILTER_SANITIZE_STRING);
    $_SESSION['idQuiz'] = $idQuiz;
    $_SESSION['idEnvio'] = $idEnvio;
    $idUsuario = $_SESSION['id'];
    $c1 = filter_input(INPUT_POST, 'c1', FILTER_SANITIZE_STRING);
    if($_SESSION['clusterAtual'] == 1){
        $sql = "INSERT INTO respostasQuiz(idEnvio,idQuiz,idUsuario,c1,r1) VALUES ($idEnvio,$idQuiz,$idUsuario,$idCluster,$nImage)";
    }
    else{
        $clusterSt = 'c'.$_SESSION['clusterAtual'];
        $respostaSt = 'r'.$_SESSION['clusterAtual'];
        $sql = "UPDATE respostasQuiz SET $clusterSt = $idCluster, $respostaSt = $nImage WHERE idEnvio = $idEnvio";
    }
	
    if (mysqli_query($conn, $sql)) {
        $_SESSION['clusterAtual'] += $_SESSION['clusterAtual'];
        $clusterAtual = 'c'.$_SESSION['clusterAtual'];
        $sql1 = "SELECT $clusterAtual FROM quiz WHERE id = $idQuiz ";
        $result = mysqli_query($conn, $sql1);
        if ($result = mysqli_query($conn, $sql1)) {
            while($row = mysqli_fetch_assoc($result)) {  $idCluster = $row["$clusterAtual"];}
            if ($idCluster == NULL ){
                $hora = date('Y-m-d H:i:s', time());
                $sqlResposta = "UPDATE quizados SET respondido = '1' , respondidoEm = '$hora' WHERE idEnvio = $idEnvio";
                if (mysqli_query($conn, $sqlResposta)) {
                    $_SESSION['msgOk'] = "Quiz Respondido";
                    header("Location: ../exibeQuiz");
                }
            }
            else{
                $_SESSION['msgOk'] = "Resposta Salva";
                header("Location: ../responderQuiz");
            }
        }
    }else{
        $_SESSION['msgErro'] = $sql;
        header("Location: ../responderQuiz");
    }
}
else{
    $_SESSION['msgErro'] = "Página não encontrada";
	header("Location: ../perfil");
}
?>
