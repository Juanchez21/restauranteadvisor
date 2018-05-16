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

	public function insertRestaurante(tRestaurante $restaurante) {
		$sql = $this->db->conexionBD();
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?,?,?,?,?,?,?,?)";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("ssssiiis", $restaurante->getNombre(), $restaurante->getApertura(), $restaurante->getDireccion(), $restaurante->getImagen(), $restaurante->getEditor(), $restaurante->getPortada(), $restaurante->getOrden(), $restaurante->getDescripcion() );

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

				//echo $rs->num_rows;

				$r = new tRestaurante();
				/*$r->setNombre($fila['nombre']);
				echo $r->getNombre() . '<br>';
				$r->setImagen($fila['imagen']);*/

				$r->setId($fila['id_restaurante']);

				$r->setNombre($fila['nombre']);

				$r->setApertura($fila['apertura']);

				$r->setDireccion($fila['direccion']);

				$r->setImagen($fila['imagen']);

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
		$editor = $restaurante->getEditor();
		$portada = $restaurante->getPortada();
		$orden_portada = $restaurante->getOrden();
		$descripcion = $restaurante->getDescripcion();
		
		$sql = $this->db->conexionBD();
		$query = "UPDATE " . $this->table . " SET nombre=?, apertura=?, direccion=?, imagen=?, editor=?, portada=?, orden_portada=?, descripcion=? WHERE id_restaurante=?";
		$stmt = $sql->prepare($query);
		$stmt->bind_param("ssssiiis", $nombre, $apertura, $direccion, $imagen, $editor, $portada, $orden_portada, $descripcion);

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
		$query=sprintf("SELECT * FROM restaurantes WHERE id_restaurante = ".$id);
		$rs = $conn->query($query);
		
		if ($rs && $rs->num_rows > 0 ) {
			$fila = $rs->fetch_assoc();
			
			$u = new tRestaurante();
			$u->setId($fila['id_restaurante']);
			$u->setNombre($fila['nombre']);
			$u->setApertura($fila['apertura']);
			$u->setDireccion($fila['direccion']);
			$u->setImagen($fila['imagen']);
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