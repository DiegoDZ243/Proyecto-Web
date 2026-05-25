<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('api/classEmpleado.php'); 
    $empleado=new empleado();
    $empleadoActual=$empleado->getEmpleadoById(1); 
    $listEmpleados=$empleado->getEmpleados(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados Aeropuerto</title>
    <link rel="stylesheet" href="css/Empleados.css">
</head>
<body>

    <h1>Agregar Empleado</h1>

    <form action="guardarEmpleado.php" method="POST">

        <input type="text" name="nombre" placeholder="Nombre">

        <input type="text" name="apellidoPat" placeholder="Apellido paterno">

        <input type="text" name="apellidoMat" placeholder="Apellido Materno">

        <input type="number" name="salario" placeholder="Salario">

        <label for="hora_entrada">Hora de entrada: </label>
        <input type="time" name="hora_entrada">

        <label for="hora_salida">Hora de salida: </label>
        <input type="time" name="hora_salida">

        <select vale="1" name="id_jefe">
            <option>Lista de jefes</option disabled>
        </select>

        <label for="correo">Email: </label>
        <input type="email" name="email">

        <label for="pass">Email: </label>
        <input type="password" name="pass">

        <button type="submit">
            Guardar
        </button>

    </form>

    <hr>

    <h2>Lista de empleados</h2>

    <table border="1" id="tblRegistros">

        <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Sueldo</th>
        <th>Hora Entrada</th>
        <th>Hora Salida</th>
        <th>ID Jefe</th>
        </tr>


        

    </table>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
                // EMPLEADO ACTUAL
            let empleadoActual = <?php echo json_encode($empleadoActual); ?>;

            console.log(empleadoActual);

            let listaEmpleados = <?php echo json_encode($listEmpleados); ?>;


            console.log(listaEmpleados);

            let tabla = document.getElementById("tblRegistros");

            for(let i = 0; i < listaEmpleados.length; i++){
                let empleado = listaEmpleados[i];
                    
                console.log(empleado.nombre);
                
                let fila = `
                    <tr>
                    <td>${empleado.id_empleado}</td>
                    <td>${empleado.nombre}</td>
                    <td>${empleado.a_paterno}</td>
                    <td>${empleado.a_materno}</td>
                    <td>${empleado.sueldo}</td>
                    <td>${empleado.hora_entrada}</td>
                    <td>${empleado.hora_salida}</td>
                    <td>${empleado.id_jefe}</td>
                    </tr>
                    `;
                tabla.innerHTML += fila;
            }
        });
    </script>
</body>
</html> 