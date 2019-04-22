<?php
include_once "./Clases/persona.php";
include_once "./Clases/alumnoDAO.php";
class Alumno extends Persona
{
	public $legajo;
	public $imagen;

	/*public function __construct($nombre = NULL, $edad = NULL, $dni = NULL, $legajo = NULL, $imagen = NULL)
	{
		parent::__construct($dni, $nombre, $edad);
		$this -> legajo = $legajo;
		$this -> imagen = $imagen;
	}*/

	public function SimilConstruct($nombre = NULL, $edad = NULL, $dni = NULL, $legajo = NULL, $imagen = NULL)
	{
		parent::__construct($dni, $nombre, $edad);
		$this -> legajo = $legajo;
		$this -> imagen = $imagen;
	}

	public function retornarJSon()
	{
		return json_encode($this);
	}

	public function guardarAlumno()
	{
		$fichero = "./Archivos/alumnos.txt";
		$actual = $this -> retornarJSon();
		if(file_exists($fichero))
		{
			file_put_contents($fichero, $actual.="\r\n", FILE_APPEND);
		}
		else
		{
			file_put_contents($fichero, $actual.="\r\n");
		}
		/* debe recibir alumno
		if(file_exists($archivo))
		{
			$archivo = fopen("./Archivos/alumnos.txt", "a");//escribe y mantiene la informacion existente		 
		}else
		{
			$archivo = fopen("./Archivos/alumnos.txt", "w");//escribe y mantiene la informacion existente		 
		}
		
		$renglon = $alumno => retornarJSon().="\r\n";
		fwrite($archivo, $renglon); 		 
		fclose($archivo);
		*/
	}

	public static function guardarAlumnosArray($array)
	{
		$archivo=fopen("./Archivos/alumnos.txt", "w"); 	
		foreach ($listado as $value) 
		{
	 		$dato=$value -> retornarJSon();
	 		$dato.="\r\n";
			fwrite($archivo, $dato);
		}
		fclose($archivo);
	}

	public static function leerAlumno()
	{
		$fichero = "./Archivos/alumnos.txt";
		if(file_exists($fichero))
		{
			$gestor = @fopen($fichero, "r");
			$arrayAlumnos = array();
			$i = 0;
			while (($bufer = fgets($gestor, 4096)) !== false)
        	{
        		$arrayAlumnos[$i] = json_decode($bufer, true);
        		$i++;
           	}
           	
           	if (!feof($gestor)) 
    		{
       	 		echo "Error: fallo inesperado de fgets()\n";
    		}			
    		fclose($gestor);
    		return $arrayAlumnos;
		}   	
	}

	public static function buscarAlumnoLegajo($legajo)
	{
		$array = Alumno::leerAlumno();
		foreach ($array as $value) {
			if($value["legajo"] == $legajo)
				return $value->retornarJSon();
		}
		return false;
	}

	public static function modificarAlumnoPorLegajo($arrayAlumno, $JSonAlumno)
	{
		$alumno = json_decode($JSonAlumno);
		$legajo = $alumno -> legajo;
		$datoViejo = Alumno::buscarAlumnoLegajo($legajo);
		if($datoViejo != false)
		{
			$datoViejo = $JSonAlumno;
			unset($arrayAlumno[$alumno]);
		}
		else
		{
			echo "No encontrado";
		}
	}

	//funcion para consultas SQL------------------------------------------------------------------------------
	public static function TraerAlumnos()
	{
		$objetoAccesoDato = AlumnoDAO::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select `nombre`, `edad`, `dni`, `legajo`, `id` from alumnos");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");	
	}
	public function InsertarAlumno()
	{
			$objetoAccesoDato = AlumnoDAO::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumnos (nombre,edad,dni, legajo)values('$this->nombre','$this->edad','$this->dni','$this->legajo')");
			$consulta->execute();
			return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
	public function ModificarAlumno()
	{
		$objetoAccesoDato = AlumnoDAO::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
				update alumnos 
				set nombre='$this->nombre',
				edad='$this->edad',
				dni='$this->dni',
				legajo='$this->legajo'
				WHERE id='$this->id'");
				//como obtengo el id
		return $consulta->execute();
	}
	public static function BorrarAlumnoPorLegajo($legajo)
	{
		$objetoAccesoDato = AlumnoDAO::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from alumnos 				
				WHERE legajo=:legajo");	
		$consulta->bindValue(':legajo',$legajo, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

}
?>