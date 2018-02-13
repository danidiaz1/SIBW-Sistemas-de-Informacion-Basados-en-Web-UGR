<?php

	include('php_classes/controller/ControladorGestorSecciones.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$controlador_gestor_secciones = new ControladorGestorSecciones();
	
	if (isset($_GET['accion'])){
		switch($_GET['accion']){
			case 'eliminar':
				$ids_seccion = $_GET['ids_seccion'];
				$controlador_gestor_secciones->eliminarSecciones($ids_seccion);
				break;
			case 'insertar':
				$nombre = $_GET['nombreSeccion'];
				$controlador_gestor_secciones->insertarSeccion($nombre);
				break;
			case 'modificar':
				$nombre_mod = $_GET['nombreModificar'];
				$id_seccion_mod = $_GET['id_seccion'];
				$controlador_gestor_secciones->modificarSeccion($id_seccion_mod, $nombre_mod);
				break;
		}
	}

	$controlador_gestor_secciones->mostrarPagina();
	
	guardarPaginaAnterior();
?>