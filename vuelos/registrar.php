<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("api/classInfoVuelos.php");

$claseUsuario=new vuelos();

$nombre = trim($_POST["nombre"]);
$apellidoPat = trim($_POST["apellidoPat"]);
$apellidoMat = trim($_POST["apellidoMat"]);
$fecha_nac = trim($_POST["fecha_nac"]);
$correo = trim($_POST["correo"]);
$password = trim($_POST["pass"]);
$confirmarPass = trim($_POST["confirmarPass"]);
$router = $_POST["router"] ?? "buscarVuelos.php";

if(
    empty($nombre) ||
    empty($apellidoPat) ||
    empty($apellidoMat) ||
    empty($fecha_nac) ||
    empty($correo) ||
    empty($password) ||
    empty($confirmarPass)
){
    header("Location: $router?errRegistro=campos");
    exit();
}

if($password != $confirmarPass){
    header("Location: $router?errRegistro=pass");
    exit();
}

if($claseUsuario->insertarUsuario($nombre, $apellidoPat, $apellidoMat, $fecha_nac, $correo, $password)){
    header("Location: $router?registro=ok");
}else{
    header("Location: $router?errRegistro=bd");
}

exit();
?>