<?php
include_once "./Clases/miClase.php";

foreach(miClase::leerArchivo("./Archivos/datos.txt") as $value)
{
    $nombre = $value["nombre"];
    $edad = $value["edad"];
    $foto = $value["foto"];
    $id = $value["id"];

    echo "ID: $id -- Nombre: $nombre -- Edad: $edad -- Foto: $foto <br>";
}
?>