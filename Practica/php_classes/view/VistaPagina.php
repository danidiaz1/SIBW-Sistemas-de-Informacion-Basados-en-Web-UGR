<?php

/* Superclase abstracta de todas las vistas. Instancia las variables comunes a todas las páginas:
el título, la fecha, el archivo de estilo css y el formato de la fecha. Además,
se incluye como parámetros opcionales un array de anuncios y otro para las secciones
del menú. Están a null por defecto porque hay páginas que no tienen anuncios ni menú.

También contiene los métodos comunes a todas las páginas: mostrar el inicio del documento
html, mostrar la cabecera, el contenido, el sidebar y el pie de página. Cada vista puede
cambiar el comportamiento por defecto de estos métodos.*/

abstract class VistaPagina {
	
	protected $titulo;
	protected $fecha;
	protected $estilo;
	protected $formato_fecha;
	protected $publicidades;
	protected $secciones;
	
	public function __construct($publicidades = null, $secciones = null){
		$this->setFecha('es');
		$this->formato_fecha = "d-m-Y";
		$this->publicidades = $publicidades;
		$this->secciones = $secciones;
	}
	
	protected function setFecha($encoding){
		setlocale(LC_TIME, $encoding);
		$this->fecha = ucfirst(iconv("ISO-8859-1","UTF-8",strftime('%A, %d de %B de %Y')));
		
	}
	
	protected function mostrarInicioHTML(){
		echo '	<!DOCTYPE html> 
				<html>
					<head>
						<meta charset="UTF-8">
						<link rel="stylesheet" type="text/css" href="estilos/estilo_comun.css">'
						.$this->estilo.
						'<link rel="shortcut icon" type="image/x-icon" href="resources/imagenes/icono.ico">
						<script type="text/javascript" src="javascript/comentarios.js"></script>
						<script type="text/javascript" src="javascript/date.js"></script>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
						<script type="text/javascript" src="javascript/login-box.js"></script>
						<title>' . $this->titulo . '</title> 
					</head> 
					
					<body>
						<div class="contenido">';
	}
	
	protected function mostrarHeader(){
		echo '	<div class="cabecera">
				<div class="fechaLogo">
					<a href="index.php">
						<img class="logo" alt="Daily News"
						title="Daily News" src="resources/imagenes/logo.png">
					</a>
					<p id="fechaActual">'.$this->fecha .'</p>
				</div>
				<div class="usuarios">';
				if (isset($_SESSION['usuario']))
					echo '<div class="sesion_iniciada"><p>Identificado como <span>'.$_SESSION['usuario'].'</span>. </p>
						<p><a href="logout.php"> Cerrar sesión. </a></p></div>';
				else 
					echo '<a class="iniciar_sesion" href="accounts.php">Iniciar Sesión</a>';
				
				
		echo	'</div>';
		
		$this->mostrarMenu();
		
		echo 	'</div>';
	}
	
	protected function mostrarMenu() {
		echo '<div class="secciones">
					<ul class="secciones">
						<li class="inicio"> <a href="index.php">Inicio</a></li>';
						foreach ($this->secciones as $seccion){
							$nombre_seccion = $seccion->getNombre();
							echo '<li class="seccion"> <a href="index.php">'.$nombre_seccion.'</a>
								<ul class="subsecciones">';
								
							foreach ($seccion->getSubsecciones() as $subseccion){
								echo '<li class="subseccion"> <a href="index.php">'.$subseccion->getNombre().'</a></li>';
							}
							
							echo '</ul></li>';
						}
		echo		'</ul>
				</div>';
	}
	
	protected function mostrarFooter() {
		echo '<div class="footer"> 
				<ul class="aspectos_legales">
					<li>
					<a href="#~o">Términos y condiciones de uso</a>
					</li>
					<li>
					<a href="#~o">Política de privacidad</a>
					</li>
					<li>
					<a href="#~o">Política de cookies</a>
					</li>
					<li>
					<a href="#~o">Contacto</a>
					</li>
					<li>
					<a href="#~o">Publicidad</a>
					</li>
				</ul>
				
				<ul class="rrss">
				<p> Nuestras redes sociales</p>
					<li>
						<a href="facebook.html" target="_blank">
							<img class="icono_rrss" alt="Facebook"
							title="Facebook" src="resources/imagenes/facebook_icon.png">
						</a>
					</li>
					<li>
						<a href="twitter.html" target="_blank">
							<img class="icono_rrss" alt="Twitter"
							title="Twitter" src="resources/imagenes/twitter_icon.png">
						</a>
					</li>
				</ul>
			</div>';
	}
	
	protected function mostrarFinalHTML(){
		echo '</div>
			</body> 
		</html>';
		
	}
	
	protected abstract function mostrarContenido();
	
	protected abstract function mostrarSideBar();
	
	protected function mostrarMenuGestorContenidos(){
		echo '<div class="menuGestorContenidos">
				<h1> Menú de gestión de contenidos</h1>
				<ul>
					<li><a href="gestor_noticias.php">Noticias</a></li>
					<li><a href="gestor_comentarios.php">Comentarios</a></li>
					<li><a href="gestor_publicidad.php">Publicidad</a></li>
					<li><a href="gestor_secciones.php">Secciones y subsecciones</a></li>
					<li><a href="">Organizador de la página de inicio</a></li>
				</ul>
			</div>';
	}
	
	protected function mostrarMenuGestorContenidosRedactor(){
		echo '<div class="menuGestorContenidos">
				<h1> Menú de gestión de contenidos</h1>
				<ul>
					<li><a href="gestor_noticias.php">Noticias</a></li>
				</ul>
			</div>';
	}
	
	protected function mostrarPublicidad($id){
		$publicidad = $this->publicidades[$id];
		echo '<ul class="publicidad">
				<li> 
					<a href="click_publicidad.php?id_publicidad='.$publicidad->getId().'&url='.$publicidad->getUrl().'">
						<img class="hoteles"
						title="'.$publicidad->getTitulo().'" src="'.$publicidad->getImagen().'">
					</a>
				</li>
			</ul>';
	}
	
	public function mostrarPagina(){
		$this->mostrarInicioHTML();
		
		$this->mostrarHeader();
		
		$this->mostrarContenido();
		if (isset($_SESSION['usuario'])){
			if ($_SESSION['tipo']== 'editor_jefe')
				$this->mostrarMenuGestorContenidos();
			else if ($_SESSION['tipo']== 'redactor')
				$this->mostrarMenuGestorContenidosRedactor();
		}
		$this->mostrarSideBar();
		
		$this->mostrarFooter();
		
		$this->mostrarFinalHTML();
	}
}
?>