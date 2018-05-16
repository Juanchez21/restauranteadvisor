<?php

class tRestaurante {

	

    private $id_restaurante = "";

    private $categoria = "";

    private $apertura = "";

    private $nombre = "";

	private $direccion = "";

	private $imagen = "";

	private $editor = "";

		

	// setters

	public function setId( $id ){ $this->id_restaurante = $id; }

	public function setNombre( $nombre ){ $this->nombre = $nombre; }

	public function setCategoria( $categoria ){ $this->categoria = $categoria; }

	public function setApertura( $apertura ){ $this->apertura = $apertura; }

	public function setDireccion( $direccion ){ $this->direccion = $direccion; }

	public function setImagen( $imagen ){ $this->imagen = $imagen; }

	public function setEditor( $editor ){ $this->editor = $editor; }	

	

	// getters

	public function getId(){ return $this->id_restaurante; }

	public function getNombre(){ return $this->nombre; }

	public function getCategoria(){ return $this->categoria; }

	public function getApertura(){ return $this->apertura; }

	public function getDireccion(){ return $this->direccion; }	

	public function getImagen(){ return $this->imagen; }	

	public function getEditor(){ return $this->editor; }	

}

?>

