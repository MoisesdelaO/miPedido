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
		if ($result = $conn->query("SELECT * FROM tienda WHERE status <> 9")) {
		  while ($row = $result->fetch_assoc()) {
		  	array_push($datos, $row);
	  	}
    }
		$res['tiendas'] = $datos;
	}





	if ($action == 'list') {

		if (isset($_POST['id_tienda'])) {
		   $id_tienda = $_POST['id_tienda'];  }

			$datos = array();

	if ($result = $conn->query("SELECT  a.id_categoria, a.nombre_categoria
	FROM tienda_articulo_categoria ga join tienda_categoria a on (a.id_categoria = ga.id_categoria)
	WHERE ga.id_tienda = '$id_tienda'" )) {
	  while ($row = $result->fetch_assoc()) {
		  array_push($datos, $row);
	  }
}
	$res['integrantes'] = $datos;
}

	if ($action == 'disponibles') {

		if (isset($_POST['id_tienda'])) {
		   $id_tienda = $_POST['id_tienda'];  }

			$datos = array();

	if ($result = $conn->query("SELECT  ga.id_categoria, ga.nombre_categoria
	FROM tienda_categoria ga 
	LEFT JOIN tienda t on (t.id_tienda = ga.id_tienda and t.id_tienda = '$id_tienda')
	WHERE ga.id_tienda is not null and ga.status <> 9" )) {
	  while ($row = $result->fetch_assoc()) {
		  array_push($datos, $row);
	  }
}
	$res['categorias'] = $datos;
}


if ($action == 'categorias') {

	if (isset($_POST['id_tienda'])) {
	   $id_tienda = $_POST['id_tienda'];  }

		$datos = array();

if ($result = $conn->query("SELECT  ga.id_categoria, ga.nombre_categoria
FROM tienda_categoria ga 
LEFT JOIN tienda t on (t.id_tienda = ga.id_tienda and t.id_tienda = '$id_tienda')
WHERE ga.id_tienda is null and ga.status <> 9" )) {
  while ($row = $result->fetch_assoc()) {
	  array_push($datos, $row);
  }
}
$res['categorias'] = $datos;
}




if ($action == 'add') {

	$id_tienda     = $_POST['id_tienda']; //$_POST['folio'];
	$id_categoria     = $_POST['id_categoria'];


	$result = $conn->query("INSERT INTO tienda_articulo_categoria (`id_tienda`,`id_cateogira`) VALUES ('$id_tienda','$id_categoria')");

	if ($result) {

		$res['message'] = "Categorias agregadas correctamente.";
	} else {
		$res['error']   = true;
		$res['message'] = "Fallo al agregar categorias a la tienda.".mysqli_error($conn);
	}
}

	if ($action == 'del') {

		$id_tienda     = $_POST['id_tienda']; //$_POST['folio'];
		$id_categoria     = $_POST['id_categoria'];


	$result = $conn->query("DELETE FROM tienda_articulo_categoria WHERE id_tienda = '$id_tienda' AND id_categoria = '$id_categoria'");

	if ($result) {

		$res['message'] = "Categoria eliminada correctamente.";
	} else {
		$res['error']   = true;
		$res['message'] = "Fallo al eliminar categoria de la tienda.".mysqli_error($conn);
	}
}

	// Insert data into database
	if ($action == 'create') {

		$id_tienda       		 = $_POST['id_tienda'];
		$nombre_comercial   	 = $_POST['nombre_comercial']; //$_POST['folio'];
		$razon_social   		 = $_POST['razon_social'];
		$rfc             		 = $_POST['rfc'];
		$status     			 = $_POST['status'];
		$envio_domicilio         = $_POST['envio_domicilio'];
		$recoge  			     = $_POST['recoge'];
		$pedido_min      	     = $_POST['pedido_min'];
		$costo_envio   	         = $_POST['costo_envio'];
		$logotipo    		     = $_POST['logotipo'];

		$result = $conn->query("INSERT INTO `tienda`(`nombre_comercial`, `razon_social`, `rfc`, `status`, `envio_domicilio`, `recoge`, `pedido_min`, `costo_envio`, `logotipo`)
								 VALUES ('$nombre_comercial', '$razon_social', '$rfc', '$status', '$envio_domicilio', '$recoge', '$pedido_min', '$costo_envio', '$logotipo')");

		if ($result) {
			$last_id = $conn->insert_id;
			$res['message'] = $last_id;
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la alta de la tienda.".mysqli_error($conn);
		}
	}

	// Update data
	if ($action == 'update') {

		$id_tienda       		 = $_POST['id_tienda'];
		$nombre_comercial   	 = $_POST['nombre_comercial'];
		$razon_social   		 = $_POST['razon_social'];
		$rfc             		 = $_POST['rfc'];
		$status     			 = $_POST['status'];
		$envio_domicilio         = $_POST['envio_domicilio'];
		$recoge  			     = $_POST['recoge'];
		$pedido_min      	     = $_POST['pedido_min'];
		$costo_envio   	         = $_POST['costo_envio'];
		$logotipo    		     = $_POST['logotipo'];


		$result = $conn->query("UPDATE `tienda` SET `nombre_comercial`='$nombre_comercial', `razon_social`='$razon_social',`rfc`='$rfc',
								`status`='$status',`envio_domicilio`='$envio_domicilio',`recoge`='$recoge',`pedido_min`='$pedido_min',`costo_envio`='$costo_envio',
								`logotipo`='$logotipo'  WHERE `id_tienda`='$id_tienda'");
	
		if ($result) {
			$res['message'] = "Tienda actualizada correctamente";
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la actualizacion de la tienda: ".mysqli_error($conn);
 		}
	}

	// Delete data
	if ($action == 'delete') {
		$id_tienda = $_POST['id_tienda'];

		$result = $conn->query("UPDATE tienda SET `status` = 9 WHERE `id_tienda`='$id_tienda'");

		if ($result) {
			$res['message'] = "Tienda dada de baja correctamente";
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la baja de la tienda. ".mysqli_error($conn);
		}
	}

	// Close database connection
	$conn->close();

	// print json encoded data
	echo json_encode($res);
	die();

?>