<?php

include("Conexión.php");

$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$sueldo = $_POST['sueldo'];
$hora_entrada = $_POST['hora_entrada'];
$hora_salida = $_POST['hora_salida'];

if(empty($_POST['id_jefe'])){
    $id_jefe = "NULL";
}else{
    $id_jefe = $_POST['id_jefe'];
}

$sql = "INSERT INTO empleados
(
    nombre,
    a_paterno,
    a_materno,
    sueldo,
    hora_entrada,
    hora_salida,
    id_jefe
)

VALUES

(
    '$nombre',
    '$a_paterno',
    '$a_materno',
    '$sueldo',
    '$hora_entrada',
    '$hora_salida',
    $id_jefe
)";

mysqli_query($conn, $sql);

header("Location: agregarEmpleado.php");

?>