<?php
	
	session_start();

		if(!isset($_SESSION['usuario'])){

			header('Location:index.php?erro=1');
		}

	require_once('db.config.php');

	$id_usuario  = $_SESSION['id_usuario'];
	$seguir_id_usuario  = $_POST['seguir_id_usuario'];

	if($id_usuario  == '' || $seguir_id_usuario == ''){ 
		die();
	}

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	// Esse comando grava na tabela usuarios_seguidores o id do usuario da sessão(logado) e o id do user a ser seguido
	$sql = " INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) values ($id_usuario, $seguir_id_usuario) ";


	mysqli_query($link, $sql);

?>