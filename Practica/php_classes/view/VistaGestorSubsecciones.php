<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaGestorSubsecciones extends VistaPagina{
	private $seccion;
	
	public function __construct($seccion, $secciones, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de subsecciones';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<script type="text/javascript" src="javascript/gestor_subsecciones.js">';
		$this->seccion = $seccion;
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_subsecciones">
				<h1> Viendo las subsecciones de la seccion: '.$this->seccion->getNombre().'.</h1>';
				
				$this->mostrarOpciones();
		
				echo '<div class="nueva_subseccion">
					<form id="miFormularioNuevaSubseccion" action="gestor_subsecciones.php" name="miFormularioNuevaSubseccion" class="formularioNuevaSubseccion" method="get">
						<fieldset>
							<legend>Nueva subsección</legend>
							<input type="text" name="nombreSubseccion" placeholder="nombre de la subsección" required>
							<input type="hidden" name="id_seccion" value="'.$this->seccion->getIdSeccion().'">
							<button type="submit" id="enviarSubseccion" name="accion" value="insertar" form="miFormularioNuevaSubseccion">Enviar</button>
							<button class="ocultar">Ocultar</button>
						</fieldset>
					</form>
					
				</div>
				<script type="text/javascript">mostrarNuevaSubseccion();</script>
				
				<ul>
					<form name="miFormularioSubsecciones" action="gestor_subsecciones.php" id="formGestionSubsecciones"  method="get">
					<input type="hidden" name="id_seccion" value="'.$this->seccion->getIdSeccion().'">';
				
				$this->mostrarSubsecciones();
			
			echo '</form>
				</ul>
			</div>';	
	}
	
	private function mostrarSubsecciones(){
		
		foreach ($this->seccion->getSubsecciones() as $subseccion){
			
			echo '<label><li id="subseccion'.$subseccion->getId().'" class="subseccion">
					<h1><input class="selector_subseccion" type="checkbox" name="ids_subseccion[]" value="'.$subseccion->getId().'">'.$subseccion->getNombre().'
					<a class="enlace_editar" href="#~o" 
						onclick="mostrarEdicionSubseccion('."'".'subseccion'.$subseccion->getId()."'".', '.$subseccion->getId().');">
						<img class="imagen_editar" src="resources/imagenes/editar.ico" title="Editar subsección"></a></h1>
				</li></label>';
		}
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button id="boton_nueva_subseccion">Incluir nueva subsección</button>
		<button type="submit" form="formGestionSubsecciones" name="accion" value="eliminar">Eliminar</button>
		<a href="gestor_secciones.php"><button>Volver</button></a>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>