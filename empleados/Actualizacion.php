<?php

include("Conexión.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$sueldo = $_POST['sueldo'];
$hora_entrada = $_POST['hora_entrada'];
$hora_salida = $_POST['hora_salida'];
$id_jefe = $_POST['id_jefe'];

$sql = "UPDATE empleados SET

nombre='$nombre',
a_paterno='$a_paterno',
a_materno='$a_materno',
sueldo='$sueldo',
hora_entrada='$hora_entrada',
hora_salida='$hora_salida',
id_jefe='$id_jefe'

WHERE id_empleado='$id'
";

mysqli_query($conn, $sql);

header("Location: consultarEmpleados.php");

?>