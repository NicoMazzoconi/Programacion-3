<?php
include_once "humano.php";
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