<?php
include_once "./Clases/humano.php";
class Persona extends Humano
{
	public $dni;

	public function __construct($dni = NULL, $nombre = NULL, $edad = NULL)
	{	
		parent::__construct($nombre, $edad);
		$this -> dni = $dni;
	}
}
?>