<?php

	include('php_classes/controller/ControladorGestorPublicidades.php');
	include('php_utilities/sesion.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$controlador_gestor_publicidades = new ControladorGestorPublicidades();
	$dir_subida = "resources/banners/";
	
	if (isset($_POST['accion'])){
		switch($_POST['accion']){
			case 'eliminar':
				$ids_publicidad = $_POST['ids_publicidad'];
				
				foreach ($ids_publicidad as $id_publicidad){
					$imagen = $_POST['imagenEliminar'.$id_publicidad];
					unlink($imagen);
				}
				
				$controlador_gestor_publicidades->eliminarPublicidades($ids_publicidad);
				break;
			case 'insertar':
				$imagen = $dir_subida . uniqid() . basename($_FILES['imagen']['name']);
				
				move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
				$texto = $_POST['texto'];
				$enlace = $_POST['enlace'];
				$titulo = $_POST['titulo'];
				$controlador_gestor_publicidades->insertarPublicidad($imagen,$texto,$enlace,$titulo);

				break;
			case 'modificar':
			
				$imagen_mod = '';
				
				if (is_uploaded_file($_FILES['imagenModificar']['tmp_name'])){
					$imagen_mod = $dir_subida . uniqid() . basename($_FILES['imagenModificar']['name']);
					move_uploaded_file($_FILES['imagenModificar']['tmp_name'], $imagen_mod);
					$imagen_eliminar = $_POST['imagenEliminar'.$id_publicidad_mod];
					unlink($imagen_eliminar);
				}

				$id_publicidad_mod = $_POST['id_publicidad'];
				$enlace_mod = $_POST['enlaceModificar'];
				$texto_mod = $_POST['textoModificar'];
				$titulo_mod = $_POST['tituloModificar'];
				$controlador_gestor_publicidades->modificarPublicidad($id_publicidad_mod, $imagen_mod, $texto_mod, $enlace_mod, $titulo_mod);
				
				break;
		}
	}

	$controlador_gestor_publicidades->mostrarPagina();
	
	guardarPaginaAnterior();
	

?>