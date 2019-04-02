<?php
$data = $_SERVER['REQUEST_METHOD'];
switch($data)
{
	case "GET":
		require_once "Funciones/listarAlumnos.php";
	break;
	
	case "POST":
		require_once "Funciones/crearAlumno.php";
	break;
	
	case "DELETE":
		require_once "Funciones/borrarAlumno.php";
	break;
	
	case "PUT":
		require_once "Funciones/modificarAlumno.php";
	break;
}
?>