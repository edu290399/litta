<?php
$legenda = filter_input(INPUT_POST, 'legenda', FILTER_SANITIZE_STRING);
$idImage = filter_input(INPUT_POST, 'idImage', FILTER_SANITIZE_STRING);
session_start();
include_once("conexao.php");
$idUsuario = $_SESSION['id'];
$sql = "INSERT INTO galeria (idUsuario,endereco,legenda) VALUES (?, ?,?)";
$sql = "UPDATE galeria SET legenda = ? WHERE idUsuario = ? AND id = ?";
            if( $stmt = mysqli_prepare($conn, $sql) ){
                mysqli_stmt_bind_param($stmt, "sss", $legenda,$idUsuario,$idImage);
                if(mysqli_stmt_execute($stmt)){
                    header("Location: ../galeria");
                } else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            } else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }



