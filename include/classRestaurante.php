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

	public function categoriaSeleccionada($id_categoria){
		/*creo que esto seria de una clase categoria*/
	}
}
?>