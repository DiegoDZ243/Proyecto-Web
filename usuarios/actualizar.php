<?php

require("../Conexion/classConnectionMySQL.php");

$id = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$fecha_nac = $_POST['fecha_nac'];
$correo = $_POST['correo'];
$password = $_POST['password'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "UPDATE usuarios SET
nombre = '$nombre',
a_paterno = '$a_paterno',
a_materno = '$a_materno',
fecha_nac = '$fecha_nac',
correo = '$correo',
password = '$password'
WHERE id_usuario = '$id'";

$result = $NewConn->ExecuteQuery($query);

if($result){

    header("Location: mostrar.php");

}else{

    echo "Error al actualizar";

}

?>
