<?php
/* Clase que modela un usuario registrado normal del periódico. 
Se evita guardar la contraseña como propiedad*/
class ModelUsuario {
	private $correo;
	private $nickname;
	private $tipo;
	
	public function __construct($correo, $nickname, $tipo)
	{
		$this->correo = $correo;
		$this->nickname = $nickname;
		$this->tipo = $tipo;
	}
	
	public function getCorreo(){
		return $this->correo;
	}
	
	public function getNickname(){
		return $this->nickname;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
}
?>