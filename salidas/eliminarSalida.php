<?php 
	$id = isset($_GET['id']) ? intval($_GET['id']) : null;

	if (!$id) {
		header('Location: salidas.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Confirmar eliminación</title>
	<link rel="stylesheet" href="css/eliminarSalida.css">
</head>
<body>

	<div class="contenedor-confirmacion">

		<div class="contenedor-icono">
			<img src="img/icn_eliminar.png" alt="Eliminar">
		</div>

		<div class="contenedor-texto">
			<h1>¿Eliminar salida?</h1>

			<p>
				La salida seleccionada será eliminada permanentemente.
				Esta acción no se puede deshacer.
			</p>
		</div>

		<form method="post" action="delete.php" class="formulario-eliminar">

			<input 
				type="hidden" 
				name="id_vuelo" 
				value="<?= $id ?>"
			>

			<div class="contenedor-botones">

				<button 
					type="submit" 
					class="btn-eliminar"
				>
					Sí, eliminar
				</button>

				<a 
					href="salidas.php" 
					class="btn-cancelar"
				>
					Cancelar
				</a>

			</div>

		</form>

	</div>

</body>
</html>