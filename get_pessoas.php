<?php

	session_start();

	if(!isset($_SESSION['usuario'])){

		header('Location:index.php?erro=1');
	}

	require_once('db.config.php');

	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario  = $_SESSION['id_usuario'];//Recuperando o id do usuario logado


	$objDb = new db();//instanciação do objeto
	$link = $objDb->conecta_mysql();

	//Retorna tudo da tabela usuarios onde usuario for igual ao usuario informado e id do usuario for diferente do id usuario da sessão
	//Esse like faz com que ao escrevermos apenas parte do nome e apertar o procurar apareça todos os nomes que contenham aquela parte ecrita, e o % serve para dizer que não importa o que tem antes, se terminar com a palavra pesquisada será retornado e a porcentagem do final serve para a msm coisa mudando apenas que será retornado os nomes que começarem com a informação digitada
	$sql = " SELECT * FROM usuarios WHERE usuario like '%$nome_pessoa%' AND id <> $id_usuario ";


	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id){
		//Para cada interação a var $registro vai receber um registro(informações) do bd, isso até acabar os registros
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<a href="#" class="list-group-item">';
				echo '<strong>'.$registro['usuario'].'</strong> <small>- '.$registro['email'].' </small>';
				echo '<p class="list-group-item-text pull-right">';
					//esse trecho data-id_usuario="'.$registro['id'].'" serve para armazenar o id do usuario ao qual eu quero seguir, isse id concatenado com o id da pessoa a ser seguida serve para diferenciar cada elemento
					echo '<button type="button" id="btn_seguir_'.$registro['id'].'" class="btn btn-default btn_seguir" data-id_usuario="'.$registro['id'].'" >Seguir</button>';
					echo '<button type="button" id="btn_deixar_seguir_'.$registro['id'].'" style="display:none" class="btn btn-primary btn_deixar_seguir" data-id_usuario="'.$registro['id'].'" >Deixar de Seguir</button>';
				echo '</p>';
				echo '<div class="clearfix"></div>';
			echo '<a/>';
		}
	} else {
		echo 'Erro na consulta de tweets no Banco de Dados!';
	}


?>