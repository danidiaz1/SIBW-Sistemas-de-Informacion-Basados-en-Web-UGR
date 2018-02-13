<?php

	include('php_classes/controller/ControladorFacebookPost.php');
	include('php_utilities/testInput.php');
	
	$id_noticia = testInput($_GET['id_noticia']);
	
	$controlador_facebook_post = new ControladorFacebookPost();
	$controlador_facebook_post->mostrarPagina($id_noticia);
	
?>