<?php

require './vendor/autoload.php';

use \App\Models\Usuario as UsuarioORM;
use \App\Models\Mesa as MesaORM;
use \App\Models\Pedido as PedidoORM;

require_once './app/models/Pedido.php';
require_once './app/models/Usuario.php';
require_once './app/models/Mesa.php';

require_once './clases/UsuarioApi.php';
require_once './clases/PedidoApi.php';
require_once './clases/MesaApi.php';
require_once './clases/AutentificadorJWT.php';
require_once './clases/MWparaCORS.php';
require_once './clases/MWparaAutentificar.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']= [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'comanda',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_spanish2_ci',
            'prefix'    => '',
        ];

$app = new \Slim\App(["settings" => $config]);

$container = $app->getContainer();
$dbSettings = $container->get('settings')['db'];

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection($dbSettings);
$capsule->bootEloquent();
$capsule->setAsGlobal();

/*$app->group('/orm', function(){
    $this->get('/', \MesaApi::class . ':TraerUno');
});*/

$app->get('/', function(){
    echo "hola";
});

?>