<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleados</title>

    <link rel="stylesheet" href="css/empleados.css">

</head>
<body>

    <h2>Registro de Empleados - AeroPHP</h2>

    <form action="guardarEmpleado.php" method="POST">

        <label>Nombre</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido Paterno</label><br>
        <input type="text" name="a_paterno" required><br><br>

        <label>Apellido Materno</label><br>
        <input type="text" name="a_materno" required><br><br>

        <label>Sueldo</label><br>
        <input type="number" step="0.01" name="sueldo" required><br><br>

        <label>Hora Entrada</label><br>
        <input type="time" name="hora_entrada" required><br><br>

        <label>Hora Salida</label><br>
        <input type="time" name="hora_salida" required><br><br>

        <label>ID Jefe (opcional)</label><br>
        <input type="number" name="id_jefe"><br><br>

        <button type="submit">
            Agregar Empleado
        </button>

    </form>

</body>
</html>