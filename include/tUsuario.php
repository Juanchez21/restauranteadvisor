<?php
class tUsuario {
	
    private $id_usuario = "";
    private $login = "";
    private $contrasena = "";
    private $nombre = "";
	private $perfil = "";
		
	// setters
	public function setId( $id ){ $this->id_usuario = $id; }
	public function setNombre( $nombre ){ $this->nombre = $nombre; }
	public function setLogin( $login ){ $this->login = $login; }
	public function setContrasena( $contrasena ){ $this->contrasena = $contrasena; }
	public function setPerfil( $perfil ){ $this->perfil = $perfil; }	
	
	// getters
	public function getId(){ return $this->id_usuario; }
	public function getNombre(){ return $this->nombre; }
	public function getLogin(){ return $this->login; }
	public function getContrasena(){ return $this->contrasena; }
	public function getPerfil(){ return $this->perfil; }	
}
?>
