<?php
/*$tipo = $_SERVER['REQUEST_METHOD'];

switch ($tipo) {
    case 'GET':
        require_once "./Funciones/mostrar.php";
        break;
    
    case 'POST':
        switch ($_POST["caso"])
        {
            case 'alta':
                require_once "./Funciones/alta.php";
                break;
            
            case 'borrar':
                require_once "./Funciones/borrar.php";
                break;

            case 'modificar':
                require_once "./Funciones/modificar.php";
                break;
        }
        break;
}*/

require_once "./Funciones/modificar.php";
?>