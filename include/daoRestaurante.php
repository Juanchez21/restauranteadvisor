<?php



require_once("classBD.php");

require_once("tRestaurante.php");



class DAORestaurante

{

	private $db;

	private $table = "restaurantes";



	public function __construct()

	{

		$this->db = classBD::getSingleton();

	}

	public function insertRestaurante(tRestaurante $restaurante) {
		$sql = $this->db->conexionBD();
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?,?,?,?)";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssi", $restaurante->getCategoria(), $restaurante->getNombre(), $restaurante->getApertura(), $restaurante->getDireccion(), $restaurante->getImagen(),$restaurante->getEditor());

		if($stmt->execute())
			return true;
		else
			return false;
	}

	function getByCategoriaRestaurantes($id_categoria) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT * FROM restaurantes WHERE categoria = ".$id_categoria);
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$i = '0';
			$arr = array();
			$num = $rs->num_rows;
			while($i < $num){
				$fila = $rs->fetch_assoc();

			//echo $rs->num_rows;

				$r = new tRestaurante();
			/*$r->setNombre($fila['nombre']);
			echo $r->getNombre() . '<br>';
			$r->setImagen($fila['imagen']);*/

			$r->setId($fila['id_restaurante']);

			$r->setNombre($fila['nombre']);

			$r->setCategoria($fila['categoria']);

			$r->setApertura($fila['apertura']);

			$r->setDireccion($fila['direccion']);

			$r->setImagen($fila['imagen']);

			$r->setEditor($fila['editor']);

			array_push($arr,$r);
			
			$i++;
		}
		return $arr;
	}


	return false;
}

function getAllRestaurantes() {
		$conn = $this->db->conexionBD();
		$query = sprintf("SELECT * FROM " . $this->table);
		$query = $conn->query($query);
		$array_restaurantes = array();
		
		if($query) {
			while($fila = $query->fetch_assoc()) {
				$r = new tRestaurante();

			$r->setId($fila['id_restaurante']);

			$r->setNombre($fila['nombre']);

			$r->setCategoria($fila['categoria']);

			$r->setApertura($fila['apertura']);

			$r->setDireccion($fila['direccion']);

			$r->setImagen($fila['imagen']);

			$r->setEditor($fila['editor']);

			array_push($array_restaurantes,$r);
			}
			return $array_restaurantes;
		}
		return false;
	}

	function updateRestaurante(tRestaurante $restaurante)
	{
		$id =$restaurante->getId();
		$nombre =$restaurante->getNombre();
		$categoria =$restaurante->getCategoria();
		$apertura =$restaurante->getApertura();
		$direccion = $restaurante->getDireccion();
		$imagen = $restaurante->getImagen();
		$editor = $restaurante->getEditor();
		
		$sql = $this->db->conexionBD();
		$query = "UPDATE " . $this->table . " SET nombre=?, categoria=?, apertura=?, direccion=?, imagen=?, editor=? WHERE id_restaurante=?";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssii", $nombre, $categoria, $apertura, $direccion, $imagen, $editor, $id);

		if($stmt->execute())
			return true;
		else
			return false;
	}

	function deleteByIdRestaurante($id_restaurante)
	{
		$conn = $this->db->conexionBD();
		$query=sprintf("DELETE FROM " . $this->table . " WHERE id_restaurante = ".$id_restaurante);
		$rs = $conn->query($query);
		if($rs)
			return true;
		return false;
	}

	function getByIdRestaurante($id_restaurante) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT * FROM restaurantes WHERE id_restaurante = ".$id_restaurante);
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$r = new tRestaurante();

			$r->setId($fila['id_restaurante']);

			$r->setNombre($fila['nombre']);

			$r->setCategoria($fila['categoria']);

			$r->setApertura($fila['apertura']);

			$r->setDireccion($fila['direccion']);

			$r->setImagen($fila['imagen']);

			$r->setEditor($fila['editor']);

			$rs->free();
			return $r;
		}
		return false;
	}

//funciona
function getRestauranteDestacados(){	/*ver como hacer para SOLO DESTACADOS*/

	$conn = $this->db->conexionBD();

	$query=sprintf("SELECT * FROM restaurantes ");

	$rs = $conn->query($query);



	if ($rs && $rs->num_rows > 0 ) {
		$i = '0';
		$arr = array();
		$num = $rs->num_rows;
		while($i < $num){
			$fila = $rs->fetch_assoc();

			//echo $rs->num_rows;

			$r = new tRestaurante();
			/*$r->setNombre($fila['nombre']);
			echo $r->getNombre() . '<br>';
			$r->setImagen($fila['imagen']);*/

			$r->setId($fila['id_restaurante']);

			$r->setNombre($fila['nombre']);

			$r->setCategoria($fila['categoria']);

			$r->setApertura($fila['apertura']);

			$r->setDireccion($fila['direccion']);

			$r->setImagen($fila['imagen']);

			$r->setEditor($fila['editor']);

			array_push($arr,$r);

			

			
			$i++;
		}
		return $arr;

	}

	return false;

}


}

?>


<?php 
/*
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
	}*/
	?>	