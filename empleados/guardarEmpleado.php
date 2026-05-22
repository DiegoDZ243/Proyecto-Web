<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('api/classEmpleado.php'); 
    $empleado=new empleado();
    
    $nombre = $_POST['nombre'];
    $apePat = $_POST['apellidoPat'];
    $apeMat = $_POST['apellidoMat'];
    $salario = $_POST['salario'];

    $empleado->insert($nombre, $apeMat, $apeMat, $salario); 

    header("Location: agregarEmpleados.php");
    exit;
?>
