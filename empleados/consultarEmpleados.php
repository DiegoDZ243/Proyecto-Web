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
</head>
<body>
<div class="navbar">
    <div>
        <a href="../dashboard_empleado.php"><img src="img/icn-regresar.png"> Regresar</a>
        <h1>🛫 AeroPHP - Panel de Empleado</h1>
    </div>
    <div class="usuario-info">
        <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
        <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</div>
<h2>Lista de Empleados</h2>

<table border="1">

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

<?php foreach($listaEmpleados as $fila): ?>

<tr> 

    <td><?php echo $fila['id_empleado']; ?></td>
    <td><?php echo $fila['nombre']; ?></td>
    <td><?php echo $fila['a_paterno']; ?></td>
    <td><?php echo $fila['a_materno']; ?></td>
    <td><?php echo $fila['sueldo']; ?></td>
    <td><?php echo $fila['hora_entrada']; ?></td>
    <td><?php echo $fila['hora_salida']; ?></td>
    <td><?php echo $fila['id_jefe']; ?></td>

    <td>

        <a href="editarEmpleados.php?id=<?php echo $fila['id_empleado']; ?>">
            Editar
        </a>

        |

        <a href="eliminarEmpleado.php?id=<?php echo $fila['id_empleado']; ?>">
            Eliminar
        </a>

    </td>

</tr>

<?php endforeach ?>

</table>

</body>
</html>