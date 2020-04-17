<?php
	$servidor = "108.167.132.240";
	$usuario = "littad18_eduardo";
	$senha = "op0460UKuv";
	$dbname = "littad18_litta";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	if($conn === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
