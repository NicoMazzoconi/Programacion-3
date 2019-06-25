<?php
require_once "../src/app/models/usuario.php";
require_once "../src/app/models/materia.php";
require_once "../src/IApiUsable.php";
require_once "../src/AutentificadorJWT.php";
use App\Models;
use App\Models\usuario;
use App\Models\materia;

class usuarioApi implements IApiUsable
{
    public function TraerUno($request, $response, $args)
    {

    }
    public function TraerTodos($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        $idUsuario = $response->getHeader('id')[0];
        $tokenUser = new usuario();
        $tokenUser = $tokenUser->where('id', $idUsuario)->first();

        if($tokenUser->tipo != "admin")
        {
            $objDelaRespuesta->respuesta = $tokenUser->materias;
            return $response->withJson($objDelaRespuesta, 200);
        }
    }
    public function CargarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $password= $ArrayDeParametros['password'];
        $tipo= $ArrayDeParametros['tipo'];

        if($tipo != "alumno" && $tipo != "profesor" && $tipo != "admin")
        {
            $objDelaRespuesta->respuesta="Error en el tipo";
            return $response->withJson($objDelaRespuesta, 200);
        }

        $miUser = new usuario();
        $miUser->nombre=$nombre;
        $miUser->password=$password;
        $miUser->tipo=$tipo;
        $miUser->save();
        
        $objDelaRespuesta->respuesta="Se cargo correctamente";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function BorrarUno($request, $response, $args)
    {

    }
    public function ModificarUno($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        $legajo = $args['legajo'];
        $ArrayDeParametros = $request->getParsedBody();
        $miUser = new usuario();
        $miUser = $miUser->where('id', $legajo)->first();
        $idUsuario = $response->getHeader('id')[0];

        $tokenUser = new usuario();
        $tokenUser = $tokenUser->where('id', $idUsuario)->first();

        if($idUsuario != $legajo)
        {
            if($tokenUser->tipo != "admin")
            {
                $objDelaRespuesta->respuesta="Solo puedes modificarte vos mismo";   
                return $response->withJson($objDelaRespuesta, 200);
            }
        }

        if(isset($ArrayDeParametros['email']))
        {
            $miUser->email = $ArrayDeParametros['email'];
        }

        if($miUser->tipo != "profesor")
        {
            $userapi = new usuarioApi();
            $miUser->foto = $userapi->guardarFoto($_FILES, $legajo);
        }
    
        if($miUser->tipo != "alumno")
        {
            if(isset($ArrayDeParametros['materias']))
            {
                $miUser->materias = $ArrayDeParametros['materias'];
            }
        }

        $miUser->save();
        $objDelaRespuesta->respuesta="Se cargo correctamente";   
        return $response->withJson($objDelaRespuesta, 200);
    }
    public function Login($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();

        $nombre= $ArrayDeParametros['nombre'];
        $legajo= $ArrayDeParametros['legajo'];

        $usuarioLogin = new usuario();
        $usuarioLogin = $usuarioLogin->where('id', $legajo)->first();

        if($usuarioLogin)
        {
            if($usuarioLogin->nombre == $nombre)
            {
                $datos = array(
                    'legajo'=>$legajo,
                    'nombre'=>$nombre,
                    'tipo'=>$usuarioLogin->tipo,
                );
                return AutentificadorJWT::CrearToken($datos);
            }
            else
            {
                return $response->withJson("Nombre incorrecto", 200);
            }
        }
        else
        {
            return $response->withJson("Legajo invalido", 200);
        }   
    }

    function guardarFoto($file, $legajo)
    {
        $dic = "./Foto/";
        $dicBackup = "./FotoBackUp/";
        $nameImagen = $file["foto"]["name"];
        
        $datoImagen = $legajo;
        
        $explode = explode(".", $nameImagen);
        $tamaño = count($explode);

        $dic .= $datoImagen;
        $dic .= ".";
        $dic .= $explode[$tamaño - 1];

        $hoy = date("m.d.y");
        $dicBackup .= "-".$hoy;
        $dicBackup .= ".";
        $dicBackup .= $explode[$tamaño - 1];

        if(!file_exists($dic))
        {
            move_uploaded_file($_FILES["foto"]["tmp_name"], $dic);	
        }
        else
        {
            copy($dic, $dicBackup);
            move_uploaded_file($_FILES["foto"]["tmp_name"], $dic);
        }
        return $dic;
    }

    public function Inscribirce($request, $response, $args)
    {
        $objDelaRespuesta= new stdclass();
        $idMateria = $args['id'];
        $materia = new materia();
        $materia = $materia->where('id', $idMateria)->first();
        
        $idUsuario = $response->getHeader('id')[0];
        $tokenUser = new usuario();
        $tokenUser = $tokenUser->where('id', $idUsuario)->first();

        if($materia->cupos > 0)
        {
            $mat = explode(' ',$tokenUser->materias);
            foreach($mat as $mate)
            {
                if($mate == $materia->nombre)
                {
                    $objDelaRespuesta->respuesta="ya pertenece a la materia";
                    return $response->withJson($objDelaRespuesta, 200);
                }
            }
            $materia->cupos = $materia->cupos -1;
            $tokenUser->materias = $tokenUser->materias . ' ' . $materia->nombre;
            $materia->save();
            $tokenUser->save();
            $objDelaRespuesta->respuesta="Inscripto";
        }
        else{
            $objDelaRespuesta->respuesta="cupo lleno";
        }

        return $response->withJson($objDelaRespuesta, 200);
    }
}

?>