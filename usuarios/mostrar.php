<?php

require("../Conexion/classConnectionMySQL.php");

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "SELECT * FROM usuarios";

$result = $NewConn->ExecuteQuery($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Usuarios</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>

<h1>Lista de Usuarios</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Fecha</th>
    <th>Correo</th>
    <th>Password</th>
    <th>Editar</th>
    <th>Eliminar</th>
</tr>

<?php

while($row = $NewConn->GetRows($result)){

    echo "<tr>";

    echo "<td>".$row[0]."</td>";
    echo "<td>".$row[1]."</td>";
    echo "<td>".$row[2]."</td>";
    echo "<td>".$row[3]."</td>";
    echo "<td>".$row[4]."</td>";
    echo "<td>".$row[5]."</td>";
    echo "<td>".$row[6]."</td>";
    echo "<td>
    <a href='editar.php?id=".$row[0]."'>
    Editar
    </a>
    </td>";
    
    echo "<td>
    <a href='eliminar.php?id=".$row[0]."'>
    Eliminar
    </a>
    </td>";

    echo "</tr>";

}

?>

</table>

</body>
</html>
