<?php
    session_start(); 
    // Dirección de la api
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require("api/classEmpleado.php"); 
    // Nombre de la clase dentro de la api
    $claseEmpleados=new empleado(); 

    // Uso de la api para obtener el empleado con GET["id"] que es el que se manda a la url

    $empleadoActual=$claseEmpleados->getEmpleadoById($_GET["id"]);
    $listaJefes=$claseEmpleados->getNombresEmpleados($_SESSION["usuario_id"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="css/editarEmpleados.css">
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

<h2>Editar Empleado</h2>

<div class="fondo-formulario">
        <form action="guardarActualizacion.php" method="POST" id="formulario-empleado">
            <input name="id_empleado" value="<?= $empleadoActual["id_empleado"] ?>" hidden>
            <div class="contenedor-error" id="contenedor-error" hidden>
                <img src="img/icn-error.png" alt="Error">
                <p id="texto-error"></p>
            </div>
            <div class="input-nombre">
                <label for="nombre">Nombre: </label>
                <input type="text" value="<?= $empleadoActual["nombre"] ?>" name="nombre" placeholder="Nombre">
            </div>
            <div class="input-paterno">
                <label for="apellidoPat">Apellido paterno: </label>
                <input type="text" value="<?= $empleadoActual["a_paterno"] ?>" name="apellidoPat" placeholder="Apellido paterno">
            </div>
            <div class="input-materno">
                <label for=apellidoMat>Apellido materno: </label>
                <input type="text" value="<?= $empleadoActual["a_materno"] ?>" name="apellidoMat" placeholder="Apellido Materno">
            </div>
            <div class="input-salario">
                <label for="salario">Salario: </label>
                <input type="number" value="<?= $empleadoActual["sueldo"] ?>" name="salario" placeholder="Salario">
            </div>
            <div class="input-hora-entrada">
                <label for="hora_entrada">Hora de entrada: </label>
                <input type="time" value="<?= $empleadoActual["hora_entrada"] ?>" name="hora_entrada">
            </div>
            <div class="input-hora-salida">
                <label for="hora_salida">Hora de salida: </label>
                <input type="time" value="<?= $empleadoActual["hora_salida"] ?>" name="hora_salida">
            </div>
            <div class="input-jefe">
                <select name="id_jefe">
                    <option value="">Elige el jefe del empleado</option>

                    <?php foreach($listaJefes as $j): ?>
                        <option 
                            value="<?= $j["id_jefe"] ?>" 
                            <?= ($empleadoActual["id_jefe"] == $j["id_jefe"]) ? 'selected' : '' ?>
                        >
                            <?= $j["nombreCompleto"] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input-correo">
                <label for="correo">Email: </label>
                <input type="email" value="<?= $empleadoActual["correo"] ?>" name="email">
            </div>
            <div class="input-pass">
                <label for="pass">Contraseña: </label>
                <input type="password" value="<?= $empleadoActual["password"] ?>"  name="pass">
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