<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaGestorSecciones extends VistaPagina{

	public function __construct($secciones, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Gestor de secciones';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_gestores.css">
		<script type="text/javascript" src="javascript/gestor_secciones.js">';
	}
	
	protected function mostrarContenido(){
		echo '<div class="listado_secciones">
				<h1> Viendo las secciones del menú.</h1>
				<h2> Pulsa en una sección para gestionar sus subsecciones.</h2>';
				
				$this->mostrarOpciones();
		
				echo '<div class="nueva_seccion">
					<form id="miFormularioNuevaSeccion" action="gestor_secciones.php" name="miFormularioNuevaSeccion" class="formularioNuevaSeccion" method="get">
						<fieldset>
							<legend>Nueva sección</legend>
							<input type="text" name="nombreSeccion" placeholder="nombre de la sección" required>
							<button type="submit" id="enviarSeccion" name="accion" value="insertar" form="miFormularioNuevaSeccion">Enviar</button>
							<button class="ocultar">Ocultar</button>
						</fieldset>
					</form>
					
				</div>
				<script type="text/javascript">mostrarNuevaSeccion();</script>
				
				<ul>
					<form name="miFormularioSecciones" action="gestor_secciones.php" id="formGestionSecciones"  method="get">';
				
				$this->mostrarSecciones();
			
			echo '</form>
				</ul>
			</div>';	
	}
	
	private function mostrarSecciones(){
		
		foreach ($this->secciones as $seccion){
			
			echo '<label><li id="seccion'.$seccion->getIdSeccion().'" class="seccion">
					<a class="seccion" href="gestor_subsecciones.php?id_seccion='.$seccion->getIdSeccion().
					'"><input class="selector_seccion" type="checkbox" name="ids_seccion[]" value="'.$seccion->getIdSeccion().'">'.$seccion->getNombre().'</a>
					<a class="enlace_editar" href="#~o" 
						onclick="mostrarEdicionSeccion('."'".'seccion'.$seccion->getIdSeccion()."'".', '.$seccion->getIdSeccion().');">
						<img class="imagen_editar" src="resources/imagenes/editar.ico" title="Editar sección"></a>
				</li></label>';
		}
	}
	
	private function mostrarOpciones(){
		echo '<div class="botones">
		<button id="boton_nueva_seccion">Incluir nueva sección</button>
		<button type="submit" form="formGestionSecciones" name="accion" value="eliminar">Eliminar</button>
		</div>';
	}
	
	protected function mostrarSideBar(){}
}
?>