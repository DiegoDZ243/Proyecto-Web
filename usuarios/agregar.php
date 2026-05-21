<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>

<h1>Agregar Usuario</h1>

<form action="insertar.php" method="POST">

    <label>Nombre:</label><br>
    <input type="text" name="nombre"><br><br>

    <label>Apellido Paterno:</label><br>
    <input type="text" name="a_paterno"><br><br>

    <label>Apellido Materno:</label><br>
    <input type="text" name="a_materno"><br><br>

    <label>Fecha Nacimiento:</label><br>
    <input type="date" name="fecha_nac"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">
        Guardar Usuario
    </button>

</form>

</body>
</html>
