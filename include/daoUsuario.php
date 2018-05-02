<?php

require_once("classBD.php");
require_once("tUsuario.php");

class DAOUsuario
{
	private $db;
	private $table = "usuarios";

	public function __construct()
	{
		$this->db = classBD::getSingleton();
	}
	
	public function insert(tUsuario $usuario, $perfil) {
		$sql = $this->db->conexionBD();
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?,?,?,?)";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssi", $usuario->getLogin(), $usuario->getContrasena(), $usuario->getNombre(), $perfil);

		if($stmt->execute())
			return true;
		else
			return false;
	}
	function getById($id) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT * FROM usuarios WHERE id_usuario = ".$id);
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$u = new tUsuario();
			$u->setId($fila['id_usuario']);
			$u->setNombre($fila['nombre']);
			$u->setContrasena($fila['contrasena']);
			$u->setLogin($fila['login']);
			$u->setPerfil($fila['perfil']);
			$rs->free();
			return $u;
		}
		return false;
	}

	function getUserByLogin($userLogin){
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT * FROM usuarios WHERE login = '".$userLogin."'");
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$u = new tUsuario();
			$u->setId($fila['id_usuario']);
			$u->setNombre($fila['nombre']);
			$u->setContrasena($fila['contrasena']);
			$u->setLogin($fila['login']);
			$u->setPerfil($fila['perfil']);
			$rs->free();
			return $u;
		}
		return false;
	}

	function getAll() {
		$conn = $this->db->conexionBD();
		$query = sprintf("SELECT * FROM " . $this->table);
		$query = $conn->query($query);
		$array_usuarios = array();
		
		if($query) {
			while($fila = $query->fetch_assoc()) {
				$u = new tUsuario();
				$u->setId($fila['id_usuario']);
				$u->setNombre($fila['nombre']);
				$u->setContrasena($fila['contrasena']);
				$u->setLogin($fila['login']);
				$u->setPerfil($fila['perfil']);
				array_push($array_usuarios,$u);
			}
			return $array_usuarios;
		}
		return false;
	}
	
	function update(tUsuario $usuario)
	{
		$id =$usuario->getId();
		$login =$usuario->getLogin();
		$contrasena =$usuario->getContrasena();
		$perfil =$usuario->getPerfil();
		$nombre = $usuario->getNombre();
		
		$sql = $this->db->conexionBD();
		$query = "UPDATE " . $this->table . " SET nombre=?, contrasena=?, login=?, perfil=? WHERE id_usuario=?";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssii", $nombre, $contrasena, $login, $perfil, $id);

		if($stmt->execute())
			return true;
		else
			return false;
	}

	function deleteById($id)
	{
		$conn = $this->db->conexionBD();
		$query=sprintf("DELETE FROM " . $this->table . " WHERE id_usuario = ".$id);
		$rs = $conn->query($query);
		if($rs)
			return true;
		return false;
	}

}
?>