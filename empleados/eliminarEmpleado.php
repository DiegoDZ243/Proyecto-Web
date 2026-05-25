<?php
    require("api/classEmpleado.php"); 

    $claseEmpleados=new empleado(); 

    $claseEmpleados->eliminarEmpleado($_GET["id"]); 

    header("Location: consultarEmpleados.php"); 

?>