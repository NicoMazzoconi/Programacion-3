<?php
class Humano
{
	public $nombre;
	public $edad;

	public function __construct($nombre = NULL, $edad = NULL)
	{
		$this -> nombre = $nombre;
		$this -> edad = $edad;
	}

	public function retornarJSon()
	{
		return json_encode($this);
	}
}
?>