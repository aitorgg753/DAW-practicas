<?php
// RESPUESTA DE REGISTRO
require_once(__DIR__ . '/inc/inicio_sesion.php');

$datos = flash_leer('registro_datos');
if (!is_array($datos) || empty($datos)) {
    redirigir('registro.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro completado - PI Pisos e Inmuebles</title>
    <link href="css/global.css" rel="stylesheet">
    <link href="css/respuesta-folleto.css" rel="stylesheet">  
    <?php include_once("inc/css.inc.php"); ?>
</head>
<body>
    <main>
        <section>
            <h2>Registro completado con éxito</h2>
            <p>Estos son los datos que has introducido:</p>
            <ul>
                <li>Usuario: <?= e($datos['nombre']) ?></li>
                <li>Email: <?= e($datos['email']) ?></li>
                <li>Sexo: <?= e($datos['sexo']) ?></li>
                <li>Fecha de nacimiento: <?= e($datos['fecha_nacimiento']) ?></li>
                <li>Ciudad: <?= e($datos['ciudad']) ?></li>
                <li>País: <?= e($datos['pais']) ?></li>
            </ul>
            <p><a href="index.php">Ir al inicio</a></p>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
