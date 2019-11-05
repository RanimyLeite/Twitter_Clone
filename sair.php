<?php

session_start();

unset($_SESSION['usuario']); //Limpa a variavel de sessão 
unset($_SESSION['email']);

header('Location: index.php');//Redireciona para o index
	

?>

