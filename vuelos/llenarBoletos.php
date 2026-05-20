<?php
    $asientos = explode(",", $_POST["asientos"]);
    $id_vuelo =$_POST['vuelo']; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boletos</title>
    <link rel="stylesheet" href="css/llenarBoletos.css">
</head>

<body>
    <form id="contenedorLlenarBoletos" method="post" action="guardar.php">
    <?php 
        $i = 0; 
        foreach ($asientos as $asiento): ?>

        <section class="cuerpo-llenar-boletos">
            <div class="contenedor-llenado">
                <div class="formulario-cliente">
                    <input type="hidden" name="boletos[<?= $i ?>][asiento]" value="<?= $asiento ?>">
                    <input type='text' name="boletos[<?= $i ?>][vuelo]" value="<?= $id_vuelo ?>" hidden>

                    <div class="contenedor-input">
                        <label>Nombre</label>
                        <input type="text" name="boletos[<?= $i ?>][nombre]" id="nombre-<?= $asiento ?>">
                    </div>

                    <div class="contenedor-input">
                        <label>Apellido Paterno</label>
                        <input type="text" name="boletos[<?= $i ?>][a_paterno]" id="a_paterno-<?= $asiento ?>">
                    </div>

                    <div class="contenedor-input">
                        <label>Apellido Materno</label>
                        <input type="text" name="boletos[<?= $i ?>][a_materno]" id="a_materno-<?= $asiento ?>">
                    </div>

                </div>

                <div class="boleto">
                    <div class="encabezado-boleto">
                        <div class="contenedor-encabezado">
                            <h4 class="pase-abordaje">Pase de Abordaje</h4>
                            <img src="avion.png" alt="avion">
                        </div>
                        <div class="contenedor-nombre-aerolinea">
                            <h3 class="nombre-aerolinea">AeroPHP</h3>
                            <img src="logo.png" alt="logo">
                        </div>
                    </div>

                    <div class="cuerpo-boleto">
                        <section class="contenedor-nombre">
                            <h3>Nombre del pasajero:</h3>
                            <h4 id="txt_nombre-<?= $asiento ?>"></h4>
                        </section>
                        <section class="contenedor-codigo-barras">
                            <img src="barcode.png" alt="barcode">
                        </section>
                    </div>

                    <div class="pie-boleto">
                        <div class="contenedor-destino">
                            <h3>Destino:</h3>
                            <h5></h5>
                        </div>
                        <div class="contenedor-fecha-y-hora">
                            <div class="contenedor-fecha">
                                <h3>Fecha:</h3>
                                <h5></h5>
                            </div>
                            <div class="contenedor-hora">
                                <h3>Hora:</h3>
                                <h5></h5>
                            </div>
                        </div>
                        <div class="contenedor-asiento">
                            <h3>Asiento: <?= $asiento ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php
        //Fin del ciclo y aumento de númeración
        $i++;
    endforeach; ?>
        <button type="submit" style="margin: 20px; padding: 10px 20px;">
            Guardar boletos
        </button>
    </form>
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

            const nombreCompleto=nombre.value.trim()+" "+a_paterno.value.trim()+ " "+a_materno.value.trim(); 
            const nombreActualizado=document.getElementById(`txt_nombre-${asiento}`);
            nombreActualizado.innerText=nombreCompleto;
        }
    </script>
    </body>
</html>