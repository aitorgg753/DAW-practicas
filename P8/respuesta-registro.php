<?php 

    include_once("inc/funciones.php");
    session_start();

    $errores = $_SESSION['flash_errores'];
    $datos = $_SESSION['flash_datos'];
    unset($_SESSION['flash_errores']);
    unset($_SESSION['flash_datos']);
    
    if (!empty($errores)) {
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Error en el registro</title>
            <link href="css/global.css" rel = "stylesheet">
            <link href="css/respuesta-folleto.css" rel = "stylesheet">
            <?php include_once("inc/css.inc.php"); ?>
        </head>
        <body>
            <main>
                <section>
                    <h2 id = "textoError">Se han encontrado errores en tu registro:</h2>
                        <ul>
                            <?php foreach ($errores as $error): ?>
                                <li><?= e($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <p><a href="registro.php">Volver al formulario</a></p>
                </section>
            </main>
        </body>
    </html>
    <?php
    exit; // Detiene la ejecución para que no muestre el HTML de éxito
    }
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro completado - PI Pisos e Inmuebles</title>
    <?php include_once("inc/css.inc.php"); ?>
</head>
<body>
    <main>
        <section>
            <h2>Registro completado con éxito</h2>
            <p>Estos son los datos que has introducido:</p>
            <ul>
                <li>Usuario: <?= e($datos[0]) ?></li>
                <li>Email: <?= e($datos[2]) ?></li>
                <li>Contraseña: <?= e($datos[1]) ?></li>
                <li>Sexo: <?= e($datos[3]) ?></li>
                <li>Fecha de nacimiento: <?= e($datos[4]) ?></li>
                <li>Ciudad: <?= e($datos[5]) ?></li>
                <li>País: <?= e($datos[6]) ?></li>
            </ul>
            <p><a href="indexSesionIni.php">Ir al inicio</a></p>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>