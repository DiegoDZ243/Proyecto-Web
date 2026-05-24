<?php
session_start();
session_destroy();
echo "Sesión cerrada";
header("Location:vuelos/buscarVuelos.php");  
exit();
?>
