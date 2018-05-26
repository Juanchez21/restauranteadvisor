<?php

class tRestaurante {

	

    private $id_restaurante = "";

    private $apertura = "";

    private $nombre = "";

	private $direccion = "";

	private $imagen = "";

	private $tipo = "";

	private $precio = "";

	private $editor = "";
	
	private $portada = "";
	private $orden_portada = "";
	private $descripcion = "";

		

	// setters

	public function setId( $id ){ $this->id_restaurante = $id; }

	public function setNombre( $nombre ){ $this->nombre = $nombre; }

	public function setApertura( $apertura ){ $this->apertura = $apertura; }

	public function setDireccion( $direccion ){ $this->direccion = $direccion; }

	public function setImagen( $imagen ){ $this->imagen = $imagen; }

	public function setTipo( $tipo ){ $this->tipo = $tipo; }

	public function setPrecio( $precio ){ $this->precio = $precio; }

	public function setEditor( $editor ){ $this->editor = $editor; }	
	
	public function setPortada( $portada ){ $this->portada = $portada; }
	public function setOrden( $orden_portada ){ $this->orden_portada = $orden_portada; }
	public function setDescripcion( $descripcion ){ $this->descripcion = $descripcion; }

	

	// getters

	public function getId(){ return $this->id_restaurante; }

	public function getNombre(){ return $this->nombre; }

	public function getApertura(){ return $this->apertura; }

	public function getDireccion(){ return $this->direccion; }	

	public function getImagen(){ return $this->imagen; }

	public function getTipo(){ return $this->tipo; }

	public function getPrecio(){ return $this->precio; }	

	public function getEditor(){ return $this->editor; }	
	
	public function getPortada(){ return $this->portada; }
	public function getOrden(){ return $this->orden_portada; }
	public function getDescripcion(){ return $this->descripcion; }
}
?>