<?php
$legenda = filter_input(INPUT_POST, 'legenda', FILTER_SANITIZE_STRING);
$idImage = filter_input(INPUT_POST, 'idImage', FILTER_SANITIZE_STRING);
session_start();
include_once("conexao.php");
$idUsuario = $_SESSION['id'];
$usuario =  $_SESSION['usuario'];
$sql = "INSERT INTO legendas (idUsuario,usuario,idImagem,texto) VALUES (?,?,?,?)";
            if( $stmt = mysqli_prepare($conn, $sql) ){
                mysqli_stmt_bind_param($stmt, "ssss", $idUsuario,$usuario,$idImage,$legenda);
                if(mysqli_stmt_execute($stmt)){
                    if(!isset($_SESSION['idConsulta'])){
                        header("Location: ../galeria");
                    }else{
                        header("Location: ../galeriaConsulta");
                    }
                } else{
                    echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
                }
            } else{
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
            }



