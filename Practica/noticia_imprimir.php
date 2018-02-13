<?php

	include('php_classes/controller/ControladorNoticiaImprimir.php');
	include('php_utilities/testInput.php');
	
	$id_noticia = testInput($_GET['id']);
	
	$controlador_noticia_imprimir = new ControladorNoticiaImprimir();
	$controlador_noticia_imprimir->mostrarNoticia($id_noticia);
	
?>