
        <?php

	// Content Type JSON
	header("Content-type: application/json");

	// Database connection
	include("../config/db.php");

	if ($conn->connect_error) {
		die("Database connection failed!");
	}
	$res = array('error' => false);

  $action = 'read';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}

	if ($action == 'read') {

    $datos = array();
		if ($result = $conn->query("SELECT * FROM tienda_categoria WHERE status <> 9")) {
		  while ($row = $result->fetch_assoc()) {
		  	array_push($datos, $row);
	  	}
    }
		$res['categorias'] = $datos;
	}





	if ($action == 'list') {

		if (isset($_POST['id_categoria'])) {
		   $id_categoria = $_POST['id_categoria'];  }

			$datos = array();

	if ($result = $conn->query("SELECT  a.id_articulo, a.nombre_articulo
	FROM tienda_articulo_categoria ga join tienda_articulo a on (a.id_articulo = ga.id_articulo)
	WHERE ga.id_categoria = '$id_categoria'" )) {
	  while ($row = $result->fetch_assoc()) {
		  array_push($datos, $row);
	  }
}
	$res['integrantes'] = $datos;
}

	if ($action == 'disponibles') {

		if (isset($_POST['id_categoria'])) {
		   $id_categoria = $_POST['id_categoria'];  }

			$datos = array();

	if ($result = $conn->query("SELECT  a.id_articulo, a.nombre_articulo
		FROM tienda_articulos a LEFT JOIN tienda_articulo_categoria ga on (a.id_articulo = ga.id_articulo and ga.id_categoria = '$id_categoria')
		WHERE ga.id_categoria is null and a.status <> 9" )) {
	  while ($row = $result->fetch_assoc()) {
		  array_push($datos, $row);
	  }
}
	$res['articulos'] = $datos;
}






if ($action == 'add') {

	$id_categoria    = $_POST['id_categoria']; //$_POST['folio'];
	$id_articulo     = $_POST['id_articulo'];


	$result = $conn->query("INSERT INTO tienda_articulo_categoria (`id_categoria`,`id_articulo`) VALUES ('$id_categoria','$id_articulo')");

	if ($result) {

		$res['message'] = "Articulos agregados correctamente.";
	} else {
		$res['error']   = true;
		$res['message'] = "Fallo al agregar articulos a la categoria.".mysqli_error($conn);
	}
}

	if ($action == 'del') {

		$id_categoria    = $_POST['id_categoria']; //$_POST['folio'];
		$id_articulo     = $_POST['id_articulo'];


	$result = $conn->query("DELETE FROM tienda_articulo_categoria WHERE id_categoria = '$id_categoria' AND id_articulo = '$id_articulo'");

	if ($result) {

		$res['message'] = "Articulo eliminado correctamente.";
	} else {
		$res['error']   = true;
		$res['message'] = "Fallo al eliminar articulo de la categoria.".mysqli_error($conn);
	}
}

	// Insert data into database
	if ($action == 'create') {

   
		
        $id_categoria    		 = $_POST['id_categoria'];
        $id_tienda       		 = $_POST['id_tienda'];
		$icono    				 = $_POST['icono'];
		$orden    				 = $_POST['orden'];
        $nombre_categoria 	     = $_POST['nombre_categoria'];
		$status     			 = $_POST['status'];

		$result = $conn->query("INSERT INTO tienda_categoria (`nombre_categoria`, `icono`, `orden`, `status`) VALUES ('$nombre_categoria','$icono','$orden','$status')");

		if ($result) {
			$last_id = $conn->insert_id;
			$res['message'] = $last_id;
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la alta del artículo.".mysqli_error($conn);
		}
	}

	// Update data
	if ($action == 'update') {

		$id_categoria    		 = $_POST['id_categoria'];
        $id_tienda       		 = $_POST['id_tienda'];
		$icono    				 = $_POST['icono'];
		$orden    				 = $_POST['orden'];
        $nombre_categoria 	     = $_POST['nombre_categoria'];        
		$status     			 = $_POST['status'];



		$result = $conn->query("UPDATE tienda_categoria SET `nombre_categoria`='$nombre_categoria',`icono`='$icono',`status`='$status',`orden`='$orden' WHERE `id_categoria` = '$id_categoria'");
	
		if ($result) {
			$res['message'] = "Articulo actualizado correctamente.";
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la actualización del artículo.".mysqli_error($conn);
 		}
	}

	// Delete data
	if ($action == 'delete') {
        $id_categoria    		 = $_POST['id_categoria'];
		
		$result = $conn->query("UPDATE tienda_categoria SET `status` = 9 WHERE `id_categoria`='$id_categoria'");

		if ($result) {
			$res['message'] = "Artículo dado de baja correctamente";
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la baja del artículo. ".mysqli_error($conn);
		}
	}

	// Close database connection
	$conn->close();

	// print json encoded data
	echo json_encode($res);
	die();

?>