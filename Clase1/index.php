<?php
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
?>