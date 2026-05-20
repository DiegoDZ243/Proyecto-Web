<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Buscar Vuelos</title>
</head>
<body>
    <main class="fondo-buscador">        
        <form class="contenedor-buscador">
            <div class="parte-superior">
                <div class="contendor-ubicaciones">
                    <div class="contenedor-lugar">
                        <img src="icn-ubicacion" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Origen</label>
                            <select name="origen"></select>
                        </div>
                    </div>
                    <div class="contenedor-lugar">
                        <img src="icn-ubicacion" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Destino</label>
                            <select name="destino"></select>
                        </div>
                    </div>
                </div>
                <div class="contenedor-salida">
                    <div class="contenedor-fecha">
                        <img src="icn-salida" alt="salida">
                        <div class="contenedor-input-fecha">
                            <label>Salida</label>
                            <input type="date" name="fecha_salida">
                        </div>
                    </div>
                </div>
            </div>
            <div class="parte-inferior">
                <button id="btn-buscar-vuelo">
                    <div class="interior-boton-buscar">
                        <p>Buscar vuelos</p>
                        <img src="icn-avion" alt="avion">
                    </div>
                </button>
            </div>
        </form>    
    </main>

    <!-- Dashborad de los vuelos con el precio más bajo -->
    <section class="dashboard-vuelos-baratos">
        <h1>Vuelos baratos</h1>
        <div class="contenedor-tarjetas-vuelos">
            <div class="tarjeta-vuelo">
                <div class="contenedor-origen-destino">
                    <h4 id="origen"></h4>
                    <h4> a </h4>
                    <h4 id="destino"></h4>
                </div>

                <div class="contenedor-mas-info">
                    <div class="contendor-precio">
                        <h5>Desde</h5>
                        <h3 id="precio"></h3>
                        <h5>Por persona</h5>
                    </div>
                    <div class="contendor-fecha">
                        <h5 id="fecha"></h5>
                    </div>
                </div>

            </div>
        </div>  
    </section>

</body>
</html>