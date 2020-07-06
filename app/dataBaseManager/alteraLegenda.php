<?php

session_start();
include_once("conexao.php");
$idUsuario = $_SESSION['id'];
$usuario =  $_SESSION['usuario'];
$texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
$idImage = filter_input(INPUT_POST, 'idImage', FILTER_SANITIZE_STRING);
$sql = "INSERT INTO legendas (idUsuario,usuario,idImagem,texto) VALUES (?,?,?,?)";
$sqlNot = "UPDATE usuarios SET notificacao = '1' WHERE id = ?";

            if($stmt = mysqli_prepare($conn, $sqlNot)){
                mysqli_stmt_bind_param($stmt, "s", $idUsuario);
                if(!mysqli_stmt_execute($stmt)){
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            }
            else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }
            if( $stmt = mysqli_prepare($conn, $sql) ){
                mysqli_stmt_bind_param($stmt, "ssss", $idUsuario,$usuario,$idImage,$texto);
                if(mysqli_stmt_execute($stmt)){
                    echo $usuario.' - '.$texto."\n";
                } else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            } else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }



