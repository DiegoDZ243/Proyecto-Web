<?php
    session_start(); 
    include("api/classEmpleado.php");

    $classEmpleado=new empleado(); 

    $listaEmpleados=$classEmpleado->getEmpleados(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Empleados</title>
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
    <link rel="stylesheet" href="css/consultarEmpleados.css">
</head>
<body>
<div class="navbar">
        <div>
            <a href="../dashboard_empleado.php"><img src="img/icn-regresar.png"> Regresar</a>
            <h1>🛫 AeroPHP - Panel de Empleado</h1>
        </div>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="../logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
<main class="contenedor-empleados">

    <div class="encabezado-empleados">
        <h2>Lista de Empleados</h2>

        <a href="agregarEmpleados.php" class="btn-agregar">
            Agregar Empleado
        </a>
    </div>

    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Sueldo</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th>Jefe</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($listaEmpleados as $fila): ?>
                    <tr>
                        <td><?= $fila['id_empleado']; ?></td>
                        <td><?= htmlspecialchars($fila['nombre']); ?></td>
                        <td><?= htmlspecialchars($fila['a_paterno']); ?></td>
                        <td><?= htmlspecialchars($fila['a_materno']); ?></td>
                        <td>$<?= number_format($fila['sueldo'], 2); ?></td>
                        <td><?= $fila['hora_entrada']; ?></td>
                        <td><?= $fila['hora_salida']; ?></td>
                        <td><?= $fila['id_jefe']; ?></td>

                        <td class="acciones">
                            <a href="editarEmpleados.php?id=<?= $fila['id_empleado']; ?>" class="btn-editar">
                                Editar
                            </a>

                            <a href="eliminarEmpleado.php?id=<?= $fila['id_empleado']; ?>" class="btn-eliminar">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>