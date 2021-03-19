<?php
    session_start();
    include_once("conexao.php");
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $idQuiz = filter_input(INPUT_POST, 'idQuiz', FILTER_SANITIZE_STRING);

 
    
    $sqlId = "SELECT id FROM cluster ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlId);
    while($row = mysqli_fetch_assoc($result)) {
        $contCluster = $row["id"];  
    }

    $clusterArray = $_POST['cluster'];
    $clusterSelecionado = 0;

    for($cont=1; $cont <= $contCluster; $cont++){
        if(isset($clusterArray[$cont])){ 
            $clusterSelecionado++ ;
            $c[$clusterSelecionado] = $clusterArray[$cont];
        }
    }

    for($cont=20; $cont>$clusterSelecionado; $cont--){
        $c[$cont] = null;
    }
       
    $sqlInsert = "INSERT INTO quiz(nome,descricao,c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c18,c19,c20) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    if( $stmt = mysqli_prepare($conn, $sqlInsert) ){
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss",$nome,$descricao,$c[1],$c[2],$c[3],$c[4],$c[5],$c[6],$c[7],$c[8],$c[9],$c[10],$c[11],$c[12],$c[13],$c[14],$c[15],$c[16],$c[17],$c[18],$c[19],$c[20]);
        if(mysqli_stmt_execute($stmt)){
        } else{
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
        }
    }

    $sqlVisibilidade = "UPDATE quiz SET visivel = '0' WHERE id = $idQuiz";
    mysqli_query($conn, $sqlVisibilidade);

    $sqlId = "SELECT id FROM quiz ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlId);
    while($row = mysqli_fetch_assoc($result)) {
        $idQuiz = $row["id"];  
    }
    $_SESSION['idQuiz'] = $idQuiz;

    header("Location: ../criar");

        
