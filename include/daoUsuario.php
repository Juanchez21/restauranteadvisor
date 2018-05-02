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
	/*function getById(tUsuario $usuario)
	{
		$pdo = $this->db->conexionBD();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $usuario->getId());
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$u = new tUsuario();
			$u->setId($fila['id']);
			$u->setNombre($fila['nombre']);
			$u->setContrasena($fila['contrasena']);
			$u->setLogin($fila['login']);
			$u->setPerfil($fila['perfil']);
			
			return $u;
		}
		return false;
	}*/

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
		$pdo = $this->db->conexionBD();
		$query = 
		"UPDATE " . 
		$this->table . " 
		SET 
		nombre=:nombre, contrasena=:contrasena, login=:login, perfil=:perfil
		WHERE
		id=:id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':nombre', $usuario->getNombre());
		$stmt->bindValue(':contrasena', $usuario->getContrasena());
		$stmt->bindValue(':login', $usuario->getLogin());
		$stmt->bindValue(':perfil', $usuario->getPerfil());
		$stmt->bindValue(':id', $usuario->getId());

		return $stmt->execute();

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