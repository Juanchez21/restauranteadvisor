<?php
class classBD {
	private static $instancia;

	public static function getSingleton() {
		if (  !self::$instancia instanceof self) {
			self::$instancia = new self;
		}
		return self::$instancia;
	}

	private $bdDatosConexion;
	private $inicializada = false;
	private $conn;

	private function __construct() {}

	private function __clone(){
	    parent::__clone();
	}

	private function __wakeup()	{
	    return parent::__wakeup();
	}
	
	public function init($bdDatosConexion){
        if ( ! $this->inicializada ) {
    	    $this->bdDatosConexion = $bdDatosConexion;
    		$this->inicializada = true;
        }
	}
	
	public function shutdown(){
	    $this->compruebaInstanciaInicializada();
	    if ($this->conn !== null) {
	        $this->conn->close();
	    }
	}

	private function compruebaInstanciaInicializada(){
	    if (! $this->inicializada ) {
	        echo "Aplicacion no inicializa";
	        exit();
	    }
	}

	public function conexionBd(){
	    $this->compruebaInstanciaInicializada();
		if (! $this->conn ) {
			$bdHost = $this->bdDatosConexion['host'];
			$bdUser = $this->bdDatosConexion['user'];
			$bdPass = $this->bdDatosConexion['pass'];
			$bd = $this->bdDatosConexion['bd'];
			
			$this->conn = new \mysqli($bdHost, $bdUser, $bdPass, $bd);
			if ( $this->conn->connect_errno ) {
				echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
				exit();
			}
			if ( ! $this->conn->set_charset("utf8mb4")) {
				echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
				exit();
			}
		}
		return $this->conn;
	}
}
?>