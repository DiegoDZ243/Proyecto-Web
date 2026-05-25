<?php
session_start();

require_once('../Conexion/classConnectionMySQL.php');

$id_usuario = $_SESSION['id_usuario'];

$conn = new ConnectionMySQL();
$conn->CreateConnection();

// Obtener boletos del usuario
$query = "SELECT 
            b.id_boleto,
            b.asiento,
            b.nombre,
            b.a_paterno,
            b.a_materno,
            b.checked_in,
            v.id_vuelo,
            v.fecha,
            v.hora_salida,
            v.precio,
            o.ciudad as origen,
            d.ciudad as destino
        FROM boletos b
        JOIN vuelos v ON b.id_vuelo = v.id_vuelo
        JOIN destinos o ON v.id_origen = o.id_destino
        JOIN destinos d ON v.id_destino = d.id_destino
        WHERE b.id_usuario = $id_usuario and b.checked_in = 0
        ORDER BY v.fecha DESC, o.ciudad DESC";

$result = $conn->ExecuteQuery($query);
$boletos = [];

if ($result && $result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $boletos[] = $fila;
    }
    $result->free();
}

$conn->CloseConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Boletos - AeroPHP</title>
    <link rel="stylesheet" href="css/mis_boletos.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css"> 
</head>
<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contenedor-volver-menu">
                <a href="buscarVuelos.php">
                    <img src="img/icn-regresar.png">
                    <h3>Regresar</h3>
                </a>
                <div class="contendor-logo">
                    <h5>AeroPHP</h5>
                    <img src="img/icn-logo.png" alt="logo aeropuerto">
                </div>
            </div>
            <div class="contendor-enlaces">
                <?php if(isset($_SESSION["usuario"])):?>
                    <h3> ¡Bienvenido, <?= $_SESSION["usuario"] ?>!</h3>
                <?php endif ?>
                <a href="../logout.php" id="login-boton" style="color: red;">
                    <img src="img/icn-usuario.png" alt="iconoUsuario">
                    <?php if(isset($_SESSION["usuario"])){ ?>
                        <h5>Cerrar sesión</h5>

                    <?php } else { ?>
                        <h5>Iniciar sesión</h5>
                    <?php } ?>
                </a>
            </div>
        </div>
    </section>
     <div class="contenedor-confirmacion" id="contenedor-confirmacion" hidden>
        <h3>El proceso de reembolso fue un éxito</h3>
        <img src="img/icn_confirmar.png">
        <p>Se le redirigirá en breve...</p>
    </div>
    <div class="contenedor">
        <div class="titulo">
            <h2>Tus Boletos de Vuelo</h2>
            <p>Aquí puedes ver todos tus boletos de vuelo reservados</p>
        </div>

        <?php if (empty($boletos)): ?>
            <div class="no-boletos">
                <p>No tienes boletos reservados aún.</p>
                <a href="buscarVuelos.php" class="btn-volver">Buscar y Reservar Vuelos</a>
            </div>
        <?php else: ?>
            <div class="boletos-list">
                <?php foreach ($boletos as $boleto): ?>
                    <div class="boleto-completo">
                        <div class="boleto-card">
                            <div class="boleto-header">
                                <h3><?= htmlspecialchars($boleto['origen']) ?> → <?= htmlspecialchars($boleto['destino']) ?></h3>
                                <span class="estado-boleto <?= $boleto['checked_in'] ? 'estado-confirmado' : 'estado-pendiente' ?>">
                                    <?= $boleto['checked_in'] ? 'Check-in Realizado' : 'Pendiente Check-in' ?>
                                </span>
                            </div>

                            <div class="boleto-info">
                                <label>Fecha de Vuelo</label>
                                <p><?= date('d/m/Y', strtotime($boleto['fecha'])) ?></p>
                            </div>

                            <div class="boleto-info">
                                <label>Hora de Salida</label>
                                <p><?= $boleto['hora_salida'] ?></p>
                            </div>

                            <div class="boleto-info">
                                <label>Asiento</label>
                                <p><?= htmlspecialchars($boleto['asiento']) ?></p>
                            </div>

                            <div class="pasajero-info">
                                <h4>Pasajero</h4>
                                <p><?= htmlspecialchars($boleto['nombre'] . ' ' . $boleto['a_paterno'] . ' ' . $boleto['a_materno']) ?></p>
                            </div>

                            <div class="boleto-info">
                                <label>Precio</label>
                                <p>$<?= number_format($boleto['precio'], 2) ?> MXN</p>
                            </div>

                            <div class="boleto-info">
                                <label>ID Boleto</label>
                                <p>#<?= $boleto['id_boleto'] ?></p>
                            </div>
                        </div>
                        <div class="pie-boleto">
                            <form class="form-boleto" method="post" action="delete.php">
                                <input name="id_boleto" value="<?= $boleto["id_boleto"] ?>" hidden>
                                <button id="btnReembolsar-<?= $boleto["id_boleto"] ?>"><img src="img/icn_eliminar.png"> Reembolsar Boleto </button>
                            </form>
                            <form class="form-boleto" method="post" action="editarBoleto.php?id_boleto=<?= $boleto["id_boleto"] ?>" >
                                <input name="id_boleto" value="<?= $boleto["id_boleto"] ?>" hidden>
                                <button id="btnReembolsar-<?= $boleto["id_boleto"] ?>"><img src="img/icn_modificar.png"> Modificar Boleto </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
