<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

include("Conexión.php");

$id = $_GET['id'];

$sql = "SELECT * FROM empleados WHERE id_empleado = '$id'";

$resultado = mysqli_query($conn, $sql);

$fila = mysqli_fetch_assoc($resultado);

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

    <input type="hidden" name="id" value="<?php echo $fila['id_empleado']; ?>">

    Nombre:
    <input type="text" name="nombre" value="<?php echo $fila['nombre']; ?>">
    <br><br>

    Apellido Paterno:
    <input type="text" name="a_paterno" value="<?php echo $fila['a_paterno']; ?>">
    <br><br>

    Apellido Materno:
    <input type="text" name="a_materno" value="<?php echo $fila['a_materno']; ?>">
    <br><br>

    Sueldo:
    <input type="text" name="sueldo" value="<?php echo $fila['sueldo']; ?>">
    <br><br>

    Hora Entrada:
    <input type="time" name="hora_entrada" value="<?php echo $fila['hora_entrada']; ?>">
    <br><br>

    Hora Salida:
    <input type="time" name="hora_salida" value="<?php echo $fila['hora_salida']; ?>">
    <br><br>

    ID Jefe:
    <input type="text" name="id_jefe" value="<?php echo $fila['id_jefe']; ?>">
    <br><br>

    <button type="submit">
        Actualizar
    </button>

</form>

</body>
</html>