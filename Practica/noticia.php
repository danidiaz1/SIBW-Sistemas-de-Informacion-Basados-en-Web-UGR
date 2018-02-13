<?php

	include('php_classes/controller/ControladorNoticia.php');
	include('php_utilities/sesion.php');
	include('php_utilities/testInput.php');
	
	abrirSesion();
		
	$id_noticia = testInput($_GET['id']);
	$controlador_noticia = new ControladorNoticia();

	if (!empty($_POST)){
		$nombre = testInput($_POST['nombreComentario']);
		$correo = testInput($_POST['emailComentario']);
		$texto = testInput($_POST['textoComentario']);
		$ip = $_SERVER['REMOTE_ADDR'];
		$exito = $controlador_noticia->insertarComentario($id_noticia, $nombre, $correo, $texto, $ip);
	}

	$controlador_noticia->mostrarNoticia($id_noticia);
	guardarPaginaAnterior();
	
?>