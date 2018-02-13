<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaGestorComentarios extends VistaPagina{

	private $noticias, $noticia, $estado;
	
	public function __construct($secciones, $noticias, $estado = 'ver_listado_noticias', $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de comentarios';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">';
		$this->noticias = $noticias;
		$this->noticia = null;
		$this->estado = $estado;
	}
	
	public function setNoticia($noticia){
		$this->noticia = $noticia;
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_noticias">';
		
		switch ($this->estado){
			case 'viendo_comentarios':
				echo '<h1> Viendo los comentarios de la noticia: </h1>
						<article>
							
							<figure>
								<a href="noticia.php?id='.$this->noticia->getId().'" title="'.$this->noticia->getTitular().
								'"><img src="'.array_values($this->noticia->getImagenes())[0]->getUrl().
								'"></a>
							</figure>
							
							<h1>
								<a href="noticia.php?id='.$this->noticia->getId().'" title="'.$this->noticia->getTitular().
								'">'.$this->noticia->getTitular().
								'</a>
							</h1>
							
							<h2 class="autorFecha"><span class="autor">' .$this->noticia->getAutor(). 
							'</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($this->noticia->getFechaPublicacion())).
							', '.$this->noticia->getHoraPublicacion().'</span></h2>
						</article>';
						$this->mostrarOpciones();
						
						echo '<div class="nuevo_comentario">
							<form id="miFormularioComentarios" action="gestor_comentarios.php" name="miFormularioComentarios" class="formularioComentarios" method="get">
								<fieldset>
									<legend>Nuevo comentario</legend>
									<p>Fecha: <input class="inputfecha" name="fecha" type="date"> </p>
									<p>Hora: <input class="inputhora" name="hora" type="time" step="1"></p>
									<input type="text" name="nombreComentario" placeholder="nombre" required>
									<input type="email" name="emailComentario" placeholder="correo electrónico" required>
									<textarea name="textoComentario" placeholder="texto del comentario" required></textarea>
									<input type="hidden" name="id_noticia" value="'.$this->noticia->getId().'">
									<button type="submit" id="enviarComentario" name="accion" value="insertar" form="miFormularioComentarios">Enviar</button>
									<button class="ocultar">Ocultar</button>
								</fieldset>
							</form>
							
						</div>
						<script type="text/javascript">mostrarNuevoComentario();</script>
						
						<ul>
							<form name="miFormularioNoticias" action="gestor_comentarios.php" id="formGestionComentarios"  method="get">
								<input type="hidden" name="id_noticia" value="'.$this->noticia->getId().'">';
				
				$this->mostrarComentarios($this->noticia);
					
				echo '		</form>
					</ul>';
			break;
			case 'viendo_listado_noticias':
				echo '<h1> Selecciona una noticia para gestionar sus comentarios </h1>
						<ul>';
				
				$this->mostrarNoticias();
					
				echo '</ul>';
				break;
		}
		
		echo '</div>';
				
	}
	
	private function mostrarComentarios($noticia){
		$comentarios = $noticia->getComentarios();
		
		foreach ($comentarios as $comentario){
			$fecha = date($this->formato_fecha, strtotime($comentario->getFecha()));
			echo '	
				
				<label><li id="comentario'.$comentario->getId().'" class="comentario">
					
					<h1><input class="selector_comentario" type="checkbox" name="ids_comentario[]" value="'.$comentario->getId().'">
						Autor: <span class="nombreComentario">'.$comentario->getNombre().'</span>
						<a class="enlace_editar" href="#~o" 
						onclick="mostrarEdicionComentario('."'".'comentario'.$comentario->getId()."'".', '.$comentario->getId().');">
						<img class="imagen_editar" src="resources/imagenes/editar.ico" title="Editar comentario"></a>
					</h1>
					<h1>Correo: <span class="emailComentario">'.$comentario->getCorreo().'</span></h1>
					<h2>
						Fecha: <span class="fechaComentario">'.$fecha.'</span> | 
						Hora: <span class="horaComentario">'.$comentario->getHora().'</span>
					</h2>
					<p class="textoComentario">'.$comentario->getTexto().'</p>

				</li></label>';
		}
	}
	
	private function mostrarNoticias(){
		foreach ($this->noticias as $noticia){
			if ($noticia->isPublicada()){
				echo '<li>
						<article>
							
							<figure>
								<a href="gestor_comentarios.php?id_noticia='.$noticia->getId().'" title="'.$noticia->getTitular().
								'"><img src="'.array_values($noticia->getImagenes())[0]->getUrl().
								'"></a>
							</figure>
							
							<h1>
								<a href="gestor_comentarios.php?id_noticia='.$noticia->getId().'" title="'.$noticia->getTitular().
								'">'.$noticia->getTitular().
								'</a>
							</h1>
							
							<h2 class="autorFecha"><span class="autor">'.$noticia->getAutor().'
							</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia->getFechaPublicacion())).', 
							'.$noticia->getHoraPublicacion().'</span></h2>
						</article>
						
					</li>';
			}
		}
	}
	
	private function mostrarSubMenu(){
		echo '<div class="submenu">
				<ul>
					<li> <a href="index.php">Inicio</a></li>
			</div>';
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button id="boton_nuevo_comentario">Incluir nuevo comentario</button>
		<button type="submit" form="formGestionComentarios" name="accion" value="eliminar">Eliminar</button>
		<a href="gestor_comentarios.php"><button>Volver</button></a>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>