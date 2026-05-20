<?php
    $boletos = $_POST['boletos'];

    foreach ($boletos as $b) {
        echo "Asiento: " . $b['asiento'] . "<br>";
        echo "Nombre: " . $b['nombre'] . "<br>";
        echo "Apellido Paterno: " . $b['a_paterno'] . "<br>";
        echo "Apellido Materno: " . $b['a_materno'] . "<br>";
        echo "Vuelo: " . $b['vuelo'] . "<br>";
        echo "<hr>";
    }
?>