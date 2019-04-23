<?php
include_once "./Clases/pedidos.php";

foreach(Pedidos::leerArchivo() as $value)
        {
            $id = $value["id"];
            $idProveedor = $value["idProveedor"];
            $producto = $value["producto"];
            $cantidad = $value["cantidad"];

            echo "ID: $id -- ID Proveedor: $idProveedor -- Producto: $producto -- Cantidad: $cantidad <br>";
        }
?>