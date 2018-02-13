<?php
/* Clase que modela las secciones del menú del periódico*/
class ModelSeccion {
	private $id_seccion;
	private $nombre;
	private $subsecciones;
	
	public function __construct($id_seccion, $nombre, $subsecciones)
	{
		$this->id_seccion = $id_seccion;
		$this->nombre = $nombre;
		$this->subsecciones = $subsecciones;
	}
	
	public function getIdSeccion(){
		return $this->id_seccion;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function getSubsecciones(){
		return $this->subsecciones;
	}
}
?>