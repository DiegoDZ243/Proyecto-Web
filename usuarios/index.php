<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios</title>
    <link rel="stylesheet" href="css/usuarios.css">

    <!-- ICONOS -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <!-- HEADER -->
    <header class="header">

        <div class="logo">

            <div class="logo-icono">
                <i class="fa-solid fa-users"></i>
            </div>

            <div>
                <h2>Usuarios</h2>
                <p>Sistema de Gestión</p>
            </div>

        </div>

        <div class="usuario">
            <i class="fa-regular fa-circle-user"></i>
            Administrador
        </div>

    </header>

    <!-- CONTENIDO -->
    <div class="hero">

        <span class="badge">
            BIENVENIDO
        </span>

        <h1>
            Sistema de Gestión de Usuarios
        </h1>

        <p class="descripcion">
            Administra, visualiza y controla la información de los usuarios
        </p>

        <div class="linea"></div>

        <!-- TARJETAS -->
        <div class="cards">

            <!-- CARD AGREGAR -->
            <div class="card">

                <div class="icono azul">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h3>Agregar Usuario</h3>

                <p>
                    Registra un nuevo usuario en el sistema.
                </p>

                <a href="agregar.php">
                    <button class="btn-azul">
                        Agregar Usuario
                    </button>
                </a>

            </div>

            <!-- CARD MOSTRAR -->
            <div class="card">

                <div class="icono verde">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>Mostrar Usuarios</h3>

                <p>
                    Visualiza la lista completa de usuarios registrados.
                </p>

                <a href="mostrar.php">
                    <button class="btn-verde">
                        Mostrar Usuarios
                    </button>
                </a>

            </div>

        </div>

    </div>

</body>
</html>
