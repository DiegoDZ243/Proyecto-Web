<?php

require("../Conexion/classConnectionMySQL.php");

$id = $_GET['id'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";

$result = $NewConn->ExecuteQuery($query);

$row = $NewConn->GetRows($result);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>

<h1>Editar Usuario</h1>

<form action="actualizar.php" method="POST">

    <input type="hidden" name="id_usuario" value="<?php echo $row[0]; ?>">

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?php echo $row[1]; ?>"><br><br>

    <label>Apellido Paterno:</label><br>
    <input type="text" name="a_paterno" value="<?php echo $row[2]; ?>"><br><br>

    <label>Apellido Materno:</label><br>
    <input type="text" name="a_materno" value="<?php echo $row[3]; ?>"><br><br>

    <label>Fecha Nacimiento:</label><br>
    <input type="date" name="fecha_nac" value="<?php echo $row[4]; ?>"><br><br>

    <label>Correo:</label><br>
    <input type="email" name="correo" value="<?php echo $row[5]; ?>"><br><br>

    <label>Password:</label><br>
    <input type="text" name="password" value="<?php echo $row[6]; ?>"><br><br>

    <button type="submit">
        Actualizar Usuario
    </button>

</form>

</body>
</html>
