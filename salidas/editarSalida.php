<?php
	session_start(); 
	require("api/classSalidas.php"); 
	$vuelos=new vuelos(); 
	$listaDestinos=$vuelos->getDestinos(); 

	// Precargar datos si se recibe id por GET
	$id_vuelo = isset($_GET['id']) ? intval($_GET['id']) : null;
	$selectedOrigen = null;
	$selectedDestino = null;
	$fecha = null;
	$hora = null;
	$precio = null;
	if ($id_vuelo) {
		$vuelosMas = $vuelos->getVuelosMas();
		foreach ($vuelosMas as $v) {
			if ($v['id_vuelo'] == $id_vuelo) {
				$selectedOrigen = $v['id_origen'];
				$selectedDestino = $v['id_destino'];
				$fecha = $v['fecha'];
				$hora = isset($v['hora_salida']) ? $v['hora_salida'] : (isset($v['hora']) ? $v['hora'] : null);
				$precio = $v['precio'];
				break;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Salida</title>
	<link rel="stylesheet" href="css/crearSalida.css">
	<link rel="stylesheet" href="css/barraSuperiorExt.css">
</head>
<body>
	<div class="navbar">
        <div>
            <a href="salidas.php"><img src="img/icn-regresar.png"> Regresar</a>
            <h1>🛫 AeroPHP - Panel de Empleado</h1>
        </div>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
	<div class="fondo-crear-salidas">
		<form id="formulario-salidas" method="post" action="update.php">
			<div class="contenedor-encabezado">
				<h3>Editar vuelo</h3>
				<p>Modifica los campos para actualizar la salida</p>
			</div>
			<div class="error-message" id="error-message">
				<img src="img/icn-error.png" alt="icono-error" id="imagen-error">
				<h3 id="error-text"></h3>
			</div>
			<div class="contenedor-inputs">
				<div class="contenedor-origen-destino">
					<div class="contenedor-origen">
						<label for="origen">Seleecione el origen: </label>
						<select  id="select-origen" name="origen">
							<option value="" selected disabled>Selecciona un origen</option>
							<?php foreach($listaDestinos as $d):?>
								<option value="<?= $d["id_destino"] ?>" id="<?= $d["id_destino"] ?>-org" <?= ($selectedOrigen && $selectedOrigen == $d["id_destino"]) ? 'selected' : '' ?>> <?= $d["ciudad"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="contenedor-destino">
						<label for="destino">Seleecione el destino: </label>
						<select  id="select-destino" name="destino">
							<option value="" selected disabled>Selecciona un destino</option>
							<?php foreach($listaDestinos as $d):?>
								<option value="<?= $d["id_destino"] ?>" id="<?= $d["id_destino"] ?>-dest" <?= ($selectedDestino && $selectedDestino == $d["id_destino"]) ? 'selected' : '' ?>> <?= $d["ciudad"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="contenedor-fecha-hora">
						<div class="contenedor-fecha">
							<img src="img/icn-salida.png" alt="salida">
							<div class="contenedor-input-fecha">
								<label>Salida: </label>
								<input type="date" name="fecha_salida" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+3 year')) ?>" value="<?= $fecha ?>">
							</div>
						</div>
						<div class="contenedor-hora">
							<img src="img/icn-hora.png" alt="hora">
							<div class="contenedor-input-hora">
								<label>Hora: </label>
								<input type="time" name="hora_salida" value="<?= $hora ?>">
							</div>
						</div>
					</div>
					<div class="contenedor-precio">
						<label>Precio: </label>
						<input type="number" name="precio" min="50" max="1000000" value="<?= $precio ?>">
					</div>
				</div>

			</div>
			<div class="contenedor-boton">
				<?php if ($id_vuelo): ?>
					<input type="hidden" name="id_vuelo" value="<?= $id_vuelo ?>">
				<?php endif; ?>
				<button id="btn-guardar">Guardar</button>
			</div>
		</form> 
    </div>
	<script>
		 const listaCiudadOrigen= <?php echo json_encode($listaDestinos) ?>;
			const listaCiudadDestino= <?php echo json_encode($listaDestinos)?>; 
			const selectOrigen=document.getElementById("select-origen"); 
			const selectDestino=document.getElementById("select-destino"); 
			const btnBuscar = document.getElementById("btn-guardar");
			const formulario = document.getElementById("formulario-salidas");
			const errorMessage = document.getElementById("error-message");
			const errorText = document.getElementById("error-text");

			// Función de validación
			function validarFormulario() {
				const origen = selectOrigen.value;
				const destino = selectDestino.value;
				const fecha = document.querySelector('input[name="fecha_salida"]').value;
				const hora = document.querySelector('input[name="hora_salida"]').value;
				const precio = document.querySelector('input[name="precio"]').value;

				// Ocultar mensaje de error
				ocultarError();

				// Validaciones
				if (!origen) {
					mostrarError("Por favor selecciona un origen");
					return false;
				}
				if (!destino) {
					mostrarError("Por favor selecciona un destino");
					return false;
				}
				if (!fecha) {
					mostrarError("Por favor selecciona una fecha de salida");
					return false;
				}if(!hora){
					mostrarError("Por favor selecciona una hora de salida");
					return false;
				}if(!precio){
					mostrarError("Por favor asigne un precio al vuelo");
					return false;
				}

				return true;
			}

			// Función para mostrar error
			function mostrarError(mensaje) {
				errorText.textContent = mensaje;
				errorMessage.style.display = "block";
				errorMessage.style.display = "block";
				errorMessage.scrollIntoView({ behavior: "smooth", block: "center" });
			}

			function ocultarError() {
				errorMessage.style.display = "none";
			}

			// Validar al hacer clic en el botón
			btnBuscar.addEventListener("click", (e) => {
				if (!validarFormulario()) {
					e.preventDefault();
				}
			});

			// Validar al enviar el formulario
			formulario.addEventListener("submit", (e) => {
				if (!validarFormulario()) {
					e.preventDefault();
				}
				errorMessage.hidden = true;
			});
            
			selectOrigen.addEventListener('change',(e)=>{
				if(selectOrigen.value===selectDestino.value){
					selectDestino.selectedIndex = 0;
				}
				document.querySelectorAll('#select-origen option').forEach(option=>{
					option.disabled=false;
				});
				document.querySelectorAll('#select-destino option').forEach(option=>{
					option.disabled=false;
				});
				const ciudadSeleccionada=selectOrigen.value;
				console.log(ciudadSeleccionada);
				const optionCiudad=document.getElementById(`${ciudadSeleccionada}-dest`); 
				optionCiudad.disabled=true;
				if(errorText.innerText==="Por favor selecciona un origen"){
					ocultarError();
				}
			}); 

			selectDestino.addEventListener('change',(e)=>{
				if(selectDestino.value===selectOrigen.value){
					selectOrigen.selectedIndex = 0;
				}
				document.querySelectorAll('#select-origen option').forEach(option=>{
					option.disabled=false;
				});
				document.querySelectorAll('#select-destino option').forEach(option=>{
					option.disabled=false;
				});
				const ciudadSeleccionada=selectDestino.value;
				console.log(ciudadSeleccionada);
				const optionCiudad=document.getElementById(`${ciudadSeleccionada}-org`); 
				optionCiudad.disabled=true;
				if(errorText.innerText==="Por favor selecciona un destino"){
					ocultarError();
				}
			});
	</script>

</body>
</html>
