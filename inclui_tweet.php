<?php
	
	session_start();//Sempre q se trabalha com variaveis de sessão precisamos colocar essa função
	//Recebendo os tweets e gravando no banco

		if(!isset($_SESSION['usuario'])){// teste para saber se o usuario existe, para n ser possivel acessar essa area direto por url

			header('Location:index.php?erro=1');
		}

	require_once('db.config.php');

	$texto_tweet = $_POST['texto_tweet'];//Recuperando o valor enviado do ajax de home.php
	$id_usuario  = $_SESSION['id_usuario'];//Recuperando o id do usuario logado

	if($texto_tweet == '' || $id_usuario == ''){ 
		die();
	}

	$objDb = new db();//instanciação do objeto
	$link = $objDb->conecta_mysql();

	$sql = " INSERT INTO tweet(id_usuario, tweet) values ($id_usuario, '$texto_tweet') ";

	mysqli_query($link, $sql);

?>