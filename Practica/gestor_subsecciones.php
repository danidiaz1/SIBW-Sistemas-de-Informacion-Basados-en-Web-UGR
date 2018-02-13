<?php

	include('php_classes/controller/ControladorGestorSubsecciones.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$id_seccion = $_GET['id_seccion'];
	
	$controlador_gestor_subsecciones = new ControladorGestorSubsecciones($id_seccion);
	
	if (isset($_GET['accion'])){
		switch($_GET['accion']){
			case 'eliminar':
				$ids_subseccion = $_GET['ids_subseccion'];
				$controlador_gestor_subsecciones->eliminarSubsecciones($ids_subseccion);
				break;
			case 'insertar':
				$nombre = $_GET['nombreSubseccion'];
				$controlador_gestor_subsecciones->insertarSubseccion($id_seccion, $nombre);
				break;
			case 'modificar':
				$nombre_mod = $_GET['nombreModificar'];
				$id_subseccion_mod = $_GET['id_subseccion'];
				$controlador_gestor_subsecciones->modificarSubseccion($id_subseccion_mod, $nombre_mod);
				break;
		}
	}

	$controlador_gestor_subsecciones->mostrarPagina();
	
	guardarPaginaAnterior();
?>