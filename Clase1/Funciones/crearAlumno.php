<?php
echo "GET<br>";
var_dump($_GET);

echo "<br> <br>POST<br>";
var_dump($_POST);
if (isset($_POST["apellido"])) 
{
	$apellido = $_POST["apellido"];
	echo " <br> $apellido";
}
if (isset($_POST["nombre"])) 
{
	$nombre = $_POST["nombre"];
	echo " <br> $nombre";
}
if (isset($_POST["edad"])) 
{
	$edad = $_POST["edad"];
	echo " <br> $edad";
}

if (isset($_POST["legajo"]))
{
	$legajo = $_POST["legajo"];
	echo " <br> $legajo";
}

echo "<br> <br>REQUEST<br>";
var_dump($_REQUEST);	

include_once "/../Clases/alumno.php";

if(isset($_GET["nombre"]) || isset($_GET["edad"]) || isset($_GET["apellido"]) || isset($_GET["legajo"]))
{
	$miClase = new Alumno($_GET["nombre"], $_GET["edad"], $_GET["apellido"], $_GET["legajo"]);
	echo "<br><br> JSon alumno creado<br>";
	echo $miClase -> retornarJSon();
	$miClase -> guardarAlumno();

	echo "<br><br> Datos leido del archivo guardado<br>";

	var_dump($miClase -> leerAlumno());
}
?>