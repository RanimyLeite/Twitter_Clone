<?php
	
	session_start();

		if(!isset($_SESSION['usuario'])){

			header('Location:index.php?erro=1');
		}

	require_once('db.config.php');

	$id_usuario  = $_SESSION['id_usuario'];
	$deixar_seguir_id_usuario  = $_POST['deixar_seguir_id_usuario'];

	if($id_usuario  == '' || $deixar_seguir_id_usuario == ''){ 
		die();//Interrompe a execução do scipt caso alguma das condições seja vdd
	}

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	// Esse comando deleta da tabela usuarios_seguidores onde id_usuario da tab for igual ao id_usuario da sessão(user logado) e o campo seguindo_id_usuario for igual ao deixar_seguir_id_usuario
	$sql = " DELETE FROM usuarios_seguidores WHERE id_usuario = $id_usuario AND seguindo_id_usuario = $deixar_seguir_id_usuario ";


	mysqli_query($link, $sql);

?>