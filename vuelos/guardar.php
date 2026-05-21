<?php
    $boletos = $_POST['boletos'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Confirmada</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            background: #f4f7fb;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .contenedor-confirmacion{
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .encabezado{
            text-align: center;
            margin-bottom: 35px;
        }

        .encabezado h1{
            color: #16a34a;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .encabezado p{
            color: #6b7280;
            font-size: 1rem;
        }

        .lista-boletos{
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .boleto{
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 25px;
            transition: 0.25s ease;
        }

        .boleto:hover{
            border-color: #2563eb;
            transform: translateY(-3px);
        }

        .boleto h3{
            color: #2563eb;
            margin-bottom: 18px;
            font-size: 1.3rem;
        }

        .info{
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
            gap: 15px;
        }

        .campo{
            background: #f9fafb;
            padding: 14px;
            border-radius: 12px;
        }

        .campo span{
            display: block;
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .campo p{
            color: #111827;
            font-weight: bold;
        }

        .contenedor-boton{
            margin-top: 35px;
            text-align: center;
        }

        .btn-regresar{
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-regresar:hover{
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        @media(max-width:768px){

            .contenedor-confirmacion{
                padding: 25px;
            }

            .encabezado h1{
                font-size: 1.8rem;
            }
        }

    </style>
</head>
<body>

    <section class="contenedor-confirmacion">

        <div class="encabezado">
            <h1>✅ Compra Confirmada</h1>
            <p>Tus boletos han sido registrados correctamente.</p>
        </div>

        <div class="lista-boletos">

            <?php foreach ($boletos as $index => $b): ?>

                <div class="boleto">

                    <h3>Boleto <?= $index + 1 ?></h3>

                    <div class="info">

                        <div class="campo">
                            <span>Asiento</span>
                            <p><?= $b['asiento'] ?></p>
                        </div>

                        <div class="campo">
                            <span>Nombre Completo</span>
                            <p>
                                <?= $b['nombre'] ?>
                                <?= $b['a_paterno'] ?>
                                <?= $b['a_materno'] ?>
                            </p>
                        </div>

                        <div class="campo">
                            <span>Vuelo</span>
                            <p><?= $b['vuelo'] ?></p>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="contenedor-boton">
            <a href="buscarVuelos.php" class="btn-regresar">
                Buscar más vuelos
            </a>
        </div>

    </section>

</body>
</html>