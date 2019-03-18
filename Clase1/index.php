<?php
include "alumno.php";

$nombre = "Nicolas";
$edad = 24;
var_dump($nombre, $edad);

echo "<br><h1>Hola $nombre</h1><br>";
$array1 = [
$nombre => $edad
];
var_dump($array1);

echo "<br>";
$array2 = array();
$array2["nombre"] = $nombre;
$array2["edad"] = $edad;
var_dump($array2);

echo "<br>";
$miObj = new stdClass();
$miObj->nombre=$nombre;
$miObj->edad=$edad;
var_dump($miObj);

echo "<br>";
$miAlumno1 = new Alumno();
$miAlumno1 -> nombre = $nombre;
$miAlumno1 -> edad = $edad;
var_dump($miAlumno1);
echo "<br>";
echo $miAlumno1 -> retornarJSon();

echo "<br>";
$miAlumno2 = new Alumno($nombre, $edad);
var_dump($miAlumno2);
echo "<br>";
echo $miAlumno2 -> retornarJSon();

echo "<br>";
$miAlumno3 = new Alumno();
var_dump($miAlumno3);
echo "<br>";
echo $miAlumno3 -> retornarJSon();

?>