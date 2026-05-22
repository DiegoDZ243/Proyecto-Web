<?php
    $id_destino=$_GET["id"]; 
    $destinos=new destino(); 

    $destinoActual=$destinos->getDestino($id_destino); 

?>