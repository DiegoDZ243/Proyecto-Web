<?php

require("api/classEmpleado.php"); 

$claseEmpleado=new empleado(); 

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$sueldo = $_POST['sueldo'];
$hora_entrada = $_POST['hora_entrada'];
$hora_salida = $_POST['hora_salida'];
$id_jefe = $_POST['id_jefe'];


$claseEmpleado->actualizarEmpleado($id,$nombre,$a_paterno,$a_materno,$sueldo,$hora_entrada,$hora_salida,$id_jefe); 

header("Location: consultarEmpleados.php");

?>