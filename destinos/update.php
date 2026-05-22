<?php 
    session_start(); 
    require("api/classDestino.php"); 
    $claseDestinos=new destino(); 
    $id_destino=$_POST["id_destino"]; 
    $nombre=$_POST["ciudad"]; 
    $imagen=$_POST["imagen"]; 
    echo $nombre ." ".$imagen." ".$id_destino; 
    $tempDestino=$claseDestinos->getDestinoPorNombre($nombre); 
    if($tempDestino && (int)$tempDestino["id_destino"] !== $id_destino){
        $_SESSION["duplicado"]=true; 
        $_SESSION["ciudad"]=$nombre;
        $_SESSION["imagen"]=$imagen; 
        header("Location: editarDestino.php?id=$id_destino");
        exit; 
    }else{
        $claseDestinos->updateDestino($id_destino,$nombre,$imagen); 
        header("Location: destinos.php");
    }
?>

