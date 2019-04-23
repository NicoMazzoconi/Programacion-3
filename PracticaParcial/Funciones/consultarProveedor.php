<?php
include_once "./Clases/proveedores.php";

$nombre = $_GET["nombre"];

$arrayProveedores = Proveedores::leerArchivo();
$aux = 0;
foreach($arrayProveedores as $value)
{
    if(strcasecmp($value["nombre"], $nombre) == 0)
    {
        $email = $value["email"];
        $foto = $value["foto"];
        $id = $value["id"];
        echo "ID: $id -- Nombre: $nombre -- Email: $email -- Foto: $foto <br>";
        $aux++;
    }
}

if($aux == 0)
{
    echo "No existe proveedor $nombre";
}
?>