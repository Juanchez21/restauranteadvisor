<?php
require_once("tUsuario.php");
require_once("daoUsuario.php");

class Usuario{

	private $daoUsuario;

	public function __construct(){
		$this->daoUsuario = new DAOUsuario();
	}
	
	public function obtenerUsuario($id)
	{
		$usuario = new tUsuario();
		$usuario->setId($id);
		return $this->daoUsuario->getById($usuario);
	}

	public function obtenerTodos()
	{
		return $this->daoUsuario->getAll();
	}

	public function actualizarUsuario($usuario)
	{
		return $this->daoUsuario->update($usuario);
	}

	public function borrarUsuario($id)
	{
		return $this->daoUsuario->deleteById($id);
	}

	public function getUserByLogin($userLogin){
		return $this->daoUsuario->getUserByLogin($userLogin);
	}
	
	public function validaLogin($user){
		$errores = array();
		
		if(empty($user->getLogin()) || empty($user->getContrasena())){
			$errores[0] = "No se han introducido todos los datos necesarios";
		}
		
		if(empty($errores)){
			$usuario = $this->getUserByLogin($user->getLogin());
			if(!$usuario){
				$errores[1] = "El login usado no está registrado";
			} else {
				if(password_verify($user->getContrasena(), $usuario->getContrasena())){
				//if (strcmp($password, $usuario->getContrasena()) == 0){
					$_SESSION['sesion'] = true;
					$_SESSION['userID'] = $usuario->getId();
					$_SESSION['perfil'] = $usuario->getPerfil();
					$_SESSION['nombre'] = $usuario->getNombre();
					//$errorno = 0; // login correcto
				} else {
					$errores[2] = "La contraseña no es correcta";
				}
			}
		}
		return $errores;
	}
	
	public function validaRegistro($usuario, $password2){
		$errores = array();

		if(empty($usuario->getLogin()) || empty($usuario->getContrasena()) || empty($usuario->getNombre()) || empty($password2))
			$errores[0] = "No se han introducido todos los datos necesarios";

		if($this->daoUsuario->getUserByLogin($usuario->getLogin()))
			$errores[1] = "El nombre de usuario ya se encuentra en uso";

		if(strlen($usuario->getContrasena()) < 6)
			$errores[2] = "La contraseña debe contener al menos 6 caracteres";

		if ($usuario->getContrasena() != $password2)
			$errores[3] = "Las contraseñas no coinciden";
		
		if(empty($errores)) {
			$usuario->setContrasena(password_hash($usuario->getContrasena(), PASSWORD_DEFAULT)); // encriptamos la contraseña del usuario
			$idUsuario = $this->daoUsuario->insert($usuario, 1); // insertamos el usuario.
			if(!$idUsuario)
				$errores[4] = "Se ha producido un error al dar de alta al usuario";
		}
		
		//$result = array	('errors' => $errores,'data' => null);
		return $errores;	
	}
	
	public function cerrarSesion(){
		if(isset($_SESSION['sesion']))
			$_SESSION['login'] = false;

		if(isset($_SESSION['userID']))
			$_SESSION['userID'] = 0;

		session_destroy();
	}
}
?>