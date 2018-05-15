<?php
require_once("tRestaurante.php");
require_once("daoRestaurante.php");

class Restaurante{

	private $daoRestaurante;

	public function __construct(){
		$this->daoRestaurante = new DAORestaurante();
	}
	
	public function obtenerRestaurante($id) {
		$restaurante = new tRestaurante();
		return $this->daoRestaurante->getById($id);
	}

	public function obtenerTodos() {
		return $this->daoRestaurante->getAll();
	}

	public function actualizarRestaurante($restaurante) {
		return $this->daoRestaurante->update($restaurante);
	}

	public function borrarRestaurante($id) {
		return $this->daoRestaurante->deleteById($id);
	}
}
?>