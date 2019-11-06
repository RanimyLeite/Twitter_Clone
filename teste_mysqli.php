<?php


	require_once('db.config.php');

	$sql = " SELECT * FROM usuarios";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$resultado_id = mysqli_query($link, $sql);

	

	if($resultado_id){

		$dados_usuario = array(); //Define a variável $dados_usuario recebendo um array

		//Retornar para $linha o que O que foi pego do banco na variável $resultado_id
		while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){ //ESSE MYSQLI_ASSOC retorna as informações de forma associativa, associa o nome do campo a informação contida no campo
			//ex:  ["usuario"]=> string(6) "Ranimy" campo ["usuario"], informação "Ranimy"

			//Atribui ao array com indice dinamico $dados_usuario[] toda a informação que foi atribuida a $linha, esse while faz faz o loop rodar enquanto for verdade, ou seja, enquanto tiver informação
			$dados_usuario[] = $linha; 
		}

		foreach($dados_usuario as $usuario){ //Foreach percorre o array $dados_usuario e imprime cada informação uma abaixo da outra
			var_dump($usuario);//Dessa forma eu imprimo todas as informações
			//var_dump($usuario['email']);//Dessa forma só será impresso os emails 
			//var_dump($usuario['usuario']);//Dessa forma só será impresso os usuarios
			echo '<br><br>';
		}
	
	} else {

		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site!';
	}

?>