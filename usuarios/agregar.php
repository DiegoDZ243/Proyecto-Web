<?php 
    session_start(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
</head>
<body>
<div class="navbar">
        <div>
            <a href="mostrar.php"><img src="img/icn-regresar.png"> Regresar</a>
            <h1>🛫 AeroPHP - Panel de Empleado</h1>
        </div>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
<div class="contenedor">

    <h1>Agregar Usuario</h1>

    <form action="insertar.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Apellido Paterno:</label>
        <input type="text" name="a_paterno" required>

        <label>Apellido Materno:</label>
        <input type="text" name="a_materno" required>

        <label>Fecha Nacimiento:</label>
        <input type="date" name="fecha_nac" required>

        <label>Correo:</label>
        <input type="email" name="correo" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">
            Guardar Usuario
        </button>

    </form>

</div>

</body>
</html>
