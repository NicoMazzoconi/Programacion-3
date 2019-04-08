<?php
include_once "./Clases/alumno.php";
include_once "Funciones/guardarFoto.php";

if(isset($_FILES) || isset($_POST["nombre"]) || isset($_POST["edad"]) || isset($_POST["dni"]) || isset($_POST["legajo"]))
{
		if(guardarFoto($_FILES, $_POST))
			echo "Foto guardada";

		$explode = explode(".", $_FILES["imagen"]["name"]);
		$tam = count($explode) - 1;
		$miClase = new Alumno($_POST["nombre"], $_POST["edad"], $_POST["dni"], $_POST["legajo"], $_POST["legajo"]."-".$_POST["nombre"].$explode[$tam]);
		echo "<br><br> JSon alumno creado<br>";
		echo $miClase -> retornarJSon();
		$miClase -> guardarAlumno();
}
?>