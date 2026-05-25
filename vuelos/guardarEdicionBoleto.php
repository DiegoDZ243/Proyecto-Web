<?php
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: buscarVuelos.php");
    exit();
}

require_once("api/classInfoVuelos.php");

$infoBoletos = new vuelos();

$id_boleto = intval($_POST["id_boleto"]);
$id_vuelo = intval($_POST["id_vuelo"]);
$asiento = trim($_POST["asiento"]);
$nombre = trim($_POST["nombre"]);
$a_paterno = trim($_POST["a_paterno"]);
$a_materno = trim($_POST["a_materno"]);

if(
    empty($id_boleto) ||
    empty($id_vuelo) ||
    empty($asiento) ||
    empty($nombre) ||
    empty($a_paterno) ||
    empty($a_materno)
){
    header("Location: editarBoleto.php?id_boleto=$id_boleto&err=campos");
    exit();
}

$actualizado = $infoBoletos->actualizarBoleto(
    $id_boleto,
    $id_vuelo,
    $asiento,
    $nombre,
    $a_paterno,
    $a_materno
);

if($actualizado){
    header("Location: mis_boletos.php?actualizado=ok");
    exit();
}else{
    header("Location: editarBoleto.php?id_boleto=$id_boleto&err=bd");
    exit();
}
?>