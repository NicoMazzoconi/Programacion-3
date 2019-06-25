<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
require_once "../src/usuarioApi.php";
require_once "../src/materiaApi.php";
require_once "../src/MWparaAutentificar.php";

return function (App $app) {
    $container = $app->getContainer();
    
    $app->group('/usuario', function(){
        $this->post('/', \usuarioApi::class . ':CargarUno');
        $this->post('/{legajo}', \usuarioApi::class . ':ModificarUno')->add(\MWparaAutentificar::class . ':ValidarUsuario');
    });
    $app->group('/inscribirce', function(){
        $this->post('/{id}', \usuarioApi::class . ':Inscribirce')->add(\MWparaAutentificar::class . ':ValidarUsuario');
    });

    
    $app->post('/login', \usuarioApi::class . ':Login');

    $app->group('/materia', function(){
        $this->post('', \materiaApi::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarAdminMateria');
        $this->get('/', \usuarioApi::class . ':TraerTodos')->add(\MWparaAutentificar::class . ':ValidarUsuario');

    });
};  
