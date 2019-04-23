<?php
include_once "./Clases/pedidos.php";

$idProveedor = $_GET["idProveedor"];
$arrayPedidos = Pedidos::leerArchivo();
$aux = 0;
foreach($arrayPedidos as $value)
{
    if(strcasecmp($value["idProveedor"], $idProveedor) == 0)
    {
        $id = $value["id"];
        $producto = $value["producto"];
        $cantidad = $value["cantidad"];
        echo "ID: $id -- ID Proveedor: $idProveedor -- Producto: $producto -- Cantidad: $cantidad <br>";
        $aux++;
    }
}

if($aux == 0)
{
    echo "No se encontraron pedidos para ese proveedor";
}
?>