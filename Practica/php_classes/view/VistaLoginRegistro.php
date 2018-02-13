<?php
include('VistaPagina.php');

/* Clase encarga de crear la Vista de la página de login/registro*/
class VistaLoginRegistro extends VistaPagina{
	private $warning;
	private $color_warning;
	
	public function __construct($secciones, $publicidades = null){
		parent::__construct($publicidades, $secciones);
		$this->titulo = 'Cuentas de Daily News';
		$this->estilo = '<link rel="stylesheet" type="text/css" href="estilos/estilo_login_registro.css">';
		$this->warning = '';
		$this->color_warning = '';
	}
	
	protected function mostrarContenido(){
		if(!isset($_SESSION['usuario'])){
			echo '<div class="login-box">';
			
			$this->mostrarFormularioRegistro();
			$this->mostrarFormularioAcceso();
			
			echo 	'<p class="warning" style="color: '.$this->color_warning.'">'.$this->warning.'</p>
					<h1 class="ventajas_registro"> Los usuarios registrados pueden escribir comentarios en nuestras noticias.</h1>
				</div>
			<script type="text/javascript">cambiarLoginBox();</script>';
		} else {
			echo '<p>Estás identificado. <a href="logout.php"> Cerrar sesión </a></p>';
		}
			$this->warning = '';
			$this->color = '';
	}
	
	public function setWarning($mensaje, $color){
		$this->warning = $mensaje;
		$this->color_warning = $color;
	}
	
	protected function mostrarSideBar(){}
	
	private function mostrarFormularioRegistro(){
		echo '<div class="form form_registro">
					<h1> Registro </h1>
					<form action="accounts.php" method="post" id="form_registro">
						<input class="input_login_box" type="email" name="email" placeholder="e-mail" required/>
						<input class="input_login_box" type="text" name="nombre" placeholder="nombre de usuario" required/>
						<input class="input_login_box" type="password" name="pass" placeholder="contraseña" required/>
					</form>
					<button type="submit" form="form_registro" name="registro" class="boton_login" value="registro">Regístrate</button>
					<p class="mensaje_login_box">¿Ya estás registrado? <a href="#">Identifícate</a></p>
			   </div>';
	}
	
	private function mostrarFormularioAcceso(){
		echo '<div class="form form_login">
					<h1> Identificación </h1>
					<form action="accounts.php" method="post" id="form_login">
						<input class="input_login_box" type="email" name="email" placeholder="e-mail" required/>
						<input class="input_login_box" type="password" name="pass" placeholder="contraseña" required/>
					</form>
					<button type="submit" form="form_login" name="login" class="boton_login" value="login">Identifícate</button>
					<p class="mensaje_login_box">¿No estás registrado? <a href="#">Crea una cuenta</a></p>
				</div>';
	}
}
?>