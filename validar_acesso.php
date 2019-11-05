<?php

	require_once('db.config.php');


	$usuario = $_POST['usuario'];
	$senha	 = $_POST['senha'];


	$sql = " SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//Faz uma consulta SELECT q retorna false caso tenha erro na consulta ou resource que é uma referencia para uma informação externa ao php
	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){

		//Caso retorne um Resource nós exploramos a informação em estrutura de array
		$dados_usuario = mysqli_fetch_array($resultado_id);// retorna os dados em estrutura de array

		//--------------------> Verifica a existencia de um usuario no banco <----------------------//
		//isset verifica se a variavel existe, no caso se existe usuario preenchido
		if(isset($dados_usuario['usuario'])){
			echo 'Usuário existe!';
		} else {
			//Caso n exista o usuario ele é redirecionado para o index com um error no link via get
			header('Location: index.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site!';
	}


?>