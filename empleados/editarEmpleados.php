<?php
    // Dirección de la api
    require("api/classEmpleado.php"); 
    // Nombre de la clase dentro de la api
    $claseEmpleados=new empleado(); 

    // Uso de la api para obtener el empleado con GET["id"] que es el que se manda a la url

    $empleadoActual=$claseEmpleados->getEmpleadoById($_GET["id"]);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
</head>
<body>

<h2>Editar Empleado</h2>

<form action="guardarActualizacion.php" method="POST">

    <input type="hidden" name="id" value="<?= $empleadoActual["id_empleado"] ?>">

    <label>Nombre:</label>
    <!-- Para valores puntuales usar "< ?=  ?>" (sin el espacio entre < ?; solo que si lo junto marca error, jaja)-->
    <input type="text" name="nombre" value="<?= $empleadoActual["nombre"] ?>">
    <br><br>

    Apellido Paterno:
    <input type="text" name="a_paterno" value="<?= $empleadoActual["a_paterno"] ?>">
    <br><br>

    Apellido Materno:
    <input type="text" name="a_materno" value="<?= $empleadoActual["a_materno"] ?>">
    <br><br>

    Sueldo:
    <input type="text" name="sueldo" value="<?= $empleadoActual["sueldo"] ?>">
    <br><br>

    Hora Entrada:
    <input type="time" name="hora_entrada" value="<?=  $empleadoActual["hora_entrada"] ?>">
    <br><br>

    Hora Salida:
    <input type="time" name="hora_salida" value="<?= $empleadoActual["hora_salida"] ?>">
    <br><br>

    ID Jefe:
    <input type="text" name="id_jefe" value="<?= $empleadoActual["id_jefe"] ?>">
    <br><br>

    <button type="submit">
        Actualizar
    </button>

</form>

</body>
</html>