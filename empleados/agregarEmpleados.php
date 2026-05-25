<?php
    session_start(); 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('api/classEmpleado.php'); 
    $empleado=new empleado();
    $empleadoActual=$empleado->getEmpleadoById($_SESSION["usuario_id"]); 
    $listEmpleados=$empleado->getEmpleados(); 
    $listaJefes=$empleado->getNombresEmpleados($_SESSION["usuario_id"]);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados Aeropuerto</title>
    <link rel="stylesheet" href="css/Empleados.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
</head>
<body>
    <div class="navbar">
        <div>
            <a href="consultarEmpleados.php"><img src="img/icn-regresar.png"> Regresar</a>
            <h1>🛫 AeroPHP - Panel de Empleado</h1>
        </div>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="../logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
    <h1>Agregar Empleado</h1>
    <div class="fondo-formulario">
        <form action="guardarEmpleado.php" method="POST" id="formulario-empleado">
            <div class="contenedor-error" id="contenedor-error" hidden>
                <img src="img/icn-error.png" alt="Error">
                <p id="texto-error"></p>
            </div>
            <div class="input-nombre">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" placeholder="Nombre">
            </div>
            <div class="input-paterno">
                <label for="apellidoPat">Apellido paterno: </label>
                <input type="text" name="apellidoPat" placeholder="Apellido paterno">
            </div>
            <div class="input-materno">
                <label for=apellidoMat>Apellido materno: </label>
                <input type="text" name="apellidoMat" placeholder="Apellido Materno">
            </div>
            <div class="input-salario">
                <label for="salario">Salario: </label>
                <input type="number" name="salario" placeholder="Salario">
            </div>
            <div class="input-hora-entrada">
                <label for="hora_entrada">Hora de entrada: </label>
                <input type="time" name="hora_entrada">
            </div>
            <div class="input-hora-salida">
                <label for="hora_salida">Hora de salida: </label>
                <input type="time" name="hora_salida">
            </div>
            <div class="input-jefe">
                <select name="id_jefe">
                    <option value="">Elige el jefe del empleado</option>
                    <?php foreach($listaJefes as $j): ?>
                        <option value="<?= $j["id_jefe"] ?>"><?= $j["nombreCompleto"] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input-correo">
                <label for="correo">Email: </label>
                <input type="email" name="email">
            </div>
            <div class="input-pass">
                <label for="pass">Contraseña: </label>
                <input type="password" name="pass">
            </div>
            <button type="submit">
                Guardar
            </button>

        </form>
    </div>
    <script>
    const formulario = document.getElementById("formulario-empleado");
    const contenedorError = document.getElementById("contenedor-error");
    const textoError = document.getElementById("texto-error");

    contenedorError.style.display = "none";

    formulario.addEventListener("submit", function(e){
        const campos = [
            { name: "nombre", mensaje: "El nombre es obligatorio" },
            { name: "apellidoPat", mensaje: "El apellido paterno es obligatorio" },
            { name: "apellidoMat", mensaje: "El apellido materno es obligatorio" },
            { name: "salario", mensaje: "El salario es obligatorio" },
            { name: "hora_entrada", mensaje: "La hora de entrada es obligatoria" },
            { name: "hora_salida", mensaje: "La hora de salida es obligatoria" },
            { name: "id_jefe", mensaje: "Debe seleccionar un jefe" },
            { name: "email", mensaje: "El correo es obligatorio" },
            { name: "pass", mensaje: "La contraseña es obligatoria" }
        ];

        let hayError = false;

        for(const campo of campos){
            const input = formulario.elements[campo.name];

            if(input.value.trim() === ""){
                e.preventDefault();

                textoError.textContent = campo.mensaje;
                contenedorError.hidden = false;
                contenedorError.style.display = "flex";

                input.focus();

                contenedorError.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });

                hayError = true;
                break;
            }
        }

        if(!hayError){
            contenedorError.hidden = true;
            contenedorError.style.display = "none";
        }
    });
</script>
</body>
</html> 