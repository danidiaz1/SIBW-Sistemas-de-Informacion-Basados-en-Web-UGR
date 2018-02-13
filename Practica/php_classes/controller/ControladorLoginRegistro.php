<?php
include('Controlador.php');
include('php_classes/view/VistaLoginRegistro.php');

/* Clase encargada de registrar e identificar usuarios, extrayendo o insertando
información en el Modelo para este cometido. También se encarga de crear la vista
de la página de login/registro*/
class ControladorLoginRegistro extends Controlador {
	
	private $vista_login_registro;
	
	public function __construct($tiene_publicidad = false, $tiene_menu = true){
		parent::__construct($tiene_publicidad, $tiene_menu);
		
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$secciones = $this->obtenerSecciones();
		$this->contenedor->cerrarConexion();
		
		$this->vista_login_registro = new VistaLoginRegistro($secciones);
	}
	
	public function mostrarPagina(){
		
		$this->vista_login_registro->mostrarPagina();
	}
	
	
	public function identificarUsuario($correo,$password){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$usuario = $this->contenedorUsuarios->identificarUsuario($correo,$password);
		$this->contenedor->cerrarConexion();
		
		if ($usuario != null){
			$mensaje = 'Estás identificado.';
			$color = 'green';
			
			$_SESSION['usuario'] = $usuario->getNickname();
			$_SESSION['correo'] = $usuario->getCorreo();
			$_SESSION['tipo'] = $usuario->getTipo();
		} else {
			$mensaje = 'Usuario o contraseña no correctas.';
			$color = 'red';
		}
		
		$this->vista_login_registro->setWarning($mensaje, $color);
	}
	
	public function registrarUsuario($correo,$nickname,$password){
		$this->contenedor->conectar($this->host,$this->usuarioBD,$this->pass,$this->BD);
			$exito = $this->contenedorUsuarios->insertarUsuario($correo,$nickname,$password);
		$this->contenedor->cerrarConexion();
		
		$mensaje = 'Usuario ya registrado con ese correo electrónico.';
		$color = 'red';
		
		if ($exito){
			$mensaje = 'Usuario registrado correctamente. Utiliza tu correo electrónico y contraseña para entrar.';
			$color = 'green';
		}
		
		$this->vista_login_registro->setWarning($mensaje, $color);
	}
}
?>