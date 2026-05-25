<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("api/classEmpleado.php"); 

$claseEmpleado=new empleado(); 

$id = $_POST["id_empleado"];
$nombre = $_POST['nombre'];
$a_paterno = $_POST['apellidoPat'];
$a_materno = $_POST['apellidoMat'];
$sueldo = $_POST['salario'];
$hora_entrada = $_POST['hora_entrada'];
$hora_salida = $_POST['hora_salida'];
$email=$_POST["email"]; 
$pass=$_POST["pass"]; 
$id_jefe = $_POST['id_jefe'];


$claseEmpleado->actualizarEmpleado($id,$nombre,$a_paterno,$a_materno,$sueldo,$hora_entrada,$hora_salida,$email,$pass,$id_jefe); 

header("Location: consultarEmpleados.php");

?>