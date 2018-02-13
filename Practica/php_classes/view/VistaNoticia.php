<?php
include('VistaPagina.php');

class VistaNoticia extends VistaPagina{
	private $noticia;
	private $palabras_prohibidas;
	
	public function __construct($noticia, $publicidades, $palabras_prohibidas, $secciones){
		parent::__construct($publicidades, $secciones);
		$this->noticia = $noticia;
		$this->palabras_prohibidas = $palabras_prohibidas;
		$this->titulo = $noticia->getTitular();
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_noticia.css">';
	}
	
	protected function mostrarPublicidad($id){
		$publicidad = $this->publicidades[$id];
		echo '<h1 class="marcador">Publicidad</h1>
				<ul class="publicidad">
					<li> 
						<a class="publi1" href="click_publicidad.php?id_publicidad='.$publicidad->getId().'&url='.$publicidad->getUrl().'">
							<img class="etsiit" alt="Jornadas de Formacion"
							title="'.$publicidad->getTitulo().'" src="'.$publicidad->getImagen().'">
						</a>
					</li>
				</ul>';
	}
	
	private function mostrarComentarios(){
		// Mostramos los comentarios, para cada comentario se hace un "echo"
		// para mostrarlo.
		$comentarios = $this->noticia->getComentarios();
		
		echo 	'<div class="divComentarios" id="misComentarios">
					<span class="cerrar">&times;</span>
					<div id="miDivComentariosContenido">
					<h1>Zona de comentarios</h1>';
						
					foreach ($comentarios as $comentario){
						$fecha = date($this->formato_fecha, strtotime($comentario->getFecha()));
						echo '<div class="comentario">
								<h1>Autor: 
									<span class="nombreComentario">'.$comentario->getNombre().'</span>
									</h1>
								<h2>
									Fecha: <span class="fechaComentario">'.$fecha.'</span> | 
									Hora: <span class="horaComentario">'.$comentario->getHora().'</span>
								</h2>
								<p class="textoComentario">'.$comentario->getTexto().'</p>
						</div>';
					}
								
			echo	'</div>';
			
			if (isset($_SESSION['usuario'])){
				echo '<div class="divFormularioComentarios">
						<form id="miFormularioComentarios" name="miFormularioComentarios" class="formularioComentarios" method="post">
							<fieldset>
								<legend>Nuevo comentario</legend>
								<input value="'.$_SESSION['usuario'].'" type="text" name="nombreComentario" placeholder="nombre" required>
								<input value="'.$_SESSION['correo'].'" type="email" name="emailComentario" placeholder="correo electrónico" required>
								<input type="hidden" id="id_noticia" value="'.$this->noticia->getId().'">
								<textarea name="textoComentario" placeholder="escribe tu comentario" required></textarea>
								<input type="submit" id="enviarComentario" name="enviarComentario"/>
							</fieldset>
						</form>
					</div>
					
					<script type="text/javascript">comprobarComentario('.$this->palabras_prohibidas.');</script>
					<script type="text/javascript">enviarComentario();</script>';		
			} else
				echo '<p><a class="iniciar_sesion" href="accounts.php">inicia sesión para comentar</a></p>';
			
			
			echo 	'<script type="text/javascript">mostrarComentarios();</script>
				</div>';
				
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
								<figcaption class="pieDeFoto">'.$pie.'</figcaption>
							</a>
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
		echo	'<div class="cuerpo">';
	}
	
	private function mostrarNoticiaRelacionada($noticia){
		if ($noticia->isPublicada()){
			$imagenes = $noticia->getImagenes();
			echo '<li>
					<h1 class="titularRelacionado">
						<a class="titularRelacionado" href="noticia.php?id='.$noticia->getId().'#~o">
						'.$noticia->getTitular().'
						<img class="fotoNoticia" src="'.array_values($imagenes)[0]->getUrl().'">
						</a>
					</h1>
				</li>';
		}
		
	}
	
	protected function mostrarContenido(){
		if ($this->noticia->isPublicada()){
			echo '<article>
					<ul class="redesSociales">
						<li class="facebook">
							<a id="facebook" href="#~o" onClick="mostrarVentanaFacebook('.$this->noticia->getId().')">
								<img class="iconoRedSocial" alt="Compartir en Facebook"
								title="Compartir en Facebook" src="resources/imagenes/facebook_icon.png">
							</a>
						</li>
						<li class="twitter">
							<a id="twitter" href="#~o" onClick="mostrarVentanaTwitter('.$this->noticia->getId().')">
								<img class="iconoRedSocial" alt="Twittear"
								title="Twittear" src="resources/imagenes/twitter_icon.png">
							</a>
						</li>
						<li class="imprimir">
							<a href="noticia_imprimir.php?id='.$this->noticia->getId().'">
								<img class="iconoRedSocial" alt="Imprimir"
								title="Imprimir" src="resources/imagenes/printer_icon.png">
							</a>
						</li>
						<li class="listaComentarios">
							<a id="enlaceComentarios" href="#~o" >
								<img class="iconoRedSocial" alt="Comentarios"
								title="Comentarios" src="resources/imagenes/comentar.ico">
							</a>
						</li>
					</ul>
					<script type="text/javascript" src="javascript/rrss.js"></script>';
			echo	'<p class="seccion">';
			echo	$this->noticia->getSeccion()->getNombre();
					
			echo 	'</p>
					<hr>
					<p class="autorFecha"><span class="autor"> ';

			echo	$this->noticia->getAutor();
					
			echo	'</span> | <span class="fecha">Publicado el ';
			
			echo	date($this->formato_fecha, strtotime($this->noticia->getFechaPublicacion()));
			
					
			echo 	', '.$this->noticia->getHoraPublicacion().'</span> | <span class="fecha"> Última modificación: ';
			
			echo 	date($this->formato_fecha, strtotime($this->noticia->getFechaModificacion()));
			
			echo 	', '.$this->noticia->getHoraModificacion().'</span></p>
					<hr>
					<h1 class="titular">';
					
			echo	$this->noticia->getTitular();
					
			echo 	'</h1>
					<h2 class="subtitulo">';
					
			echo	$this->noticia->getSubtitulo();
					
			echo	'</h2>
					<p class="entradilla">';
					
			echo	$this->noticia->getEntradilla();
					
			echo 	'</p>';
			
			$this->mostrarNavegadorImagenes();
					
			echo	$this->noticia->getCuerpo();
			
			echo	'</div>';
			
			$this->mostrarVideo();
			
			$this->mostrarComentarios();
			
			echo	'</article>';
		} else 
			echo '<p> Noticia no disponible </p>';
		
	}
	
	// Método encargado de mostrar el video asociado a la noticia, si lo tiene.
	// Comprueba si es un enlace a youtube o una url del sistema de ficheros para
	// mostrarlo de la manera adecuada.
	private function mostrarVideo(){
		$video = $this->noticia->getVideo();
		if ($video != null){
			// Comprobar si el video es un enlace:
			if (filter_var($video, FILTER_VALIDATE_URL)) { 
				echo '<iframe src="'.$video.'"frameborder="0" allowfullscreen></iframe>';
			} else {
				echo '<video controls>
						  <source src="'.$video.'" type="video/mp4">
						  Tu navegador no soporta la etiqueta vídeo.
					</video>';
			}
		}
	}
	
	protected function mostrarSideBar(){
		echo '<div class="info">';
		
		$this->mostrarPublicidad(rand(1,count($this->publicidades)));
		
		echo '<h1 class="marcador">Relacionado</h1>
			  <ul class="noticiasRelacionadas">';
		
			foreach ($this->noticia->getNoticiasRelacionadas() as $noticia_relacionada)
				$this->mostrarNoticiaRelacionada($noticia_relacionada);
			
		echo '</ul>
		</div>';	
	}
}
?>