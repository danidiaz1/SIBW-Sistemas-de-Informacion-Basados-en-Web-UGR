<?php

	include('php_classes/controller/ControladorEstadisticasPublicidad.php');
	include('php_utilities/testInput.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
	
	$id_publicidad = testInput($_GET['id']);
	
	$controlador_estadisticas_publicidad = new ControladorEstadisticasPublicidad();
	$controlador_estadisticas_publicidad->mostrarPagina($id_publicidad);
	
	guardarPaginaAnterior();
?>