<?php

	include('php_classes/controller/ControladorTwitterPost.php');
	include('php_utilities/testInput.php');

	$id_noticia = testInput($_GET['id_noticia']);
	
	$controlador_twitter_post = new ControladorTwitterPost();
	$controlador_twitter_post->mostrarPagina($id_noticia);
	
?>