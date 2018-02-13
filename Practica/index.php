<?php
	include('php_classes/controller/ControladorPortada.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$controlador_portada = new ControladorPortada();

	$controlador_portada->mostrarPortada();
	
	guardarPaginaAnterior();
?>