<?php

require("../Conexion/classConnectionMySQL.php");

$nombre = $_POST['nombre'];
$a_paterno = $_POST['a_paterno'];
$a_materno = $_POST['a_materno'];
$fecha_nac = $_POST['fecha_nac'];
$correo = $_POST['correo'];
$password = $_POST['password'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "INSERT INTO usuarios VALUES(
null,
'$nombre',
'$a_paterno',
'$a_materno',
'$fecha_nac',
'$correo',
'$password'
)";

$result = $NewConn->ExecuteQuery($query);

if($result){

    $RowCount = $NewConn->GetCountAffectedRows();

    if($RowCount > 0){

        header("Location: mostrar.php");

    }

}else{

    echo "Error al insertar";

}

?>
