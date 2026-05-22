<?php

include("Conexión.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT * FROM empleados WHERE id_empleado = $id";

    $resultado = mysqli_query($conn, $sql);

    $fila = mysqli_fetch_assoc($resultado);

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Empleado</title>
</head>
<body>

    <h2>Actualizar Empleado</h2>

    <form action="actualizarEmpleado.php" method="POST">

        <input 
            type="hidden" 
            name="id_empleado"
            value="<?php echo $fila['id_empleado']; ?>"
        >

        <label>Nombre</label><br>
        <input 
            type="text" 
            name="nombre"
            value="<?php echo $fila['nombre']; ?>"
        >
        <br><br>

        <label>Apellido Paterno</label><br>
        <input 
            type="text" 
            name="a_paterno"
            value="<?php echo $fila['a_paterno']; ?>"
        >
        <br><br>

        <label>Apellido Materno</label><br>
        <input 
            type="text" 
            name="a_materno"
            value="<?php echo $fila['a_materno']; ?>"
        >
        <br><br>

        <label>Sueldo</label><br>
        <input 
            type="number" 
            step="0.01"
            name="sueldo"
            value="<?php echo $fila['sueldo']; ?>"
        >
        <br><br>

        <label>Hora Entrada</label><br>
        <input 
            type="time" 
            name="hora_entrada"
            value="<?php echo $fila['hora_entrada']; ?>"
        >
        <br><br>

        <label>Hora Salida</label><br>
        <input 
            type="time" 
            name="hora_salida"
            value="<?php echo $fila['hora_salida']; ?>"
        >
        <br><br>

        <label>ID Jefe</label><br>
        <input 
            type="number" 
            name="id_jefe"
            value="<?php echo $fila['id_jefe']; ?>"
        >
        <br><br>

        <button type="submit">
            Actualizar Empleado
        </button>

    </form>

</body>
</html>
