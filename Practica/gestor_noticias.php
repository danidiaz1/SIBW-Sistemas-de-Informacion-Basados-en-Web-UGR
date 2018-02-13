<?php

	include('php_classes/controller/ControladorGestorNoticias.php');
	include('php_utilities/sesion.php');
	include('php_utilities/reArrayFiles.php');
	
	abrirSesion();
		
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	$controlador_gestor_noticias = new ControladorGestorNoticias();
	$dir_subida_videos = "resources/videos/";
	$dir_subida_imagenes = "resources/imagenes/";
	
	if (isset($_POST['accion'])){
		switch($_POST['accion']){
			case 'insertar':
				$autor = $_POST['autor'];
				$titular = $_POST['titular'];
				$subtitulo = $_POST['subtitulo'];
				$id_seccion = $_POST['id_seccion_nueva_noticia'];
				$id_subseccion = $_POST['id_subseccion_nueva_noticia'];
				$entradilla = $_POST['entradilla'];
				$cuerpo = $_POST['cuerpo'];
				$video ='';
				if (is_uploaded_file($_FILES['video']['tmp_name'])){
					$video = $dir_subida_videos . uniqid() . basename($_FILES['video']['name']);
					$extension = $_FILES['video']['type'];

					// Si el archivo es un video
					if ($extension == 'video/mp4')
						move_uploaded_file($_FILES['video']['tmp_name'], $video);
				}

				$imagenes = reArrayFiles($_FILES['nuevas_imagenes']);
				$urls_imagenes = array();
				foreach ($imagenes as $imagen){
					$ruta_imagen = $dir_subida_imagenes . uniqid() . basename($imagen['name']);
					array_push($urls_imagenes, $ruta_imagen);
					move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
				}
				
				$pies_imagenes = $_POST['pies_imagenes'];
				$controlador_gestor_noticias->insertarNoticia($autor, $titular, $subtitulo, $id_seccion, $id_subseccion, 
					$entradilla, $cuerpo, $video, $urls_imagenes, $pies_imagenes);
				break;
			
			case 'eliminar':
				$ids_noticia = $_POST['ids_noticia'];

				// Eliminar videos e imagenes del sistema de ficheros
				foreach ($ids_noticia as $id_noticia){
					
					if (isset($_POST['videoEliminar'.$id_noticia])){
						$video = $_POST['videoEliminar'.$id_noticia];
						if (!filter_var($video, FILTER_VALIDATE_URL))
							unlink($video);
					}
				}
				
				$controlador_gestor_noticias->eliminarNoticias($ids_noticia);
				break;
			case 'cambiar_estado':
				if (isset($_POST['ids_noticia'])){
					$ids_noticia = $_POST['ids_noticia'];
					$estado = $_POST['nuevo_estado'];
					$controlador_gestor_noticias->cambiarEstado($ids_noticia,$estado);
				}
				break;
			case 'confirmar_edicion':
				$id_noticia = $_POST['id_noticia'];
				$autor = $_POST['autor'];
				$titular = $_POST['titular'];
				$subtitulo = $_POST['subtitulo'];
				$id_seccion = $_POST['id_seccion_editar_noticia'];
				$id_subseccion = $_POST['id_subseccion_editar_noticia'];
				$entradilla = $_POST['entradilla'];
				$cuerpo = $_POST['cuerpo'];
				
				$nuevo_video='';
				if (is_uploaded_file($_FILES['video']['tmp_name'])){
					$nuevo_video = $dir_subida_videos . uniqid() . basename($_FILES['video']['name']);
					$extension = $_FILES['video']['type'];

					// Si el archivo es un video
					if ($extension == 'video/mp4'){
						move_uploaded_file($_FILES['video']['tmp_name'], $nuevo_video);
						
						if (isset($_POST['video_modificar'])){
							$video_modificar = $_POST['video_modificar'];
							unlink($video_modificar);
						}
					}
				}
				$controlador_gestor_noticias->modificarNoticia($id_noticia, $autor, $titular, $subtitulo, $id_seccion, $id_subseccion, $entradilla,
				$cuerpo, $nuevo_video);
				
				break;
				
				/*if (isset($POST_['modificar_imagenes'])){
					$imagenes = reArrayFiles($_FILES['modificar_imagenes']);
					$urls_imagenes = array();
					foreach ($imagenes as $imagen){
						$ruta_imagen = $dir_subida_imagenes . uniqid() . basename($imagen['name']);
						array_push($urls_imagenes, $ruta_imagen);
						move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
				}
				
				$pies_imagenes = $_POST['pies_imagenes'];
				}*/
		}
	}
	
	if (isset($_GET['id_seccion'])){
		$id_seccion = $_GET['id_seccion'];
		$controlador_gestor_noticias->mostrarListadoNoticiasSeccion($id_seccion);
	} else if (isset($_GET['id_subseccion'])){
		$id_subseccion = $_GET['id_subseccion'];
		$controlador_gestor_noticias->mostrarListadoNoticiasSubseccion($id_subseccion);
	} else if (isset($_GET['id_noticia'])) {
		$id_noticia = $_GET['id_noticia'];
		$controlador_gestor_noticias->mostrarEdicionNoticia($id_noticia);
	} else 
		$controlador_gestor_noticias->mostrarPagina();
	
	guardarPaginaAnterior();
?>