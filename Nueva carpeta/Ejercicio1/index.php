<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../composer/vendor/autoload.php';
require_once '/clases/AccesoDatos.php';
require_once '/clases/usuario.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*

¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


/* atender todos los verbos de HTTP*/
$app->any('/cualquiera/[{id}]', function ($request, $response, $args) {
    
    var_dump($request->getMethod());
    $id=$args['id'];
    $response->getBody()->write("cualquier verbo de ajax parametro: $id ");
    return $response;
});



/* atender algunos los verbos de HTTP*/
$app->map(['GET', 'POST'], '/mapeado', function ($request, $response, $args) {

      var_dump($request->getMethod());
     $response->getBody()->write("Solo POST y GET");
});


/* agrupacion de ruta*/
$app->group('/saludo', function () {

    $this->get('/{nombre}', function ($request, $response, $args) {
        $nombre=$args['nombre'];
        $response->getBody()->write("HOLA, Bienvenido <h1>$nombre</h1> a la apirest de 'CDs'");
    });

     $this->get('/', function ($request, $response, $args) {
        $response->getBody()->write("HOLA, Bienvenido a la apirest de 'CDs'... ingresá tu nombre");
    });
 
     $this->post('/', function ($request, $response, $args) {      
        $response->getBody()->write("HOLA, Bienvenido a la apirest por post");
    });
     
});


/* agrupacion de ruta y mapeado*/
$app->group('/usuario/{id:[0-9]+}', function () {

    $this->map(['POST', 'DELETE'], '', function ($request, $response, $args) {
        $response->getBody()->write("Borro el usuario por p");
    });

    $this->get('/nombre', function ($request, $response, $args) {
        $response->getBody()->write("Retorno el nombre del usuario del id ");
    });
});




/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/usuario', function () {   

$this->get('/', \Usuario::class . ':traerTodos');
$this->get('/{id}', \Usuario::class . ':traerUno');
$this->delete('/', \Usuario::class . ':BorrarUno');
$this->put('/', \Usuario::class . ':ModificarUno');
//se puede tener funciones definidas
/*SUBIDA DE ARCHIVO*/
$this->post('/', function (Request $request, Response $response) {
  
    
    $ArrayDeParametros = $request->getParsedBody();
    //var_dump($ArrayDeParametros);
    $nombre= $ArrayDeParametros['nombre'];
    $password= $ArrayDeParametros['password'];
    
    $miUsuario = new Usuario();
    $miUsuario->nombre=$nombre;
    $miUsuario->password=$password;
    $miUsuario->InsertarElUsuarioParametros();

    return $response;

});  
});

$app->post('/login/', function(Request $request, Response $response){

    $ArrayDeParametros = $request->getParsedBody();
    $nombre = $ArrayDeParametros['nombre'];
    $password = $ArrayDeParametros['password'];

    $usuario = Usuario::Login($nombre, $password);
    if($usuario == false)
    {
        echo "$usuarios";
    }
    else
    {
        echo true;
    }
});





$app->run();