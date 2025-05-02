<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            height: 100vh; /* Ocupa toda la altura de la ventana */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Centra verticalmente */
            align-items: center; /* Centra horizontalmente */
            background-image: url('fondorestaurante1.png'); /* Imagen de fondo */
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita la repetición de la imagen */
        }

        h1 {
            font-size: 100px; /* Tamaño del título */
            color: #FFFFFF; /* Color del texto en blanco */
            margin: 0; /* Elimina el margen predeterminado */
            font-family: 'Bell MT', serif; /* Fuente para el título */
            font-weight: bold; /* Negrita para el título */
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); /* Sombra para el efecto 3D */
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro semitransparente */
            padding: 20px 40px; /* Espaciado interno */
            border: 2px solid #FFFFFF; /* Borde blanco */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.7); /* Sombra del recuadro */
            transition: all 0.3s ease; /* Transición suave */
        }

        /* Efecto al pasar el mouse sobre el título */
        h1:hover {
            text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.7); /* Sombra más grande */
            transform: scale(1.05); /* Aumenta ligeramente el tamaño del título */
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.9); /* Sombra más pronunciada */
        }

        nav {
            display: flex; /* Utiliza flexbox para alinear los botones en una fila */
            gap: 15px; /* Espacio entre los botones */
            margin-top: 20px; /* Espacio arriba del menú */
        }

        /* Estilos de los botones con efecto 3D */
        a {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5em;
            text-decoration: none;
            color: #FFFFFF;
            padding: 15px 30px;
            background-color: #000000;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.4); /* Sombra para efecto 3D */
            transition: all 0.3s ease; /* Transición suave para los efectos */
            transform: translateY(0); /* Estado inicial del botón */
        }

        /* Efecto al pasar el mouse sobre los botones */
        a:hover {
            background-color: #f0f0f0;
            color: #000000;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.5); /* Sombra más grande */
            transform: translateY(-5px); /* El botón se eleva un poco */
        }

        /* Efecto al hacer clic en los botones */
        a:active {
            box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.3); /* Sombra reducida al hacer clic */
            transform: translateY(2px); /* Se hunde un poco al hacer clic */
        }

        /* Estilo para el reloj con efecto 3D */
        #reloj {
            font-size: 2em; /* Tamaño del reloj */
            color: #FFFFFF; /* Color del texto */
            margin-top: 20px; /* Margen superior */
            padding: 15px 30px; /* Espaciado interno */
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro semitransparente */
            border: 2px solid #FFFFFF; /* Borde blanco */
            border-radius: 15px; /* Bordes redondeados */
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.7); /* Sombra del contenedor */
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5); /* Sombra para el texto */
            transition: all 0.3s ease; /* Transición suave */
        }

        /* Efecto al pasar el mouse sobre el reloj */
        #reloj:hover {
            text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.7); /* Sombra más grande */
            transform: scale(1.05); /* El reloj crece ligeramente */
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.9); /* Sombra más pronunciada */
        }
    </style>
</head>

<body>
    <header>
        <h1>EL ARTE CULINARIO</h1>
    </header>
    
    <nav>
        <a href="staff/login.php">EMPLEADO</a>
        <a href="admin/login.php">ADMINISTRADOR</a>
    </nav>

    <!-- Contenedor del reloj con efecto 3D -->
    <div id="reloj">
        <!-- Mostrar la fecha y la hora actual -->
        <?php
        // Fecha actual en formato legible
        echo date('d-m-Y H:i:s');
        ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <script>
        // Función para actualizar la hora en tiempo real
        function actualizarReloj() {
            const ahora = new Date();
            const fecha = ahora.toLocaleDateString(); // Formato de fecha
            const hora = ahora.toLocaleTimeString();  // Formato de hora
            document.getElementById('reloj').innerHTML = `${fecha} ${hora}`;
        }

        // Actualiza el reloj cada segundo
        setInterval(actualizarReloj, 1000);
    </script>
</body>

</html>





