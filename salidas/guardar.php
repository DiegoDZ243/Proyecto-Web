<?php
    require("api/classSalidas.php"); 
    $claseSalida=new vuelos(); 
    $origen=$_POST["origen"]; 
    $destino=$_POST["destino"]; 
    $fecha_salida=$_POST["fecha_salida"]; 
    $hora_salida=$_POST["hora_salida"];
    $precio=$_POST["precio"]; 

    $claseSalida->agregarVuelo($origen,$destino,$fecha_salida,$hora_salida,$precio); 

    header("Location: salidas.php");


?>