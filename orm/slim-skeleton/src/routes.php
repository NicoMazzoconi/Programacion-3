<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
require_once "../src/usuarioApi.php";
require_once "../src/compraApi.php";
require_once "../src/MWparaAutentificar.php";

return function (App $app) {
    $container = $app->getContainer();
    $app->group('/usuario', function(){
        $this->post('/', \usuarioApi::class . ':CargarUno');
        $this->get('/', \usuarioApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':VerificarUsuarioTraer');
    });

    $app->post('/login', \usuarioApi::class . ':Login');

    $app->group('/Compra', function(){
        $this->post('', \compraApi::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarLogeadoCompra');
        $this->get('', \compraApi::class . ':TraerTodos');
    });
};  
