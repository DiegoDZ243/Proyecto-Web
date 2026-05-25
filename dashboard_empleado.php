<?php
session_start();

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'empleado') {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AeroPHP Empleados</title>
    <link rel="stylesheet" href="dashboard_empleado.css">
</head>
<body>
    <div class="navbar">
        <h1>🛫 AeroPHP - Panel de Empleado</h1>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>

    <div class="contenedor">
        <div class="titulo">
            <h2>Gestión Administrativa</h2>
            <p>Accede a los módulos de gestión de destinos y salidas</p>
        </div>

        <div class="grid">
            <!-- TARJETA: DESTINOS -->
            <div class="card">
                <div class="icon"><img src="img/icn-destino.png"></div>
                <h3>Gestión de Destinos</h3>
                <p>Crea, edita y elimina destinos disponibles en el sistema.</p>
                <div class="button-group">
                    <a href="destinos/destinos.php" class="btn btn-primary">Ver Destinos</a>
                    <a href="destinos/crearDestinos.php" class="btn btn-success">Crear Destino</a>
                </div>
            </div>

            <!-- TARJETA: SALIDAS -->
            <div class="card">
                <div class="icon"><img src="img/icn-salidas.png"></div>
                <h3>Gestión de Salidas</h3>
                <p>Crea, edita y elimina salidas (vuelos) del sistema.</p>
                <div class="button-group">
                    <a href="salidas/salidas.php" class="btn btn-primary">Ver Salidas</a>
                    <a href="salidas/crearSalida.php" class="btn btn-success">Crear Salida</a>
                </div>
            </div>
            <div class="card">
                <div class="icon"><img src="img/icn-empleado.png"></div>
                <h3>Gestión de Empleados</h3>
                <p>Crea, edita y elimina los empleados del sistema.</p>
                <div class="button-group">
                    <a href="empleados/consultarEmpleados.php" class="btn btn-primary">Ver Empleados</a>
                    <a href="empleados/agregarEmpleados.php" class="btn btn-success">Crear Empleado</a>
                </div>
            </div>
            <div class="card">
                <div class="icon"><img src="img/icn-usuario.png"></div>
                <h3>Gestión de Usuarios</h3>
                <p>Crea, edita y elimina los usuarios del sistema.</p>
                <div class="button-group">
                    <a href="usuarios/mostrar.php" class="btn btn-primary">Ver Usuarios</a>
                    <a href="usuarios/agregar.php" class="btn btn-success">Crear Usuarios</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
