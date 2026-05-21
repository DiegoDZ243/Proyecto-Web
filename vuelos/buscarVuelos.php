<?php
    require('api/classInfoVuelos.php'); 
    $vuelos=new vuelos(); 
    $listaVuelosBaratos=$vuelos->getVuelosBaratos(); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Buscar Vuelos</title>
    <link rel="stylesheet" href="css/buscarVuelos.css">
</head>
<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contendor-logo">
                <h5>AeroPHP</h5>
                <img alt="logo aeropuerto">
            </div>
            <div class="contendor-enlaces">
                <a>Mis boletos</a>
                <a>
                    <img alt="iconoUsuario">
                    <h5>Mi cuenta</h5>
                </a>
            </div>
        </div>
    </section>
    <main class="fondo-buscador">        
        <form class="contenedor-buscador">
            <div class="parte-superior">
                <div class="contendor-ubicaciones">
                    <div class="contenedor-lugar">
                        <img src="img/icn-destino.png" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Origen</label>
                            <select name="origen"></select>
                        </div>
                    </div>
                    <div class="contenedor-lugar">
                        <img src="img/icn-destino.png" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Destino</label>
                            <select name="destino"></select>
                        </div>
                    </div>
                </div>
                <div class="contenedor-salida">
                    <div class="contenedor-fecha">
                        <img src="img/icn-salida.png" alt="salida">
                        <div class="contenedor-input-fecha">
                            <label>Salida</label>
                            <input type="date" name="fecha_salida">
                        </div>
                    </div>
                </div>
                <div class="contenedor-pasajeros">
                    <div class="contenedor-clientes">
                        <img src="img/icn-pasajero.png" alt="salida">
                        <div class="contenedor-input-pasajero">
                            <label>Pasajeros</label>
                            <input type="number" name="pasajeros">
                        </div>
                    </div>
                </div>
            </div>
            <div class="parte-inferior">
                <button id="btn-buscar-vuelo">
                    <div class="interior-boton-buscar">
                        <p>Buscar vuelos</p>
                        <img src="img/icn-avion.png" alt="avion">
                    </div>
                </button>
            </div>
        </form>    
    </main>

   
        <!-- Dashborad de los vuelos con el precio más bajo -->
        <section class="dashboard-vuelos-baratos">
            <h1>Vuelos baratos</h1>

            <div class="contenedor-tarjetas-vuelos" >
                 <?php foreach($listaVuelosBaratos as $v):?>
                <div class="tarjeta-vuelo" style="background-image: url('<?= htmlspecialchars($v["imagen"]) ?>');">
                    <div class="contenedor-origen-destino">
                        <h4 id="origen"><?= $v["origen"] ?></h4>
                        <h4> a </h4>
                        <h4 id="destino"><?= $v["destino"] ?></h4>
                    </div>

                    <div class="contenedor-mas-info">
                        <div class="contendor-precio">
                            <h5>Desde</h5>
                            <h3 id="precio"><?= $v["precio"] ?><p>MXN</p></h3>
                            <h5>Por persona</h5>
                        </div>
                        <div class="contendor-fecha">
                            <h5>Fecha</h5>
                            <h3 id="fecha"><?= $v["fecha"] ?></h3>
                        </div>
                        <div class="contendor-hora">
                            <h5>Salida</h5>
                            <h3 id="salida"><?= $v["hora"] ?></h3>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>  
        </section>
    
</body>
</html>