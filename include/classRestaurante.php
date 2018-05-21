<?php
require_once("tRestaurante.php");
require_once("daoRestaurante.php");

class Restaurante{

	private $daoRestaurante;

	public function __construct(){
		$this->daoRestaurante = new DAORestaurante();
	}
	//restaurantes destacados
	public function getAllRestaurantesDestacados(){
		return $this->daoRestaurante->getRestauranteDestacados();
	}

	/*probarlo*/
	public function obtenerUnRestaurante($id)
	{
		$restaurante = new tRestaurante();
		return $this->daoRestaurante->getByIdRestaurante($id);
	}

	public function ordenPortada($orden, $id)
	{
		return $this->daoRestaurante->updateOrdenPortada($orden, $id);
	}
	
	public function obtenerTodosRestaurantes()
	{
		return $this->daoRestaurante->getAllRestaurantes();
	}

	public function actualizarRestaurante($restaurante)
	{
		return $this->daoRestaurante->updateRestaurante($restaurante);
	}

	public function borrarRestaurante($id)
	{
		return $this->daoRestaurante->deleteByIdRestaurante($id);
	}
	
	public function getRestaurantesByCategoria($id_categoria){
		return $this->daoRestaurante->getByCategoriaRestaurantes($id_categoria);
	}

	public function insertarRestaurante(tRestaurante $restaurante){
		return $this->daoRestaurante->insertRestaurante($restaurante);
		//ahora con el atributo categoria , se agrega a la tabla de restaurante-categoria
		
	}

	/*ver si el metodo insert de ambos DAOS sirven para algo o no? */

	/*ESTA FUNCION ES PARA IMPRIMIR SLOS RESTAURANTES -> VER SI SE USA O NO */
	public function mostrarRestaurantes($array_restaurantes){
		$i = 0;
		$num_total = count($array_restaurantes);
		while($i < $num_total){
			$nombre = $array_restaurantes[$i]->getNombre();
			$categoria = $array_restaurantes[$i]->getCategoria();
			$imagen = $array_restaurantes[$i]->getImagen();
			
			echo'<div class = "contenido">';
			echo'<div class = "contenido-restaurante">';
			echo'<img class = "imagen" src = "../';
			echo $imagen.'">';		
			echo'<div class = "info-restaurante">';
			echo'<div class = "nombre-restaurante">Nombre:"';
			echo $nombre.'"';
			echo '</div>';
			echo'<div class = "categoria-restaurante">Categoría:"'; 
			echo $categoria.'"'.'</div>';
			echo'</div>';
			echo'</div>';
			echo'<div class = "comentarios">';
			echo'<div class = "text-comentarios">';
			echo "Esto es un comentario";
			echo'</div>';
			echo'</div>';	
			echo'</div>';

			$i++;
		}
	}

	public function validaRestaurante($restaurante, $categoria1, $categoria2, $categoria3, $categoria4){
		$errores = array();

		if(empty($restaurante->getNombre()) || empty($restaurante->getApertura()) || empty($restaurante->getDireccion()) || empty($restaurante->getEditor()) || empty($restaurante->getPortada()) || empty($restaurante->getDescripcion()))
			$errores[0] = "No se han introducido todos los datos necesarios";

		
		if(empty($errores)) {
			$idRestaurante = $this->daoRestaurante->insertarRestaurante($restaurante); // insertamos el restaurante.
			if(!$idRestaurante)
				$errores[1] = "Se ha producido un error al crear el restaurante";
			else { // se ha creado bien el restaurante, le ponemos las categorias
				if ( empty($errores) && isset($categoria1) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria1) )
					$errores[2] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria1) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria2) )
					$errores[3] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria1) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria3) )
					$errores[4] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria1) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria4) )
					$errores[5] = "Se ha producido un error al ponerle la categoría al restaurante";
			}
		}
		
		return $errores;	
	}
}
?>