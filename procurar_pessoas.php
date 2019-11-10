<?php

	session_start();

	if(!isset($_SESSION['usuario'])){

		header('Location:index.php?erro=1');
	}
	require_once('db.config.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	//Quantidade de TWEETS
	$sql = " SELECT  COUNT(*) AS qtd_tweets FROM tweet WHERE id_usuario = $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	$qtd_tweets = 0;

		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtd_tweets = $registro['qtd_tweets'];
		} else {
			echo 'Erro na execução da query!!';
		}

	//Quantidade de SEGUIDORES

	$sql = " SELECT  COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";

	$resultado_id = mysqli_query($link, $sql);

	$qtd_seguidores = 0;

		if($resultado_id){
			$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
			$qtd_seguidores = $registro['qtd_seguidores'];
		} else {
			echo 'Erro na execução da query!!';
		}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
		<script type="text/javascript">
			
			$(document).ready(function (){
				//associar o evento de click ao botão

				$('#btn_procurar_pessoa').click( function(){

					if($('#nome_pessoa').val().length > 0){
						//Tratando tweet digitado e enviando 
						$.ajax({
							url: 'get_pessoas.php',
							method: 'post',
							data: $('#form_procurar_pessoas').serialize(),//Com o .serialize() ele pega todos os dados do form com id = 'form_procurar_pessoas' e envia para get_pessoas.php, obs! O name do input precisa ser igual ao indice da variavel super global que vai receber no caso $_POST['nome_pessoa']
							success: function(data){
								$('#pessoas').html(data);

								//Função para seguir pessoas

								$('.btn_seguir').click( function(){

									var id_usuario = $(this).data('id_usuario');//O this referencia o elemento clicado ou seja, pegaremos a informaçao do elemento clicado, atribuimos a uma var para facilitar a manipulação, nesse caso pegaremos apenas o id do usuario a ser seguido

									//Essas duas Linhas a seguir servem para alternar os botões de follow e unfollow
									$('#btn_seguir_'+id_usuario).hide();//Oculta o botão
									$('#btn_deixar_seguir_'+id_usuario).show();//Exibe o botão

									$.ajax({
										url: 'seguir.php',
										method: 'post',
										data: { seguir_id_usuario: id_usuario },// bota como valor da chave seguir_id_usuario o id_usuario que é a var que recupera o id do user a ser seguido em ar id_usuario = $(this).data('id_usuario');
										success: function(data){
											alert('Registro efetuado com sucesso!');
										}
									})
								});

								//Função para deixar de seguir 
								$('.btn_deixar_seguir').click( function(){

									var id_usuario = $(this).data('id_usuario');

									//Essas duas Linhas a seguir servem para alternar os botões de follow e unfollow
									$('#btn_seguir_'+id_usuario).show();//Oculta o botão
									$('#btn_deixar_seguir_'+id_usuario).hide();//Exibe o botão

									$.ajax({
										url: 'deixar_seguir.php',
										method: 'post',
										data: { deixar_seguir_id_usuario: id_usuario },
										success: function(data){
											alert('Registro removido com sucesso!');
										}
									})
								});
							}
						});
					} 
				});
			});
		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	          	<li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>
	    <div class="container">
	    	<div class="col-md-3">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<h4><?= $_SESSION['usuario'] ?></h4>

	    				<hr/>

	    				<div class="col-md-6">
	    					TWEETS <br/> <?= $qtd_tweets ?>
	    				</div>
	    				<div class="col-md-6">
	    					SEGUIDORES <br/> <?= $qtd_seguidores ?>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-6">
	    		<div class="panel panel-default">
	    			<div class="panel-body">
	    				<form id="form_procurar_pessoas" class="input-group">
	    					<input type="text" id="nome_pessoa" name="nome_pessoa" class="form-control" placeholder="Quem você está procurando?" maxlength="140">
	    					<span class="input-group-btn">
	    						<button class="btn btn-default" id="btn_procurar_pessoa" type="button">Procurar</button>
	    					</span>

	    				</form>
	    			</div>
	    		</div>
	    		<div id="pessoas" class="list-group">
	    			
	    		</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						
					</div>
				</div>
			</div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>