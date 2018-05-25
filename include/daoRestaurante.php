<?php
require_once("classBD.php");

require_once("tRestaurante.php");



class DAORestaurante {

	private $db;

	private $table = "restaurantes";



	public function __construct()
	{

		$this->db = classBD::getSingleton();

	}

	function updateOrdenPortada($orden, $id)
	{
		$sql = $this->db->conexionBD();
		$query = "UPDATE " . $this->table . " SET orden_portada=? WHERE id_restaurante=".$id;
		$stmt = $sql->prepare($query);
		$stmt->bind_param("i", $orden_portada);

		if($stmt->execute())
			return true;
		else
			return false;
	}

	public function insertarRestaurante(tRestaurante $restaurante) {
		$nombre = $restaurante->getNombre();
		$apertura = $restaurante->getApertura();
		$direccion = $restaurante->getDireccion();
		$imagen = $restaurante->getImagen();
		$tipo = $restaurante->getTipo();
		$precio = $restaurante->getPrecio();
		$editor = $restaurante->getEditor();
		$portada = $restaurante->getPortada();
		$orden = $restaurante->getOrden();
		$descr = $restaurante->getDescripcion();
		
		$sql = $this->db->conexionBD();
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssssiiiis", $nombre, $apertura, $direccion, $imagen, $tipo, $precio, $editor, $portada, $orden, $descr );

		if($stmt->execute()){
			return $stmt->insert_id;
		}
		else
			return false;
	}
	
	public function instertCategoriaRestaurante($idRestaurante, $categoria) {		
		$sql = $this->db->conexionBD();
		$query = "INSERT INTO categoria_restaurante VALUES (?, ?)";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("ii", $idRestaurante,  $categoria);

		if($stmt->execute())
			return true;
		else
			return false;
	}

	function getByCategoriaRestaurantes($id_categoria) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT * FROM categoria_restaurante cr, restaurantes r WHERE cr.categoria = ".$id_categoria." AND cr.restaurante = r.id_restaurante"); 
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$i = '0';
			$arr = array();
			$num = $rs->num_rows;
			while($i < $num){
				$fila = $rs->fetch_assoc();

				$r = new tRestaurante();

				$r->setId($fila['id_restaurante']);
				$r->setNombre($fila['nombre']);
				$r->setApertura($fila['apertura']);
				$r->setDireccion($fila['direccion']);
				$r->setImagen($fila['imagen']);
				$r->setTipo($fila['tipo']);
				$r->setPrecio($fila['precio']);
				$r->setEditor($fila['editor']);
				$r->setPortada($fila['portada']);
				$r->setOrden($fila['orden_portada']);
				$r->setDescripcion($fila['descripcion']);

				array_push($arr,$r);
				
				$i++;
			}
			return $arr;
		}

		return false;
	}
	
	function getNombreCategoriaById($id) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT nombre FROM categorias WHERE id_categoria = ".$id); 
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$u = $fila['nombre'];
			
			$rs->free();
			return $u;
		}
		return false;
	}

	function getCategoriaByIdRestaurante($id_restaurante) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT categoria FROM categoria_restaurante WHERE restaurante = ".$id_restaurante); 
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$i = '0';
			$arr = array();
			$num = $rs->num_rows;
			while($i < $num){
				$fila = $rs->fetch_assoc();
				
				$u = $fila['categoria'];

				array_push($arr,$u);
				
				$i++;
			}
			return $arr;
		}
		return false;
	}
	
	function deleteCategoriasRestaurante($id){
		$conn = $this->db->conexionBD();
		$query=sprintf("DELETE FROM categoria_restaurante WHERE restaurante = ".$id);
		$rs = $conn->query($query);
		if($rs)
			return true;
		return false;
	}
	
	function getNombreEditorRestaurante($id_restaurante) {
		$conn = $this->db->conexionBD();
		$query=sprintf("SELECT u.nombre FROM usuarios u, restaurantes r WHERE r.id_restaurante = ".$id_restaurante." AND r.editor = u.id_usuario"); 
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$u = $fila['nombre'];
			
			$rs->free();
			return $u;
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
				$u = new tRestaurante();
				$u->setId($fila['id_restaurante']);
				$u->setNombre($fila['nombre']);
				$u->setApertura($fila['apertura']);
				$u->setDireccion($fila['direccion']);
				$u->setImagen($fila['imagen']);
				$u->setTipo($fila['tipo']);
				$u->setPrecio($fila['precio']);
				$u->setEditor($fila['editor']);
				$u->setPortada($fila['portada']);
				$u->setOrden($fila['orden_portada']);
				$u->setDescripcion($fila['descripcion']);
				array_push($array_restaurantes,$u);
			}
			return $array_restaurantes;
		}
		return false;
	}

	function updateRestaurante(tRestaurante $restaurante)
	{
		$id =$restaurante->getId();
		$nombre = $restaurante->getNombre();
		$apertura = $restaurante->getApertura();
		$direccion = $restaurante->getDireccion();
		$imagen = $restaurante->getImagen();
		$tipo = $restaurante->getTipo();
		$precio = $restaurante->getPrecio();
		$editor = $restaurante->getEditor();
		$portada = $restaurante->getPortada();
		$orden_portada = $restaurante->getOrden();
		$descripcion = $restaurante->getDescripcion();
		
		$sql = $this->db->conexionBD();
		$query = "UPDATE " . $this->table . " SET nombre=? ,apertura=?, direccion=?, imagen=?, tipo=?, precio=?, editor=?, portada=?, orden_portada=?, descripcion=? WHERE id_restaurante=".$id;
		$stmt = $sql->prepare($query);
		$stmt->bind_param("sssssiiiis", $nombre, $apertura, $direccion, $imagen, $tipo, $precio, $editor, $portada, $orden_portada, $descripcion);

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
			
			$u = new tRestaurante();
			$u->setId($fila['id_restaurante']);
			$u->setNombre($fila['nombre']);
			$u->setApertura($fila['apertura']);
			$u->setDireccion($fila['direccion']);
			$u->setImagen($fila['imagen']);
			$u->setTipo($fila['tipo']);
			$u->setPrecio($fila['precio']);
			$u->setEditor($fila['editor']);
			$u->setPortada($fila['portada']);
			$u->setOrden($fila['orden_portada']);
			$u->setDescripcion($fila['descripcion']);
			
			$rs->free();
			return $u;
		}
		return false;
	}

//funciona
	function getRestauranteDestacados(){	/*ver como hacer para SOLO DESTACADOS*/

		$conn = $this->db->conexionBD();

		$query=sprintf("SELECT * FROM restaurantes WHERE portada = 1");

		$rs = $conn->query($query);

		if ($rs && $rs->num_rows > 0 ) {
			$i = '0';
			$arr = array();
			$num = $rs->num_rows;
			while($i < $num){
				$fila = $rs->fetch_assoc();
				
				$r = new tRestaurante();

				$r->setId($fila['id_restaurante']);
				$r->setNombre($fila['nombre']);
				$r->setApertura($fila['apertura']);
				$r->setDireccion($fila['direccion']);
				$r->setImagen($fila['imagen']);
				$r->setTipo($fila['tipo']);
				$r->setPrecio($fila['precio']);
				$r->setEditor($fila['editor']);

				array_push($arr,$r);

				$i++;
			}
			return $arr;
		}
		return false;
	}

	function getComentariosByIdRestaurantes($id_restaurante){
		$conn = $this->db->conexionBD();

		$query=sprintf("SELECT contenido FROM comentarios WHERE id_restaurante =".$id_restaurante);

		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$i = '0';
			$arr = array();
			$num = $rs->num_rows;
			while($i < $num){
				$fila = $rs->fetch_assoc();
				$r = $fila['contenido'];
				array_push($arr,$r);

				$i++;
			}
			return $arr;
		}
		return false;
	}
}	
?>