<?php

	session_start();

	if(!isset($_SESSION['usuario'])){

		header('Location:index.php?erro=1');
	}


	require_once('db.config.php');
	$id_usuario  = $_SESSION['id_usuario'];//Recuperando o id do usuario logado


	$objDb = new db();//instanciação do objeto
	$link = $objDb->conecta_mysql();

	//Seleciona tudo da tabela tweet, ordenando as informações pela data de inclusão e de forma decrescente, isso acontece para que o post mais recente fique no topo conforme as redes sociais normais e esse where serve para fazer com que apenas os tweets do usuario logado sejam listados
	$sql = " SELECT * FROM tweet WHERE id_usuario = $id_usuario ORDER BY data_inclusao DESC ";


	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		//Para cada interação a var $registro vai receber um registro(tweet) do bd, isso até acabar os registros
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			var_dump($registro);
			echo '<br/><br/>';
		}
	} else {
		echo 'Erro na consulta de tweets no Banco de Dados!';
	}


?>