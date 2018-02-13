<?php

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaEdicionNoticia extends VistaPagina{

	private $noticia;
	
	public function __construct($noticia, $secciones, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de comentarios';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<link rel="stylesheet" type="text/css" href="estilos/estilo_noticia.css">
		<script type="text/javascript" src="javascript/gestor_noticias.js"></script>
		<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>';
		$this->noticia = $noticia;
	}
	
	protected function mostrarContenido(){
		echo '<div class="edicion_noticia"> 
			<h1> Editando noticia: </h1>';
			
			$this->mostrarOpciones();
						
			echo '<form id="miFormularioEditarNoticia" action="gestor_noticias.php?id_noticia='.$this->noticia->getId().'" name="miFormularioEditarNoticia" 
					enctype="multipart/form-data" class="formularioEditarNoticia" method="post">
						<fieldset>
							<legend>Editando noticia</legend>
							<span>Autor: </span>
							<input type="text" name="autor" placeholder="autor" value="'.$this->noticia->getAutor().'" required>
							<span>Titular: </span>
							<textarea type="text" name="titular" placeholder="titular" required>'.$this->noticia->getTitular().'</textarea>
							<span>Subtítulo: </span>
							<textarea type="text" name="subtitulo" placeholder="subtitulo" required>'.$this->noticia->getSubtitulo().'</textarea>
							<p>Sección: 
							<select name="id_seccion_editar_noticia" required>
								<option disabled selected value> Sección </option>';
								
							foreach ($this->secciones as $seccion){
								echo '<option value="'.$seccion->getIdSeccion().'" '; 
								
								if ($this->noticia->getSeccion()->getIdSeccion() == $seccion->getIdSeccion())
										echo 'selected';
								
								echo '>'.$seccion->getNombre().'</option>';
							}
								
							
							echo '</select>
							</p>
							
							<p>Subsección: 
							<select name="id_subseccion_editar_noticia">
								<option disabled value> Subsección </option>';
								
							foreach ($this->secciones as $seccion){
								foreach ($seccion->getSubsecciones() as $subseccion){
									echo '<option value="'.$subseccion->getId().'" ';
									
									if ($this->noticia->getSubseccion()->getId() == $subseccion->getId())
										echo 'selected';
									
									echo '>'.$subseccion->getNombre().'</option>';
								}
							}
								
									
							echo '</select>
							</p>
							<span> Entradilla: </span>
							<textarea name="entradilla" placeholder="entradilla" required>'.$this->noticia->getEntradilla().'</textarea>
							<p> Imágenes: <p>';
							$this->mostrarNavegadorImagenes();
							
							echo '<p> Video: </p>';
							$this->mostrarVideo();
							
							echo '<input id="nuevo_video" type="file" name="video" placeholder="video">
							<p>Cuerpo:</p>
							<div class="editor">
								<textarea id="editor" name="cuerpo" placeholder="cuerpo" required>'.$this->noticia->getCuerpo().'</textarea>
							</div>
							<input type="hidden" name="id_noticia" value="'.$this->noticia->getId().'">
						</fieldset>
				</form>';
				$this->mostrarOpciones();
			echo '</div>
				
			<script type="text/javascript">mostrarEditorHTML();</script>';
	
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button type="submit" form="miFormularioEditarNoticia" name="accion" value="confirmar_edicion">Confirmar cambios</button>
		<a href="gestor_noticias.php"><button>Volver</button></a>
		</div>';
	}
	
	private function mostrarVideo(){
		$video = $this->noticia->getVideo();
		if ($video != null){
			// Comprobar si el video es un enlace:
			if (filter_var($video, FILTER_VALIDATE_URL)) { 
				echo '<iframe src="'.$video.'"frameborder="0" allowfullscreen></iframe>';
			} else {
				echo '<video controls>
					<source src="'.$video.'" type="video/mp4">Tu navegador no soporta la etiqueta vídeo.</video>';
			}
			echo '<input type="hidden" name="video_modificar" value="'.$video.'">';
		}
	}
	
	private function mostrarNavegadorImagenes(){
		$imagenes = $this->noticia->getImagenes();
		
		echo	'<div class="contenedor_imagenes">';
		
		$contador_imagenes = 0;
		foreach ($imagenes as $imagen){
			$url = array_values($imagenes)[$contador_imagenes]->getUrl();
			$pie = array_values($imagenes)[$contador_imagenes]->getPie();
			echo	'<div class="diapositiva fade">
						<figure class="fotoNoticia">
							<a href="'.$url.'" target="_blank">
								<img class="fotoNoticia" src="'.$url.'">
							</a>
							<figcaption class="pieDeFoto">
								<textarea name="pies_imagenes" placeholder="Pie de la imagen">'.$pie.'</textarea>
							</figcaption>
							<input class="modificar_imagenes" type="file" name="modificar_imagenes[]" placeholder="imagen" 
								onchange="modificarImagen('.$imagen->getId().');">
						</figure>
					</div>';
			$contador_imagenes++;
		}
		
		echo 	'	<a class="anterior" onclick="siguienteDiapositiva(-1)">&#10094;</a>
					<a class="siguiente" onclick="siguienteDiapositiva(1)">&#10095;</a></div>
				<div class="puntos">';
				
				$contador_imagenes = 1;
				foreach ($imagenes as $imagen){
					echo '<span class="punto" onclick="diapositivaActual('.$contador_imagenes.')"></span>';
					$contador_imagenes++;
				}
				
		echo	'</div>		
				<script type="text/javascript" src="javascript/navegador_imagenes.js"></script>';
	}
	
	protected function mostrarSideBar(){}
}
?>