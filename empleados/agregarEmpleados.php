<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('api/classEmpleado.php');

$empleado = new Empleado();

$resultado = $empleado->getEmpleados();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados Aeropuerto</title>
</head>
<body>

<h1>Agregar Empleado</h1>

<form action="guardar.php" method="POST">

    <input type="text" name="nombre" placeholder="Nombre">

    <input type="text" name="apellido" placeholder="Apellido">

    <input type="text" name="puesto" placeholder="Puesto">

    <input type="number" name="salario" placeholder="Salario">

    <button type="submit">
        Guardar
    </button>

</form>

<hr>

<h2>Lista de empleados</h2>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Puesto</th>
        <th>Salario</th>
    </tr>

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

    <tr>

        <td><?php echo $fila['id']; ?></td>

        <td><?php echo $fila['nombre']; ?></td>

        <td><?php echo $fila['apellido']; ?></td>

        <td><?php echo $fila['puesto']; ?></td>

        <td><?php echo $fila['salario']; ?></td>

    </tr>

    <?php } ?>

</table>

</body>
</html>