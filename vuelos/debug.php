<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require("api/classInfoVuelos.php"); 

    $vuelos=new vuelos(); 
    $listaVuelos=$vuelos->getVuelosBaratos(); 

    $listaVuelosActuales=$vuelos->getVuelos(); 


    foreach($listaVuelos as $v){
        echo "id_vuelo: ".$v["id_vuelo"]."<br>"; 
        echo "imagen: ".$v["imagen"]."<br>";
    }

    echo "<br><br>"; 

    foreach($listaVuelosActuales as $v){
        echo "id_vuelo: ".$v["id_vuelo"]."<br>";
    }



?>