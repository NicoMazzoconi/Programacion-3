<?php
require_once "../src/app/models/usuario.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\usuario;

class usuarioApi implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {

    }
    public function TraerTodos($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        $todos = usuario::all();
        $objDelaRespuesta->respuesta=$todos;
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $password= $ArrayDeParametros['password'];
        $sexo= $ArrayDeParametros['sexo'];
        
        $miUser = new usuario();
        $miUser->nombre=$nombre;
        $miUser->password=$password;
        $miUser->sexo=$sexo;
        $miUser->perfil="usuario";
        $miUser->save();
        
        $objDelaRespuesta->respuesta="Se cargo correctamente";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {

    }
    public function Login($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $password= $ArrayDeParametros['password'];
        $sexo= $ArrayDeParametros['sexo'];

        $usuarioLogin = new usuario();
        $usuarioLogin = $usuarioLogin->where('nombre', $nombre)->first();

        if($usuarioLogin)
        {
            if($usuarioLogin->password == $password && $usuarioLogin->sexo == $sexo)
            {
                $id = $usuarioLogin->id;
                $datos = array(
                    'id'=>$id,
                    'nombre'=>$nombre,
                    'sexo'=>$sexo,
                    'perfil'=>$usuarioLogin->perfil
                );
                return AutentificadorJWT::CrearToken($datos);
            }
            else
            {
                return $response->withJson("Sexo o password incorrectas", 200);
            }
        }
        else
        {
            return $response->withJson("Nombre invalido", 200);
        }   
    }
}

?>