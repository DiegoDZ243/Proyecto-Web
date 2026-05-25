<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

include("Conexión.php");

$id = $_GET['id'];

$sql = "DELETE FROM empleados WHERE id_empleado = '$id'";

mysqli_query($conn, $sql);

header("Location: consultarEmpleados.php");

?>