<?php
    session_start();
    include_once("conexao.php");
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    if(isset($_POST['idCluster'])){ $idCluster = filter_input(INPUT_POST, 'idCluster', FILTER_SANITIZE_STRING);};


    if(isset($_POST['img1'])){ $img1 = filter_input(INPUT_POST, 'img1', FILTER_SANITIZE_STRING);}else{$img1="";};
    if(isset($_POST['img2'])){ $img2 = filter_input(INPUT_POST, 'img2', FILTER_SANITIZE_STRING);}else{$img2="";};
    if(isset($_POST['img3'])){ $img3 = filter_input(INPUT_POST, 'img3', FILTER_SANITIZE_STRING);}else{$img3="";};
    if(isset($_POST['img4'])){ $img4 = filter_input(INPUT_POST, 'img4', FILTER_SANITIZE_STRING);}else{$img4="";};
    if(isset($_POST['img5'])){ $img5 = filter_input(INPUT_POST, 'img5', FILTER_SANITIZE_STRING);}else{$img5="";};
    if(isset($_POST['img6'])){ $img6 = filter_input(INPUT_POST, 'img6', FILTER_SANITIZE_STRING);}else{$img6="";};
    if(isset($_POST['img7'])){ $img7 = filter_input(INPUT_POST, 'img7', FILTER_SANITIZE_STRING);}else{$img7="";};
    if(isset($_POST['img8'])){ $img8 = filter_input(INPUT_POST, 'img8', FILTER_SANITIZE_STRING);}else{$img8="";};
    
    if(isset($_POST['t1'])){ $t1 = filter_input(INPUT_POST, 't1', FILTER_SANITIZE_STRING);}else{$t1="";};
    if(isset($_POST['t2'])){ $t2 = filter_input(INPUT_POST, 't2', FILTER_SANITIZE_STRING);}else{$t2="";};
    if(isset($_POST['t3'])){ $t3 = filter_input(INPUT_POST, 't3', FILTER_SANITIZE_STRING);}else{$t3="";};
    if(isset($_POST['t4'])){ $t4 = filter_input(INPUT_POST, 't4', FILTER_SANITIZE_STRING);}else{$t4="";};
    if(isset($_POST['t5'])){ $t5 = filter_input(INPUT_POST, 't5', FILTER_SANITIZE_STRING);}else{$t5="";};
    if(isset($_POST['t6'])){ $t6 = filter_input(INPUT_POST, 't6', FILTER_SANITIZE_STRING);}else{$t6="";};
    if(isset($_POST['t7'])){ $t7 = filter_input(INPUT_POST, 't7', FILTER_SANITIZE_STRING);}else{$t7="";};
    if(isset($_POST['t8'])){ $t8 = filter_input(INPUT_POST, 't8', FILTER_SANITIZE_STRING);}else{$t8="";};

    if(isset($_POST['leg1'])){ $leg1 = filter_input(INPUT_POST, 'leg1', FILTER_SANITIZE_STRING);}else{$leg1="";};
    if(isset($_POST['leg2'])){ $leg2 = filter_input(INPUT_POST, 'leg2', FILTER_SANITIZE_STRING);}else{$leg2="";};
    if(isset($_POST['leg3'])){ $leg3 = filter_input(INPUT_POST, 'leg3', FILTER_SANITIZE_STRING);}else{$leg3="";};
    if(isset($_POST['leg4'])){ $leg4 = filter_input(INPUT_POST, 'leg4', FILTER_SANITIZE_STRING);}else{$leg4="";};
    if(isset($_POST['leg5'])){ $leg5 = filter_input(INPUT_POST, 'leg5', FILTER_SANITIZE_STRING);}else{$leg5="";};
    if(isset($_POST['leg6'])){ $leg6 = filter_input(INPUT_POST, 'leg6', FILTER_SANITIZE_STRING);}else{$leg6="";};
    if(isset($_POST['leg7'])){ $leg7 = filter_input(INPUT_POST, 'leg7', FILTER_SANITIZE_STRING);}else{$leg7="";};
    if(isset($_POST['leg8'])){ $leg8 = filter_input(INPUT_POST, 'leg8', FILTER_SANITIZE_STRING);}else{$leg8="";};


    if( (!isset($_SESSION['idCluster'])) && (!isset($_POST['idCluster']))){
        $sqlId = "SELECT id FROM cluster ORDER BY id DESC LIMIT 1";
        if ($result = mysqli_query($conn, $sqlId)) {
            while($row = mysqli_fetch_assoc($result)) { 
            $idCluster = $row["id"] + 1;  
            }
        }else{
            $idCluster = 1;  
        }
        $_SESSION['idCluster'] = $idCluster;
        $sqlInsert = "INSERT INTO cluster (nome,descricao,img1) VALUES (?,?,'tmp')";
        if( $stmt = mysqli_prepare($conn, $sqlInsert) ){
            mysqli_stmt_bind_param($stmt, "ss",$nome,$descricao);
            if(mysqli_stmt_execute($stmt)){
            } else{
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        }
    }    
    else{
        $sqlUpdate = "UPDATE cluster SET nome=?,descricao=?,img1=?,img2=?,img3=?,img4=?,img5=?,img6=?,img7=?,img8=?,t1=?,t2=?,t3=?,t4=?,t5=?,t6=?,t7=?,t8=?,leg1=?,leg2=?,leg3=?,leg4=?,leg5=?,leg6=?,leg7=?,leg8=? WHERE id=?";
        if( $stmt = mysqli_prepare($conn, $sqlUpdate) ){
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssss",$nome,$descricao,$img1,$img2,$img3,$img4,$img5,$img6,$img7,$img8,$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$leg1,$leg2,$leg3,$leg4,$leg5,$leg6,$leg7,$leg8,$idCluster);
            if(mysqli_stmt_execute($stmt)){
                header("Location: ../criar");
            } else{
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        }else{
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }
    }
   
    header("Location: ../criar");

        
