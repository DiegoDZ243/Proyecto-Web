<?php
	// Ejecuta la eliminación de un vuelo y redirige a salidas.php
	require_once('../Conexion/classConnectionMySQL.php');

	$id = null;
	if (isset($_POST['id_vuelo'])) {
		$id = intval($_POST['id_vuelo']);
	} elseif (isset($_GET['id'])) {
		$id = intval($_GET['id']);
	}

	if ($id) {
		$conn = new ConnectionMySQL();
		$conn->CreateConnection();
		$sql = "CALL sp_eliminarVuelo($id)";
		$conn->ExecuteQuery($sql);
		$conn->ClearResults();
		$conn->CloseConnection();
	}

	header('Location: salidas.php');
	exit();
?>
