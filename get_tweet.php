<?php

	session_start();

	if(!isset($_SESSION['usuario'])){

		header('Location:index.php?erro=1');
	}


	require_once('db.config.php');
	$id_usuario  = $_SESSION['id_usuario'];//Recuperando o id do usuario logado


	$objDb = new db();//instanciação do objeto
	$link = $objDb->conecta_mysql();

	//Seleciona apenas as informações de t.data_inclusao, t.tweet da tabela tweet, atribui a ela um alias de t, junta com a tabela usuarios(JOIN) e atribui a ela um alias de u, usando o ON é relacionado o o id_usuario da tabela tweet(t) com o id da tabela usuarios(a), onde (WHERE) o id usuario for igual ao id_usuario da var de sessão e ordena as informações(tweets) de forma decrescente DESC
	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario";
	$sql.= " FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
	$sql.= " WHERE id_usuario = $id_usuario ORDER BY data_inclusao DESC ";


	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		//Para cada interação a var $registro vai receber um registro(tweet) do bd, isso até acabar os registros
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		
			//Esse <a> no echo serve apenas para poder usarmos a class list-group-item do bootstrap, essa classe fará com que as informações fiquem agrupadas como itens ou filhas da class list-group da div com id tweet
			echo '<a href="#" class="list-group-item">';
				//A cada registro é concatenado ao tweet a data em que o tweet foi postado
				echo '<h4 class="list-group-item-heading"> '.$registro['usuario'].'
				 <small> - '.$registro['data_inclusao_formatada'].'</small></h4>';
				echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
			echo '<a/>';
		}
	} else {
		echo 'Erro na consulta de tweets no Banco de Dados!';
	}


?>