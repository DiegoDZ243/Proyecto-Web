<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('api/classEmpleado.php'); 
    $empleado=new empleado();
    
    $nombre = $_POST['nombre'];
    $apePat = $_POST['apellidoPat'];
    $apeMat = $_POST['apellidoMat'];
    $salario = $_POST['salario'];
    $hora_entrada=$_POST["hora_entrada"]; 
    $hora_salida=$_POST["hora_salida"]; 
    $id_jefe=$_POST["id_jefe"]; 
    $email=$_POST["email"]; 
    $pass=$_POST["pass"]; 
    // Se registra al jefe 1, solo para pruebas
    $empleado->insert($nombre, $apeMat, $apeMat, $salario,$hora_entrada,$hora_salida,$id_jefe,$email,$pass); 

    header("Location: consultarEmpleados.php");
    exit;
?>