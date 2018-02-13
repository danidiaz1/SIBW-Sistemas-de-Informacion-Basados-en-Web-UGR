<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaGestorNoticias extends VistaPagina{

	public function __construct($secciones, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de noticias';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<script type="text/javascript" src="javascript/gestor_noticias.js"></script>
		<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>';
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_secciones">
				<h1> Gestor de noticias.</h1>';
				
				$this->mostrarOpciones();
		
				echo '<div class="nueva_noticia">
					<form id="miFormularioNuevaNoticia" action="gestor_noticias.php" name="miFormularioNuevaNoticia" 
					enctype="multipart/form-data" class="formularioNuevaNoticia" method="post">
						<fieldset>
							<legend>Nueva noticia</legend>
							<input type="text" name="autor" placeholder="autor" required>
							<input type="text" name="titular" placeholder="titular" required>
							<input type="text" name="subtitulo" placeholder="subtitulo" required>
							<select name="id_seccion_nueva_noticia" required>;
								<option disabled selected value> Sección </option>';
								
							foreach ($this->secciones as $seccion)
								echo '<option value="'.$seccion->getIdSeccion().'" required> '.$seccion->getNombre().'</option>';
							
							echo '</select>
							<select name="id_subseccion_nueva_noticia" required>
								<option disabled selected value="0"> Subsección </option>';
								
							foreach ($this->secciones as $seccion){
								foreach ($seccion->getSubsecciones() as $subseccion)
									echo '<option value="'.$subseccion->getId().'">'.$subseccion->getNombre().'</option>';
							}
								
									
							echo '</select>
							<input type="text" name="entradilla" placeholder="entradilla" required>
							<span> Imágenes: <span>
							<input id="nuevas_imagenes" type="file" name="nuevas_imagenes[]" placeholder="imagen" multiple required>
							
							<textarea name="pies_imagenes" placeholder="Pies de las imágenes. Si incluyes varias imágenes, debes escribir varios pies separándolos por dos punto y coma (primer pie;;segundo pie)"></textarea>
							<span> Video: </span>
							<input id="nuevo_video" type="file" name="video" placeholder="video">
							<p>Cuerpo:</p>
							<div class="editor">
								<textarea id="editor" name="cuerpo" placeholder="cuerpo" required></textarea>
							</div>
							<button type="submit" id="enviarNoticia" name="accion" value="insertar" form="miFormularioNuevaNoticia">Enviar</button>
							<button class="ocultar">Ocultar</button>
						</fieldset>
					</form>
				</div>
				<script type="text/javascript">mostrarNuevaNoticia();</script>
				<script type="text/javascript">mostrarEditorHTML();</script>';
				
				if ($_SESSION['tipo'] == 'editor_jefe'){
					echo '<h2> Selecciona una sección/subsección para ver las noticias asociadas a la misma. </h2>
					<ul class="secciones_noticias">';
					
					$this->mostrarSecciones();
				
					echo '</ul>';
				}
				
			echo '</div>';	
	}
	
	private function mostrarSecciones(){
		
		foreach ($this->secciones as $seccion){
			
			echo '<li class="seccion">
					<a href="gestor_noticias.php?id_seccion='.$seccion->getIdSeccion().'">'.$seccion->getNombre().'</a>
					<ul class="subsecciones_gestor_noticias">';
					
					foreach ($seccion->getSubsecciones() as $subseccion)
						echo '<li class="subseccion">
								<a href="gestor_noticias.php?id_subseccion='.$subseccion->getId().'">'.$subseccion->getNombre().'</a>
							</li>';
						
				echo '</ul>
				</li>';
		}
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button id="boton_nueva_noticia">Incluir nueva noticia</button>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>