<?php

class db {

	//Para criar uma conexão entre o php e o MySQL precisamos de $ informações:
	
	//1-host
	private $host = 'localhost';

	//2-usuario
	private $usuario = 'root';

	//3-senha
	private $senha = '';

	//4-banco de dados usado
	private $database = 'twitter_clone';

	public function conecta_mysql(){
		// --------------------------> Criando a conexão <--------------------------------------------//

		//A função mysqli_connect(localização do bd, usuario, senha, banco de dados)recebe 4 parametros
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database); //conexão estabelecida

		// ------------> Ajustando charset de comunicação entre aplicação e banco <-------------------//

		//A função mysqli_set_charset(conexão com o bd, qual charset será usado)recebe 2 parametros
		mysqli_set_charset($con, 'utf8');

		//----------------------> Verificando se houve erro de conexão <-----------------------------//

		// A função mysqli_connect_errno()retorna um erro, se retornar 0 não existe erro
		if(mysqli_connect_errno()){

			// A função mysql_connect_error() retorna a descrição do erro
			echo 'Erro ao tentar se conectar com o BD MYSQL!'. mysqli_connect_error();
		}

		return $con;
	}

}






?>