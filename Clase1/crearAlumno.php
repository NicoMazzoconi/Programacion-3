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


echo "<br> <br>REQUEST<br>";
var_dump($_REQUEST);	

include_once "alumno.php";
if(isset($_GET["nombre"]) || isset($_GET["edad"]) || isset($_GET["dni"]) || isset($_GET["legajo"]))
{
	$miClase = new Alumno($_GET["nombre"], $_GET["edad"], $_GET["dni"], $_GET["legajo"]);
	echo "<br>";
	echo $miClase -> retornarJSon();
}
?>