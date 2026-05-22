<?php

include("Conexión.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM empleados
            WHERE id_empleado = $id";

    mysqli_query($conn, $sql);

}

header("Location: consultarEmpleados.php");

?>