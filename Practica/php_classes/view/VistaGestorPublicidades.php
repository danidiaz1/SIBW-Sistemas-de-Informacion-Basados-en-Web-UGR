<?php
include('VistaPagina.php');

class VistaGestorPublicidades extends VistaPagina{

	public function __construct($publicidades, $secciones){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de publicidades';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<script type="text/javascript" src="javascript/gestor_publicidades.js">';
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_publicidades">
				<h1> Viendo los anuncios publicitarios.</h1>';
				
				$this->mostrarOpciones();
		
				echo '<div class="nueva_publicidad">
					<form id="miFormularioNuevaPublicidad" action="gestor_publicidad.php" 
					enctype="multipart/form-data" name="miFormularioNuevaPublicidad" class="formularioNuevaPublicidad" method="post">
						<fieldset>
							<legend>Nuevo anuncio</legend>
							<input type="text" name="titulo" placeholder="título" required>
							<span> Imagen: </span>
							<input type="file" name="imagen" id="imagenPublicidad" required>
							<input type="text" name="texto" placeholder="texto" required>
							<input type="text" name="enlace" placeholder="enlace" required>
							<button type="submit" id="enviarPublicidad" name="accion" value="insertar" form="miFormularioNuevaPublicidad">Enviar</button>
							<button class="ocultar">Ocultar</button>
						</fieldset>
					</form>
					
				</div>
				<script type="text/javascript">mostrarNuevaPublicidad();</script>
				
				<ul>
					<form name="miFormularioPublicidades" action="gestor_publicidad.php" id="formGestionPublicidades"  method="post" enctype="multipart/form-data">';
				
				$this->mostrarPublicidades();
			
			echo '</form>
				</ul>
			</div>';	
	}
	
	private function mostrarPublicidades(){
		
		foreach ($this->publicidades as $publicidad){
			
			echo '<label><li id="publicidad'.$publicidad->getId().'" class="publicidad">
					<h1>
						<input class="selector_publicidad" type="checkbox" name="ids_publicidad[]" value="'.$publicidad->getId().'">'.$publicidad->getTitulo().
						'<a class="enlace_stats" href="estadpubli.php?id='.$publicidad->getId().'">
							<img class="imagen_stats" title="Ver estadísticas" src="resources/imagenes/stats.png">
						</a>
					</h1>
					<a class="imagen_publi" href="'.$publicidad->getUrl().'">
						<img class="img_publicidad"
						title="'.$publicidad->getTitulo().'" src="'.$publicidad->getImagen().'">
					</a>
					<p class="texto_publicidad">Texto: <span class="span_texto">'.$publicidad->getTexto().'</span></p>
					<p class="parrafo_publicidad">Enlace: <a class="enlace_publicidad" href="'.$publicidad->getUrl().'">'.$publicidad->getUrl().'</a></p>
					<p><a class="enlace_editar" href="#~o" 
						onclick="mostrarEdicionPublicidad('."'".'publicidad'.$publicidad->getId()."'".', '.$publicidad->getId().');">
						<img class="imagen_editar" src="resources/imagenes/editar.ico" title="Editar anuncio"></a></p>
					<input type="hidden" name="imagenEliminar'.$publicidad->getId().'" value="'.$publicidad->getImagen().'">
				</li>
			</label>';
		}
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button id="boton_nueva_publicidad">Incluir nuevo anuncio</button>
		<button type="submit" form="formGestionPublicidades" name="accion" value="eliminar">Eliminar</button>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>