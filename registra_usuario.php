<?php
	//Script que recebe dados do form de incrição e gurda no banco

	require_once('db.config.php');

	$usuario	 = $_POST['usuario'];
	
	$email		 = $_POST['email'];
	
	$senha 		 = md5($_POST['senha']);//Esse md5 serve para gerar um hash de 32 caracteres que serve como criptografia para a informação nele aplicada, no caso a var $senha já recebe a senha do cliente criptografada


	//instanciando a classe db e gerando um objeto de conexão com o banco
	$objDb = new db();

	//Como a função conecta_mysql retorna um link de conexão(return $con) ela precisa ser recuperada de alguma forma e para isso atribuimos ela a  uma var $link;
	$link = $objDb->conecta_mysql();

	//Verificando se o usuario já existe
	$sql = " select * from usuarios where usuario = '$usuario'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario)){
			echo 'Usuário já cadastrado!!';
		} else {
			echo 'Usuário não cadastrado, OK! Pode cadastrar!';
		}
	} else {

		echo 'Erro ao tentar localizar o registro do usuario';
	}


	//Verificando se o email já existe

	$sql = " select * from usuarios where email = '$email'";
	if($resultado_id = mysqli_query($link, $sql)){

		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email'])){
			echo 'Email já cadastrado!!';
		} else {
			echo 'Email não cadastrado, OK! Pode cadastrar!';
		}

	} else {
		echo 'Erro ao tentar localizar o registro de email';
	}


	die();//interrompe a execução a partir daqui

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