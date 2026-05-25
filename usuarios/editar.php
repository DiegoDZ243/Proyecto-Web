<?php

require("../Conexion/classConnectionMySQL.php");

$id = $_GET['id'];

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();

$query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";

$result = $NewConn->ExecuteQuery($query);

$row = $NewConn->GetRows($result);
if(!$row){
    die("Usuario no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>

<div class="contenedor">

    <h1>Editar Usuario</h1>

    <form action="actualizar.php" method="POST">

        <input type="hidden" name="id_usuario" value="<?php echo $row[0]; ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row[1]; ?>" required>

        <label>Apellido Paterno:</label>
        <input type="text" name="a_paterno" value="<?php echo $row[2]; ?>" required>

        <label>Apellido Materno:</label>
        <input type="text" name="a_materno" value="<?php echo $row[3]; ?>" required>

        <label>Fecha Nacimiento:</label>
        <input type="date" name="fecha_nac" value="<?php echo $row[4]; ?>" required>

        <label>Correo:</label>
        <input type="email" name="correo" value="<?php echo $row[5]; ?>" required>

        <label>Password:</label>
        <input type="text" name="password" value="<?php echo $row[6]; ?>" required>

        <button type="submit">
            Actualizar Usuario
        </button>

    </form>

</div>

</body>
</html>
