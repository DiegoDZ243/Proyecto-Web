<?php

include("../Conexion/classConnectionMySQL.php");

$conexion = new ConnectionMySQL();

$conexion->CreateConnection();

$sql = "SELECT * FROM empleados";

$resultado = $conexion->ExecuteQuery($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Empleados</title>
</head>
<body>

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
    <th>ID Jefe</th>
    <th>Acciones</th>

</tr>

<?php while($fila = $conexion->GetRowsWithColumn($resultado)){ ?>

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

<?php } ?>

</table>

</body>
</html>