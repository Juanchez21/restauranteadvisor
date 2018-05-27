<?php
require_once("tRestaurante.php");
require_once("daoRestaurante.php");

class Restaurante{

	private $daoRestaurante;

	public function __construct(){
		$this->daoRestaurante = new DAORestaurante();
	}
	
	private function nombresCategorias($id_r){
		$categoriasString = "";
		$arrayCategorias = $this->categoriasRestaurante($id_r);
		if($arrayCategorias){
			foreach($arrayCategorias as $categoria){
				$nombre = $this->daoRestaurante->getNombreCategoriaById($categoria);
				if ($nombre)
					$categoriasString=$categoriasString.$nombre." ";
			}
		}
		return $categoriasString;
	}
	
	public function getAllRestaurantesDestacados(){
		$array= $this->daoRestaurante->getRestauranteDestacados();
		$i = 0;
		$num_total = count($array);
		while($i < $num_total) {
			$nombre = $array[$i]->getNombre();
			$imagen = $array[$i]->getImagen();
			$id = $array[$i]->getId();
			$nombresCategorias = $this->nombresCategorias($id);
			
			if($i+1 < $num_total) {
				$nombre1 = $array[$i+1]->getNombre();
				$imagen1 = $array[$i+1]->getImagen();
				$id1 = $array[$i+1]->getId();
				$nombresCategorias1 = $this->nombresCategorias($id1);
			}

			echo'<tr>';
			echo'	<th>Restaurante</th>';
			if($i+1 < $num_total){ 
				echo'	<th>Restaurante</th>';
			}
			echo'</tr>';
			echo'<tr>';
			echo'	<td>';
			echo'		<a href = "restaurante.php?id='. $id .'"><img class = "imagen" src = "'. $imagen.'" alt="'.$nombre.'"></a>';
			echo'		<div class = "info-restaurante">';
			echo'		<a href = "restaurante.php?id='. $id .'"><div class ="nombre-restaurante">Nombre:'. $nombre.'</div></a>';
			echo '<div class = "categoria-restaurante">Categoria: '. $nombresCategorias. '</div>';
			echo'		</div>';
			echo'	</td>';
			if($i+1 < $num_total){
				echo'	<td>';
				echo'		<a href = "restaurante.php?id='. $id1 .'"><img class = "imagen" src = "'.$imagen1.'" alt="'.$nombre.'"></a>';
				echo'		<div class = "info-restaurante">';
				echo'		<a href = "restaurante.php?id='. $id1 .'"><div class ="nombre-restaurante">Nombre:'. $nombre1.'</div></a>';
				echo '<div class = "categoria-restaurante">Categoria: '. $nombresCategorias1. '</div>';
				echo'		</div>';
				echo'	</td>';
			}
			echo'	</tr>';
			$i=$i+2;
		}
	}

	public function obtenerUnRestaurante($id)
	{
		$restaurante = new tRestaurante();
		return $this->daoRestaurante->getByIdRestaurante($id);
	}

	public function ordenPortada($orden, $id)
	{
		return $this->daoRestaurante->updateOrdenPortada($orden, $id);
	}
	
	public function actualizarPortada($id, $portada, $orden){
		return $this->daoRestaurante->actualizarPortada($id, $portada, $orden);
	}
	
	public function obtenerTodos() {
		return $this->daoRestaurante->getAllRestaurantes();
	}
	
	public function obtenerTodosRestaurantes()
	{
		$array = $this->daoRestaurante->getAllRestaurantes();
		$i = 0;
		$num_total = count($array);
		while($i < $num_total) {
			$nombre = $array[$i]->getNombre();
			$imagen = $array[$i]->getImagen();
			$id = $array[$i]->getId();
			$direccion = $array[$i]->getDireccion();

			$id_categoria = $this->daoRestaurante->getCategoriaByRestaurante($id);
			$categoria = $this->daoRestaurante->getNombreCategoriaById($id_categoria);

			echo'<tr>';
			echo'	<th>Restaurante</th>';
			echo'	<th>Informacion</th>';

			echo'</tr>';
			echo'<tr>';
			echo'	<td>';
			echo'		<a href = "restaurante.php?id='. $id .'"><img class = "imagen" src = "'. $imagen.'" alt="'.$nombre.'"></a>';
			echo'	</td>';
			
			echo'	<td>';
			echo'		<div class = "info-restaurante-t2">';
			echo'		<a href = "restaurante.php?id='. $id .'"><div class ="nombre-restaurante">Nombre:'. $nombre.'			</div></a>';
			echo '<div class = "categoria-restaurante">Categoria: '. $categoria. '</div>';
			echo '<div class = "direccion-restaurante">Direccion: '. $direccion. '</div>';
			echo'		</div>';
			echo'	</td>';
			
			echo'	</tr>';
			$i++;
		}
	}

	public function actualizarRestaurante($restaurante)
	{
		return $this->daoRestaurante->updateRestaurante($restaurante);
	}
	
	public function getRestaurantesByCategoria($id_categoria) {
		
		$array =  $this->daoRestaurante->getByCategoriaRestaurantes($id_categoria);
		if($array){
		$i = 0;
		$num_total = count($array);
		while($i < $num_total) {
			$nombre = $array[$i]->getNombre();
			$imagen = $array[$i]->getImagen();
			$id = $array[$i]->getId();
			$direccion = $array[$i]->getDireccion();

			// la foto y el nombre son links independientes
			
			echo'<tr>';
			echo'	<th>Restaurante</th>';
			echo'	<th>Informacion</th>';

			echo'</tr>';
			echo'<tr>';
			echo'	<td>';
			echo'		<a href = "restaurante.php?id='. $id .'"><img class = "imagen" src = "'. $imagen.'" alt="'.$nombre.'"></a>';
			echo'	</td>';
			
			echo'	<td>';
			echo'		<div class = "info-restaurante-t2">';
			echo'		<a href = "restaurante.php?id='. $id .'"><p class ="nombre-restaurante">Nombre:'. $nombre.'			</p></a>';
			echo '<div class = "direccion-restaurante">Direccion: '. $direccion. '</div>';
			echo'		</div>';
			echo'	</td>';
			
			echo'	</tr>';
			$i++;
		}
	}
	}

	public function insertarRestaurante(tRestaurante $restaurante){
		return $this->daoRestaurante->insertRestaurante($restaurante);
		//ahora con el atributo categoria , se agrega a la tabla de restaurante-categoria
		
	}

	public function mostrarRestaurante($restauranteClass, $id_restaurante){

		$restaurante = $restauranteClass->obtenerUnRestaurante($id_restaurante);
		$botonEditar = '<form method = "post" action = "editarRestaurante.php?id='.$id_restaurante.'">
		<input type="submit" value="Editar Restaurante"></form>';

		$id_restaurante = $restaurante->getId();
		$nombre = $restaurante->getNombre();
		$id_categoria = $this->daoRestaurante->getCategoriaByRestaurante($id_restaurante);
		$categoria = $this->nombresCategorias($id_restaurante);
		$imagen = $restaurante->getImagen();
		$tipo = $restaurante->getTipo();
		$precio = $restaurante->getPrecio();
		$apertura = $restaurante->getApertura();
		$direccion = $restaurante->getDireccion();
		$id_editor = $restaurante->getEditor();
		$descripcion = $restaurante->getDescripcion();

		echo'<h1> Restaurante: '. $nombre . ' </h1>';
		echo'<div class = "contenido">';
		echo'<div class = "restaurante">';
		echo'<img class = "imagen-restaurante" src = "'.$imagen.'" alt="'.$nombre.'">';
		echo'<div class = "detalle-restaurante">';
		echo'<p class = "">Nombre:'.$nombre.'</p>';
		echo'<p class = "">Categoria:'.$categoria.'</p>';
		echo'<p class = "">Apertura:'.$apertura.'</p>';
		echo'<p class = "">Direccion:'.$direccion.'</p>';
		echo'<p class = "">Tipo:'.$tipo.'</p>';
		echo'<p class = "">Precio Medio:'.$precio.'</p>';
		echo'<p class = "">Descripcion:'.$descripcion.'</p>';
		echo'</div>';

		// si existe $_SESSION['userId'] y es igual al editor del restaurante
		// no queda otra que el usuario logueado sea editor
		if(isset($_SESSION['userID']) && $_SESSION['userID'] == $id_editor){
		//if(esEditor() && ($_SESSION['userID'] == $id_editor)){
			echo $botonEditar;
		}

		/*Comentarios de este restaurante*/

		$comentarios_array = $restauranteClass->getComentariosByRestaurante($id_restaurante);
		if($comentarios_array){
			echo'<div class = "comentarios">';
			echo'<h3> Comentarios sobre "'.$nombre.'"'.': </h3>';
			$editor = $restauranteClass->getNombreEditorRestaurante($id_restaurante);
			$i = '0';
			$num_total = count($comentarios_array);
			while($i < $num_total){
				echo'<div class = "text-comentarios">';
				echo $editor . ': ' . $comentarios_array[$i];
				echo'</div>';
				$i++;
			} 
		}
		echo'</div>	';
		echo'</div>';
		echo'</div>';
	}

	public function getNombreEditorRestaurante($id_restaurante){
		return $this->daoRestaurante->getNombreEditorRestaurante($id_restaurante);
	}

	public function getComentariosByRestaurante($id_restaurante){
		return $this->daoRestaurante->getComentariosByIdRestaurantes($id_restaurante);
	}

	public function validaRestaurante($restaurante, $categoria1, $categoria2, $categoria3, $categoria4){
		$errores = array();

		if(empty($restaurante->getNombre()) || empty($restaurante->getApertura()) || empty($restaurante->getDireccion()) || empty($restaurante->getEditor()) || empty($restaurante->getPortada()) || empty($restaurante->getDescripcion()) || empty($restaurante->getImagen()) || empty($restaurante->getTipo()) || empty($restaurante->getPrecio()) )
			$errores[0] = "No se han introducido todos los datos necesarios";
		
		if ( !isset($categoria1) || !isset($categoria2) || !isset($categoria3) || !isset($categoria4) )
			$errores[0] = "No se han introducido todos los datos necesarios";
		
		if(empty($errores)) {
			$idRestaurante = $this->daoRestaurante->insertarRestaurante($restaurante); // insertamos el restaurante.
			if(!$idRestaurante)
				$errores[1] = "Se ha producido un error al crear el restaurante";
			else { // se ha creado bien el restaurante, le ponemos las categorias
				if ( empty($errores) && isset($categoria1) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria1) )
					$errores[2] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria2) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria2) )
					$errores[3] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria3) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria3) )
					$errores[4] = "Se ha producido un error al ponerle la categoría al restaurante";
				
				if ( empty($errores) && isset($categoria4) && !$this->daoRestaurante->instertCategoriaRestaurante($idRestaurante, $categoria4) )
					$errores[5] = "Se ha producido un error al ponerle la categoría al restaurante";
			}
		}
		
		return $errores;	
	}
	
	public function categoriasRestaurante($id){
		return $this->daoRestaurante->getCategoriaByIdRestaurante($id);
	}
	
	public function actualizarCategorias($id_r, $categoria1, $categoria2, $categoria3, $categoria4){
		$this->daoRestaurante->deleteCategoriasRestaurante($id_r);
		
		if (strcmp($categoria1, "") !== 0)
			$this->daoRestaurante->instertCategoriaRestaurante($id_r, $categoria1);
		if (strcmp($categoria2, "") !== 0)
			$this->daoRestaurante->instertCategoriaRestaurante($id_r, $categoria2);
		if (strcmp($categoria3, "") !== 0)
			$this->daoRestaurante->instertCategoriaRestaurante($id_r, $categoria3);
		if (strcmp($categoria4, "") !== 0)
			$this->daoRestaurante->instertCategoriaRestaurante($id_r, $categoria4);
	}
}
?>