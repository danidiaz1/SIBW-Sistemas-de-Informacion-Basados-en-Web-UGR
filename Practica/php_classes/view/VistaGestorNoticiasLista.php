<?php

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaGestorNoticiasLista extends VistaPagina{

	private $noticias;
	private $estado;
	
	public function __construct($noticias, $secciones, $estado, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de comentarios';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<script type="text/javascript" src="javascript/gestor_noticias.js"></script>
		<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>';
		$this->noticias = $noticias;
		$this->estado = $estado;
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_noticias">';
		$noticias = array_values($this->noticias);
			if (sizeof($this->noticias) != 0){
				if ($this->estado == 'seccion')
					echo '<h1> Viendo las noticias de la sección: '.$noticias[0]->getSeccion()->getNombre().'.</h1>';
				else if ($this->estado == 'subseccion')
					echo '<h1> Viendo las noticias de la subsección: '.$noticias[0]->getSubseccion()->getNombre().'.</h1>';
			} else
				echo '<h1> No se encontraron noticias </h1>';
			
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
								echo '<option value="'.$seccion->getIdSeccion().'">'.$seccion->getNombre().'</option>';
							
							echo '</select>
							<select name="id_subseccion_nueva_noticia">
								<option disabled selected value> Subsección </option>';
								
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
				
				if (sizeof($this->noticias) != 0){
					echo '<h1> Puedes seleccionar en el icono del lápiz para editar la noticia. </h1>
					<ul>';
					
					if ($this->estado == 'seccion')
						$direccion = '?id_seccion='.$noticias[0]->getSeccion()->getIdSeccion();
					else if ($this->estado == 'subseccion')
						$direccion = '?id_seccion='.$noticias[0]->getSubseccion()->getIdSubseccion();
					
					echo '<form name="miFormularioNoticias" action="gestor_noticias.php'.$direccion.'" id="formGestionNoticias"  method="post">
					<p> Cambiar el estado de la(s) noticia(s) a: 
						<select id="select_cambiar_estado_noticia" name="nuevo_estado">
							<option value="publicada" selected>Publicada</option>
							<option value="pendiente">Pendiente</option>
						</select>
						<button type="submit" form="formGestionNoticias" name="accion" value="cambiar_estado">Confirmar</button>
					</p>';

					$this->mostrarNoticias();
					
					echo '</form></ul>';
				}

		echo '</div>';
				
	}

	private function mostrarNoticias(){
		foreach ($this->noticias as $noticia){
			echo '<label><li>
					<input class="selector_noticia" type="checkbox" name="ids_noticia[]" value="'.$noticia->getId().'">
					<input type="hidden" name="videoEliminar'.$noticia->getId().'" value="'.$noticia->getVideo().'">
					
					<article>
						<figure>
							<a href="noticia.php?id='.$noticia->getId().'" title="'.$noticia->getTitular().
							'"><img src="'.array_values($noticia->getImagenes())[0]->getUrl().
							'"></a>
						</figure>
						
						<h1>
							<a href="noticia.php?id='.$noticia->getId().'" title="'.$noticia->getTitular().
							'">'.$noticia->getTitular().
							'</a>';
						$estado = $noticia->getEstado();
						
						if ($estado == 'publicada')
							echo '<span class="estado_publicada">'.ucfirst($estado).'</span>';
						else
							echo '<span class="estado_pendiente">'.ucfirst($estado).'</span>';
						
						echo '</h1>
						
						<h2 class="autorFecha"><span class="autor">'.$noticia->getAutor().'
						</span> | <span class="fecha">'.date($this->formato_fecha, strtotime($noticia->getFechaPublicacion())).', 
						'.$noticia->getHoraPublicacion().'</span><a class="enlace_editar" href="gestor_noticias.php?id_noticia='.$noticia->getId().'">
						<img class="imagen_editar" src="resources/imagenes/editar.ico" title="Editar noticia"></a></h2>
						
					</article>
				</li></label>';
			
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
		<button id="boton_nueva_noticia">Incluir nueva noticia</button>
		<button type="submit" form="formGestionNoticias" name="accion" value="eliminar">Eliminar</button>
		<a href="gestor_noticias.php"><button>Volver</button></a>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>