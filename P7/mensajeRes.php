<?php
    function e($value) {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
    $tipo = $_POST['tipoMensaje'];
    $mensaje = $_POST['mensaje'];

    $errores = [];
    if (empty($tipo)) {
        $errores[] = "Tienes que seleccionar un tipo de mensaje";
    }

    if (empty($mensaje)) {
        $errores[] = "Tienes que escribir un mensaje";
    }

    if (!empty($errores)) {
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Errores en el formulario</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/respuesta-folleto.css">
    </head>
    <body>
        <main>
            <section>
                <h2>Errores en el formulario</h2>
                <p>Hemos encontrado los siguientes errores en el formulario:</p>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="mensaje.html">Volver a enviar mensaje</a>
             </section>
        </main>
    </body>
</html>

<?php
    exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>¡Mensaje enviado!</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/respuesta-folleto.css">

        <link rel="alternate stylesheet" type="text/css" href="css/noche.css" title="Modo noche" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="css/grande.css" title="Texto grande" media="screen" />
        <link rel="alternate stylesheet" type="text/css" href="css/contraste.css" title="Alto contraste" media="screen"/>
        <link rel="alternate stylesheet" type="text/css" href="css/contrasteGrande.css" title="Alto contraste y texto grande" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/impresion.css" media="print"/>
    </head>

    <body>
        <main>
            <section>
                <h2>¡Mensaje enviado con éxito!</h2>
                <p>Datos introducidos:</p>
                <ul>
                    <li>Tipo de mensaje: <?= e($tipo) ?></li>
                    <li>Mensaje enviado: "<?= e($mensaje) ?>"</li>
                </ul>
                <a href = "indexSesionIni.html">Volver al inicio</a>
            </section>
        </main>
        <footer>
            <p>© 2026 PI - Pisos &amp; Inmuebles | <a href="accesibilidad.html">Accesibilidad</a></p>
        </footer>
    </body>
</html>