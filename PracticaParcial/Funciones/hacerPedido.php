<?php
include_once "./Clases/pedidos.php";
include_once "./Clases/proveedores.php";

$arrayProveedores = Proveedores::leerArchivo();
$idProveedor = $_POST["idProveedor"];
$aux = 0;
foreach($arrayProveedores as $value)
{
    if(strcasecmp($value["id"], $idProveedor) == 0) 
    {
        $miClase = new Pedidos($_POST["id"], $idProveedor, $_POST["producto"], $_POST["cantidad"]);
        $miClase -> guardarArchivo();
        $aux++;
    }
}

if($aux == 0)
{
    echo "Provedor inexistente";
}

?>