<?php

require("../Conexion/classConnectionMySQL.php");

$id = $_GET['id'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

/* ELIMINAR PRIMERO LOS BOLETOS */
$queryBoletos = "DELETE FROM boletos WHERE id_usuario = '$id'";
$NewConn->ExecuteQuery($queryBoletos);

/* DESPUÉS EL USUARIO */
$queryUsuario = "DELETE FROM usuarios WHERE id_usuario = '$id'";
$result = $NewConn->ExecuteQuery($queryUsuario);

if($result){

    header("Location: mostrar.php");

}else{

    echo "Error al eliminar";

}

?>
