<?php

require("../Conexion/classConnectionMySQL.php");

$id = $_GET['id'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "DELETE FROM usuarios
WHERE id_usuario = '$id'";

$result = $NewConn->ExecuteQuery($query);

if($result){

    header("Location: mostrar.php");

}else{

    echo "Error al eliminar";

}

?>
