<?php
    session_start(); 
    $asientos = explode(",", $_POST["asientos"]);
    $id_vuelo =$_POST['vuelo']; 
    require("api/classVuelo.php"); 
    $vueloActual=new vuelo($id_vuelo); 
    $infoVuelo=$vueloActual->getInfo(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Llenar Boletos</title>
    <link rel="stylesheet" href="css/llenarBoletos.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css"> 
</head>

<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contenedor-volver-menu">
                <a href="seleccionarAsientos.php">
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
                <a href="mis_boletos.php">Mis boletos</a>
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

    <main class="contenedor-llenar-boletos">
        <div class="encabezado-seccion">
            <h1>Completa los datos de los pasajeros</h1>
            <p>Por favor, ingresa la información de cada pasajero para completar tus boletos</p>
        </div>

        <form id="contenedorLlenarBoletos" method="post" action="guardar.php" class="formulario-boletos">
        <?php 
            $i = 0; 
            foreach ($asientos as $asiento): ?>

            <section class="cuerpo-llenar-boletos">
                <div class="contenedor-llenado">
                    <div class="formulario-cliente" id="<?=$asiento ?>" >
                        <div class="encabezado-formulario">
                            <div class="badge-asiento">
                                Asiento <strong><?= htmlspecialchars($asiento) ?></strong>
                            </div>
                        </div>

                        <input type="hidden" name="boletos[<?= $i ?>][asiento]" value="<?= htmlspecialchars($asiento) ?>">
                        <input type='text' name="boletos[<?= $i ?>][vuelo]" value="<?= htmlspecialchars($id_vuelo) ?>" hidden>
                        
                        <div class="error-message" id="error-<?= htmlspecialchars($asiento) ?>" style="display: none;">
                            <span class="error-icon">⚠️</span>
                            <p id="error-text-<?= htmlspecialchars($asiento) ?>"></p>
                        </div>

                        <div class="contenedor-input">
                            <label for="nombre-<?= htmlspecialchars($asiento) ?>">Nombre <span class="asterisco">*</span></label>
                            <input type="text" name="boletos[<?= $i ?>][nombre]" id="nombre-<?= $asiento ?>" placeholder="Ingresa tu nombre" class="input-field">
                        </div>

                        <div class="contenedor-input">
                            <label for="a_paterno-<?= htmlspecialchars($asiento) ?>">Apellido Paterno <span class="asterisco">*</span></label>
                            <input type="text" name="boletos[<?= $i ?>][a_paterno]" id="a_paterno-<?= $asiento ?>" placeholder="Ingresa tu apellido paterno" class="input-field">
                        </div>

                        <div class="contenedor-input">
                            <label for="a_materno-<?= htmlspecialchars($asiento) ?>">Apellido Materno <span class="asterisco">*</span></label>
                            <input type="text" name="boletos[<?= $i ?>][a_materno]" id="a_materno-<?= $asiento?>" placeholder="Ingresa tu apellido materno" class="input-field">
                        </div>
                    </div>

                    <div class="boleto">
                        <div class="encabezado-boleto">
                            <div class="contenedor-encabezado">
                                <h4 class="pase-abordaje">Pase de Abordaje</h4>
                                <img src="img/icn-avion.png" alt="avion">
                            </div>
                            <div class="contenedor-nombre-aerolinea">
                                <h3 class="nombre-aerolinea">AeroPHP</h3>
                                <img src="img/icn-logo.png" alt="logo">
                            </div>
                        </div>

                        <div class="cuerpo-boleto">
                            <section class="contenedor-nombre">
                                <h3>Pasajero:</h3>
                                <h4 id="txt_nombre-<?= htmlspecialchars($asiento) ?>">-</h4>
                            </section>
                            <section class="contenedor-codigo-barras">
                                <div class="barcode-placeholder">
                                    <img src="img/icn-vuelo.png" alt="barcode" style="width: 60px; opacity: 0.3;">
                                </div>
                            </section>
                        </div>

                        <div class="pie-boleto">
                            <div class="contenedor-origen-destino">
                                <div class="contenedor-origen">
                                    <h3>Origen:</h3>
                                    <h5><?= htmlspecialchars($infoVuelo["origen"]) ?></h5>
                                </div>
                                <div class="contenedor-destino">
                                    <h3>Destino:</h3>
                                    <h5><?= htmlspecialchars($infoVuelo["destino"]) ?></h5>
                                </div>
                            </div>
                            <div class="contenedor-fecha-y-hora">
                                <div class="contenedor-fecha">
                                    <h3>Fecha:</h3>
                                    <h5><?= htmlspecialchars($infoVuelo["fecha"]) ?></h5>
                                </div>
                                <div class="contenedor-hora">
                                    <h3>Hora:</h3>
                                    <h5><?= htmlspecialchars($infoVuelo["hora"]) ?></h5>
                                </div>
                            </div>
                            <div class="contenedor-asiento">
                                <h3>Asiento: <strong><?= htmlspecialchars($asiento) ?></strong></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php
            $i++;
        endforeach; ?>

            <div class="contenedor-boton-guardar">
                <button type="submit" id="btn-boletos" class="btn-guardar-boletos">
                    <span>Guardar boletos</span>
                    <span class="icono-boton">→</span>
                </button>
            </div>
        </form>
    </main>

    <script src="scripts/llenarBoletos.js"></script>
    <script>
        const asientosElegidos=<?php echo json_encode($asientos) ?>;

        for(let i=0;i<asientosElegidos.length;i++){
            const asiento=asientosElegidos[i]; 
            const nombre=document.getElementById(`nombre-${asiento}`); 
            const a_paterno=document.getElementById(`a_paterno-${asiento}`); 
            const a_materno=document.getElementById(`a_materno-${asiento}`); 
            nombre.addEventListener('input',()=>concatenar(asiento)); 
            a_paterno.addEventListener('input',()=>concatenar(asiento)); 
            a_materno.addEventListener('input',()=>concatenar(asiento)); 
        }

        function concatenar(asiento){
            const nombre=document.getElementById(`nombre-${asiento}`); 
            const a_paterno=document.getElementById(`a_paterno-${asiento}`); 
            const a_materno=document.getElementById(`a_materno-${asiento}`); 
            const errorContainer=document.getElementById(`error-${asiento}`); 
            const errorText=document.getElementById(`error-text-${asiento}`);

            if(!nombre.value.trim()){
                errorContainer.style.display="flex"; 
                errorText.innerText="Por favor completa tu nombre"; 
            }else if(!a_paterno.value.trim()){
                errorContainer.style.display="flex"; 
                errorText.innerText="Por favor completa tu apellido paterno"; 
            }else if(!a_materno.value.trim()){
                errorContainer.style.display="flex"; 
                errorText.innerText="Por favor completa tu apellido materno"; 
            }else{
                errorContainer.style.display="none"; 
            }
            const nombreCompleto=nombre.value.trim()+" "+a_paterno.value.trim()+ " "+a_materno.value.trim(); 
            const nombreActualizado=document.getElementById(`txt_nombre-${asiento}`);
            nombreActualizado.innerText=nombreCompleto;
        }
    </script>
</body>
</html>