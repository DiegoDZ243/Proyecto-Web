<?php

include("Conexión.php");

$id = $_GET['id'];

$sql = "DELETE FROM empleados WHERE id_empleado = '$id'";

mysqli_query($conn, $sql);

header("Location: consultarEmpleados.php");

?>