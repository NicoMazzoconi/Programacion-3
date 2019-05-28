<?php
class Usuario
{
	public $id;
	public $nombre;
	public $password;

  	public function BorrarUsuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public function ModificarUsuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set nombre='$this->nombre',
				password='$this->password',
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElUsuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,password)values('$this->nombre','$this->password')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set nombre=:nombre,
				password=:password
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,password)values(:nombre,:password)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarUsuario()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarUsuarioParametros();
	 		}else {
	 			$this->InsertarElUsuarioParametros();
	 		}

	 }


  	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,password from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}

	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, password from usuarios where id = $id");
			$consulta->execute();
			$UsuarioBuscado= $consulta->fetchObject('Usuario');
			return $UsuarioBuscado;				

			
	}

	public static function LoginCompare($nombre, $password)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, password from usuarios where nombre = ? and password = ?");
		$consulta->execute(array($nombre, $password));
		$UsuarioBuscado= $consulta->fetchObject('Usuario');
		return $UsuarioBuscado;	
	}


	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->password;
	}

}