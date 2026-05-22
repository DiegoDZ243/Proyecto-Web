<?php
    session_start();
    $origen = $_SESSION['origen'] ?? '';
    $destino = $_SESSION['destino'] ?? '';
    $fecha_salida = $_SESSION['fecha_salida'] ?? '';
    $pasajeros = $_SESSION['pasajeros'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Sin resultados</title>
    <link rel="stylesheet" href="css/buscarVuelos.css">
    <link rel="stylesheet" href="css/noHayResultados.css">
</head>
<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contendor-logo">
                <h5>AeroPHP</h5>
                <img src="img/icn-logo.png" alt="logo aeropuerto">
            </div>
            <div class="contendor-enlaces">
                <a>Mis boletos</a>
                <a>
                    <img src="img/icn-usuario.png" alt="iconoUsuario">
                    <h5>Mi cuenta</h5>
                </a>
            </div>
        </div>
    </section>

    <main class="contenedor-no-resultados">
        <div class="tarjeta-no-resultados">
            <div class="icono-contenedor">
                <img src="img/icn-avion.png" alt="avión" class="icono-grande">
            </div>
            
            <h1>No hay resultados disponibles</h1>
            <p class="descripcion">Lo sentimos, no encontramos vuelos que coincidan con tus criterios de búsqueda.</p>
            
            <div class="filtros-utilizados">
                <h3>Filtros utilizados:</h3>
                <div class="grid-filtros">
                    <div class="filtro-item">
                        <span class="label">Origen:</span>
                        <span class="valor"><?= $origen ?></span>
                    </div>
                    <div class="filtro-item">
                        <span class="label">Destino:</span>
                        <span class="valor"><?= $destino ?></span>
                    </div>
                    <div class="filtro-item">
                        <span class="label">Fecha de salida:</span>
                        <span class="valor"><?= $fecha_salida ?></span>
                    </div>
                    <div class="filtro-item">
                        <span class="label">Pasajeros:</span>
                        <span class="valor"><?= $pasajeros ?></span>
                    </div>
                </div>
            </div>

            <div class="sugerencias">
                <h3>¿Qué puedes hacer?</h3>
                <ul>
                    <li>Intenta cambiar la fecha de salida</li>
                    <li>Prueba con otros destinos</li>
                    <li>Verifica que el origen y destino sean diferentes</li>
                    <li>Aumenta la flexibilidad de tus fechas</li>
                </ul>
            </div>

            <div class="acciones">
                <a href="buscarVuelos.php" class="btn-principal">
                    <span>Realizar nueva búsqueda</span>
                </a>
                <form method="post" action="seleccionarVuelo.php" class="form-retener-filtros">
                    <input type="hidden" name="origen" value="<?= htmlspecialchars($origen) ?>">
                    <input type="hidden" name="destino" value="<?= htmlspecialchars($destino) ?>">
                    <input type="hidden" name="fecha_salida" value="<?= htmlspecialchars($fecha_salida) ?>">
                    <input type="hidden" name="pasajeros" value="<?= htmlspecialchars($pasajeros) ?>">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
