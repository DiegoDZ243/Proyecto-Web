<?php
session_start();
require_once('Conexion/classConnectionMySQL.php');

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';

if ($accion === 'login') {
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!$correo || !$password) {
        header('Location: index.html?error=' . urlencode('Por favor completa todos los campos'));
        exit();
    }

    $conn = new ConnectionMySQL();
    $conn->CreateConnection();

    // Buscar en tabla de clientes (usuarios)
    $query = "SELECT id_usuario as id, nombre, a_paterno, a_materno, correo, 'cliente' as tipo FROM usuarios WHERE correo = '$correo' AND password = '$password'";
    $result = $conn->ExecuteQuery($query);
    
    $usuario = null;
    if ($result && $result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $result->free();
    }

    // Si no es cliente, buscar en tabla de empleados
    if (!$usuario) {
        $query = "SELECT id_empleado as id, nombre, a_paterno, a_materno, correo, 'empleado' as tipo FROM empleados WHERE correo = '$correo' AND password = '$password'";
        $result = $conn->ExecuteQuery($query);
        
        if ($result && $result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $result->free();
        }
    }

    $conn->CloseConnection();

    if ($usuario) {
        // Login exitoso
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_apellidos'] = $usuario['a_paterno'] . ' ' . $usuario['a_materno'];
        $_SESSION['usuario_correo'] = $usuario['correo'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        if ($usuario['tipo'] === 'cliente') {
            header('Location: vuelos/buscarVuelos.php');
        } else {
            header('Location: dashboard_empleado.php');
        }
        exit();
    } else {
        // Login fallido
        header('Location: index.html?error=' . urlencode('Correo o contraseña incorrectos'));
        exit();
    }
}

if ($accion === 'registro') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno'] : '';
    $a_materno = isset($_POST['a_materno']) ? $_POST['a_materno'] : '';
    $fecha_nac = isset($_POST['fecha_nac']) ? $_POST['fecha_nac'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

    // Validaciones
    if (!$nombre || !$a_paterno || !$a_materno || !$fecha_nac || !$correo || !$password) {
        header('Location: index.html?error=' . urlencode('Por favor completa todos los campos'));
        exit();
    }

    if ($password !== $password_confirm) {
        header('Location: index.html?error=' . urlencode('Las contraseñas no coinciden'));
        exit();
    }

    $conn = new ConnectionMySQL();
    $conn->CreateConnection();

    // Verificar si el correo ya existe
    $query = "SELECT correo FROM usuarios WHERE correo = '$correo' UNION SELECT correo FROM empleados WHERE correo = '$correo'";
    $result = $conn->ExecuteQuery($query);

    if ($result && $result->num_rows > 0) {
        $conn->CloseConnection();
        header('Location: index.html?error=' . urlencode('Este correo ya está registrado'));
        exit();
    }

    // Insertar nuevo usuario
    $query = "INSERT INTO usuarios (nombre, a_paterno, a_materno, fecha_nac, correo, password) 
              VALUES ('$nombre', '$a_paterno', '$a_materno', '$fecha_nac', '$correo', '$password')";
    
    if ($conn->ExecuteQuery($query)) {
        $conn->CloseConnection();
        header('Location: index.html?mensaje=' . urlencode('¡Registro exitoso! Ahora inicia sesión con tus credenciales') . '&tipo=success');
        exit();
    } else {
        $conn->CloseConnection();
        header('Location: index.html?error=' . urlencode('Error al registrar el usuario. Intenta nuevamente'));
        exit();
    }
}

// Si no hay acción, redirigir al índice
header('Location: index.html');
exit();
?>
