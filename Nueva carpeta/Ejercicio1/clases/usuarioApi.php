<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';
require_once 'AutentificadorJWT.php';
class usuarioApi extends Usuario implements IApiUsable
{
    public function TraerUno($request, $response, $args) {
        $id=$args['id'];
       $elUsuario=Usuario::TraerUnUsuario($id);
        $newResponse = $response->withJson($elUsuario, 200);  
       return $newResponse;
   }
    public function TraerTodos($request, $response, $args) {
        $todosLosUsuarios=Usuario::TraerTodoLosUsuarios();
        $newResponse = $response->withJson($todosLosUsuarios, 200);  
        return $newResponse;
   }
     public function CargarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
		var_dump($ArrayDeParametros);
		$nombre= $ArrayDeParametros['nombre'];
		$password= $ArrayDeParametros['password'];
		
		$miUsuario = new Usuario();
		$miUsuario->nombre=$nombre;
		$miUsuario->password=$password;
		$miUsuario->InsertarElUsuarioParametros();
	
		return $response;
   }
     public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id=$ArrayDeParametros['id'];
        $Usuario= new Usuario();
        $Usuario->id=$id;
        $cantidadDeBorrados=$Usuario->BorrarUsuario();

        $objDelaRespuesta= new stdclass();
       $objDelaRespuesta->cantidad=$cantidadDeBorrados;
       if($cantidadDeBorrados>0)
           {
                $objDelaRespuesta->resultado="algo borro!!!";
           }
           else
           {
               $objDelaRespuesta->resultado="no Borro nada!!!";
           }
       $newResponse = $response->withJson($objDelaRespuesta, 200);  
         return $newResponse;
   }
    public function ModificarUno($request, $response, $args) {
        //$response->getBody()->write("<h1>Modificar  uno</h1>");
        $ArrayDeParametros = $request->getParsedBody();	

        $miUsuario = new Usuario();
        $miUsuario->id=$ArrayDeParametros['id'];
        $miUsuario->nombre=$ArrayDeParametros['nombre'];
        $miUsuario->password=$ArrayDeParametros['password'];

        $resultado =$miUsuario->ModificarUsuarioParametros();
        $objDelaRespuesta= new stdclass();

        $objDelaRespuesta->resultado=$resultado;
        return $response->withJson($objDelaRespuesta, 200);		
   }

   public function Login($request, $response, $args)
   {
        $ArrayDeParametros = $request->getParsedBody();
        $nombre = $ArrayDeParametros['nombre'];
        $password = $ArrayDeParametros['password'];

        $usuario = Usuario::LoginCompare($nombre, $password);
        if($usuario == false)
        {
            $response = "Datos incorrectos";
        }
        else
        {
            $array = array('id' => $usuario->id,'nombre' => $nombre);
            $response = AutentificadorJWT::CrearToken($array);
        }
        return $response;
   }
}

?>