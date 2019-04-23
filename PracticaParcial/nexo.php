<?php
    $tipo = $_SERVER['REQUEST_METHOD'];

    switch ($tipo) {
        case 'POST':
            if(isset($_POST["caso"]))
            {
                $caso = $_POST["caso"];

                switch($caso){
                    case 'cargarProveedor':
                        require_once "./Funciones/cargarProveedor.php";
                        break;

                    case 'hacerPedido':
                        require_once "./Funciones/hacerPedido.php";
                        break;
                    
                    case 'modificarProveedor':
                        require_once "./Funciones/modificarProveedor.php";
                        break;
                }
            }
            break;
        case 'GET':
            if(isset($_GET["caso"]))
            {
                $caso = $_GET["caso"];
                switch($caso){
                    case 'proveedores':
                        require_once "./Funciones/proveedores.php";
                        break;
                    
                    case 'consultarProveedor':
                        require_once "./Funciones/consultarProveedor.php";
                        break;

                    case 'listarPedidos':
                        require_once "./Funciones/listarPedidos.php";
                        break;

                    case 'listarPedidoProveedor':
                        require_once "./Funciones/listarPedidoProveedor.php";
                        break;

                    case 'fotosBack':
                        require_once "./Funciones/fotosBack.php";
                        break;
                }
            }
            break;
    }
?>