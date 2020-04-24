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
		if ($result = $conn->query("SELECT * FROM tienda_articulo WHERE status <> 9")) {
		  while ($row = $result->fetch_assoc()) {
		  	array_push($datos, $row);
	  	}
    }
		$res['articulos'] = $datos;
	}

	// Insert data into database
	if ($action == 'create') {

        $id_articulo       		 = $_POST['id_articulo'];
		$id_tienda       		 = $_POST['id_tienda'];
		$nombre_articulo 	     = $_POST['nombre_articulo']; //$_POST['folio'];
		$codigo   		         = $_POST['codigo'];
		$status     			 = $_POST['status'];
		$precio                  = $_POST['precio'];
		$costo  			     = $_POST['costo'];
		$existencia      	     = $_POST['existencia'];
		$cargo_extra_envio   	 = $_POST['cargo_extra_envio'];
		$foto_articulo    		 = $_POST['foto_articulo'];

		$result = $conn->query("INSERT INTO tienda_articulo (`nombre_articulo`, `codigo`, `status`, `precio`, `costo`, `existencia`, 
                                `cargo_extra_envio`, `foto_articulo`) VALUES ('$nombre_articulo','$codigo','$status','$precio','$costo','$existencia','$cargo_extra_envio',
                                '$foto_articulo')");

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

		$id_articulo       		 = $_POST['id_articulo'];
		$id_tienda       		 = $_POST['id_tienda'];
		$nombre_articulo 	     = $_POST['nombre_articulo']; //$_POST['folio'];
		$codigo   		         = $_POST['codigo'];
		$status     			 = $_POST['status'];
		$precio                  = $_POST['precio'];
		$costo  			     = $_POST['costo'];
		$existencia      	     = $_POST['existencia'];
		$cargo_extra_envio   	 = $_POST['cargo_extra_envio'];
		$foto_articulo    		 = $_POST['foto_articulo'];


		$result = $conn->query("UPDATE tienda_articulo SET `nombre_articulo`='$nombre_articulo',`codigo`='$codigo',`status`='$status',`precio`='$precio',`costo`='$costo',
                                `existencia`='$existencia',`cargo_extra_envio`='$cargo_extra_envio',`foto_articulo`='$foto_articulo' WHERE `id_articulo` = '$id_articulo'");
	
		if ($result) {
			$res['message'] = "Articulo actualizado correctamente.";
		} else {
			$res['error']   = true;
			$res['message'] = "Fallo en la actualización del artículo.".mysqli_error($conn);
 		}
	}

	// Delete data
	if ($action == 'delete') {
        $id_articulo       	    = $_POST['id_articulo'];
		
		$result = $conn->query("UPDATE tienda_articulo SET `status` = 9 WHERE `id_articulo`='$id_articulo'");

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