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

    <!-- AQUI VA EL CSS -->
    <link rel="stylesheet" href="css/empleados.css">

</head>

<body>

<h1>Agregar Empleado ✈️</h1>

<!-- AQUI VA EL ID DEL FORM -->
<form id="formEmpleado"
      action="guardar.php"
      method="POST">

    <!-- NOMBRE -->
    <input type="text"
           name="nombre"
           id="nombre"
           placeholder="Nombre">

    <!-- APELLIDO PATERNO -->
    <input type="text"
           name="a_paterno"
           id="a_paterno"
           placeholder="Apellido Paterno">

    <!-- APELLIDO MATERNO -->
    <input type="text"
           name="a_materno"
           id="a_materno"
           placeholder="Apellido Materno">

    <!-- SUELDO -->
    <input type="number"
           step="0.01"
           name="sueldo"
           id="sueldo"
           placeholder="Sueldo">

    <!-- HORA ENTRADA -->
    <label>Hora Entrada</label>

    <input type="time"
           name="hora_entrada">

    <!-- HORA SALIDA -->
    <label>Hora Salida</label>

    <input type="time"
           name="hora_salida">

    <!-- ID JEFE -->
    <input type="number"
           name="id_jefe"
           placeholder="ID Jefe">

    <button type="submit">

        Guardar Empleado

    </button>

</form>

<hr>

<h2>Lista de empleados</h2>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Sueldo</th>

    </tr>

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

    <tr>

        <td>
            <?php echo $fila['id_empleado']; ?>
        </td>

        <td>
            <?php echo $fila['nombre']; ?>
        </td>

        <td>
            <?php echo $fila['a_paterno']; ?>
        </td>

        <td>
            <?php echo $fila['a_materno']; ?>
        </td>

        <td>
            $<?php echo $fila['sueldo']; ?>
        </td>

    </tr>

    <?php } ?>

</table>

<script src="scripts/empleados.js"></script>

</body>
</html>