<?php
	require("api/classSalidas.php");
	$claseSalida = new vuelos();

	// Obtener datos del formulario
	$id_vuelo = isset($_POST['id_vuelo']) ? intval($_POST['id_vuelo']) : null;
	$origen = isset($_POST['origen']) ? intval($_POST['origen']) : null;
	$destino = isset($_POST['destino']) ? intval($_POST['destino']) : null;
	$fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : null;
	$hora_salida = isset($_POST['hora_salida']) ? $_POST['hora_salida'] : null;
	$precio = isset($_POST['precio']) ? intval($_POST['precio']) : null;

	if ($id_vuelo && $origen && $destino && $fecha_salida && $hora_salida && $precio !== null) {
		$claseSalida->actualizarVuelo($id_vuelo, $origen, $destino, $fecha_salida, $hora_salida, $precio);
	}

	header("Location: salidas.php");
	exit();
?>

