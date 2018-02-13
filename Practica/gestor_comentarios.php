<?php

	include('php_classes/controller/ControladorGestorComentarios.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$controlador_gestor_comentarios = new ControladorGestorComentarios();
	
	if (isset($_GET['accion'])){
		switch($_GET['accion']){
			case 'eliminar':
				$ids_comentario = $_GET['ids_comentario'];
				$controlador_gestor_comentarios->eliminarComentarios($ids_comentario);
				break;
			case 'insertar':
				$fecha = $_GET['fecha'];
				$hora = $_GET['hora'];
				$nombre = $_GET['nombreComentario'];
				$correo = $_GET['emailComentario'];
				$texto = $_GET['textoComentario'];
				$id_noticia = $_GET['id_noticia'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$controlador_gestor_comentarios->insertarComentario($id_noticia,$nombre,$correo,$texto,$ip,$fecha,$hora);
				break;
			case 'modificar':
				$fecha_mod = $_GET['fechaModificar'];
				$hora_mod = $_GET['horaModificar'];
				$nombre_mod = $_GET['nombreModificar'];
				$correo_mod = $_GET['correoModificar'];
				$texto_mod = $_GET['textoModificar'];
				$id_comentario_mod = $_GET['id_comentario'];
				$controlador_gestor_comentarios->modificarComentario($id_comentario_mod,$nombre_mod,$correo_mod,$texto_mod,$fecha_mod,$hora_mod);
				break;
		}
	}

	if (isset($_GET['id_noticia'])){
		$id_noticia = $_GET['id_noticia'];
		$controlador_gestor_comentarios->mostrarComentarios($id_noticia);
	}
	else 
		$controlador_gestor_comentarios->mostrarNoticias();
	
	guardarPaginaAnterior();
?>