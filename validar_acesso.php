<?php

	//Esse comando serve para proibir que paginas restritas apenas a usuarios seja acessadas diretamente pelo link via get ou post diretamente, sem uma autenticação

	//É primordial que esse comando venha antes de qualquer tipo de echo, var_dump ou algo que imprima alguma informação na tela, por isso sempre usaremos ele como primeiro comando
	session_start(); //Ele dá acesso a variaveis de sessão


	require_once('db.config.php');


	$usuario = $_POST['usuario'];
	$senha	 = $_POST['senha'];


	$sql = " SELECT usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha' ";

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

			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];

			header('Location: home.php');// Redireciona o user para uma pg restrita para cadastrados
		} else {
			//Caso n exista o usuario ele é redirecionado para o index com um error no link via get
			header('Location: index.php?erro=1');
		}
	} else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site!';
	}

	// --------------------> REFERENTE AO COMEÇO DA PG home.php <----------------------
	//<?php

	//session_start(); //Sempre que for usar uma variavel de sessão $SESSION[] precisamos colocar p session_start()

	//------------> TESTE PARA N ENTRAREM NA PG DIRETO POR LINK A PARTIR DE UMA ABA ANONIMA <----------------

	//if(!isset($_SESSION['usuario'])){ // Se n existir um usuario logado autenticado ele é direcionado para o index juntamente com uma msg de erro para que ele possa logar e entrar sendo autenticado

	//	header('Location:index.php?erro=1'); 
	//}
	


?>