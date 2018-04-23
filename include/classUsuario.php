<?php
class Usuario{
	private $conexion;
	
	private $id_usuario;
	private $login;
	private $contrasena;
	private $nombre;
	private $perfil;
	
	public function __construct(){}
	
	public function getUserByLogin($userLogin, $conn){
		$query=sprintf("SELECT * FROM usuarios WHERE login = '".$userLogin."'");
		$rs = $conn->query($query);
		if ($rs) {
			if ( $rs->num_rows > 0 ) {
				$fila = $rs->fetch_assoc();
				$user = new Usuario();
				
				$user->setId($fila['id_usuario']);
				$user->setLogin($fila['login']);
				$user->setContrasena($fila['contrasena']);
				$user->setPerfil($fila['perfil']);
				$user->setNombre($fila['nombre']);
			
				$rs->free();
				return $user;
			}
			$rs->free();
			return false;
		}
		return false;
	}
	
	public function getUserById($userId){
		$query=sprintf("SELECT * FROM Usuarios U WHERE U.id_usuario = '".$userId."'");
		$rs = $conn->query($query);
		return $rs;
	}
	
	public function validaLogin($username, $password, $conn){
		$errorno = 4; // fallo en la base de datos
		
		if(empty($username) || empty($password)){
			$errorno=1; // usuario o contraseña vacios
		}
		
		if($errorno != 0){
			$usuario = $this->getUserByLogin($username, $conn);
			if(!$usuario){
				$errorno = 2; // login no valido
			} else {
				//if(password_verify($password, $usuario->getContrasena())){
				if (strcmp($password, $usuario->getContrasena()) == 0){
					$_SESSION['sesion'] = true;
					$_SESSION['userID'] = $usuario->getId();
					$_SESSION['perfil'] = $usuario->getPerfil();
					$_SESSION['nombre'] = $usuario->getNombre();
					$errorno = 0; // login correcto
				} else {
					$errorno = 2; // contraseña incorrecta
				}
			}
		}
		return $errorno;
	}
	
	public function cerrarSesion(){
		if(isset($_SESSION['sesion']))
			$_SESSION['login'] = false;

		if(isset($_SESSION['userID']))
			$_SESSION['userID'] = 0;

		session_destroy();
	}
	
	// getters y setters
	public function getId(){return $this->id_usuario;}
	public function getLogin(){return $this->login;}
	public function getContrasena(){return $this->contrasena;}
	public function getNombre(){return $this->nombre;}
	public function getPerfil(){return $this->perfil;}
	
	public function setId($id){$this->id_usuario = $id;}
	public function setLogin($login){$this->login = $login;}
	public function setContrasena($pass){$this->contrasena = $pass;}
	public function setNombre($name){$this->nombre = $name;}
	public function setPerfil($perf){$this->perfil = $perf;}
}
?>