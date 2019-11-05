<?php

	require_once('db.config.php');

	$usuario	 = $_POST['usuario'];
	
	$email		 = $_POST['email'];
	
	$senha 		 = md5($_POST['senha']);//Esse md5 serve para gerar um hash de 32 caracteres que serve como criptografia para a informação nele aplicada, no caso a var $senha já recebe a senha do cliente criptografada


	//instanciando a classe db e gerando um objeto de conexão com o banco
	$objDb = new db();

	//Como a função conecta_mysql retorna um link de conexão(return $con) ela precisa ser recuperada de alguma forma e para isso atribuimos ela a  uma var $link;
	$link = $objDb->conecta_mysql();


	//Montando a Query(Instrução de insert dos dados)no banco
	$sql = " insert into usuarios(usuario, email, senha) values ('$usuario', '$email', '$senha')";

	//---------------> Executando a Query e testando <----------------------------//

	//A função mysqli_query(conexão, query) recebe 2 parametros, como $link retorna a conexão como o bd ele é o primeiro parametro e $sql é a query
	if(mysqli_query($link, $sql)){
		echo 'Usuário registrado com sucesso!';
	} else{
		echo 'Erro ao registrar usuário!';
	}

?>