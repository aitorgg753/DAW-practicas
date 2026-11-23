<?php
// CONTROL DE ACCESO
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();

$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$mensajeUltimaVisita = (esta_recordado() && !empty($_SESSION['ultima_visita'])) ? obtener_mensaje_ultima_visita() : '';
session_write_close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de usuario - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menu-usuario.css">
    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <?php include_once("inc/headerSesIni.inc.php"); ?>
    <main>
        <section>
            <h2>Mi perfil</h2>
            <p><?= e(obtener_saludo($nombre)) ?></p>
            <?php if (!empty($mensajeUltimaVisita)): ?>
                <p><small><?= e($mensajeUltimaVisita) ?></small></p>
            <?php endif; ?>

            <ul>
                <li><a href="error.php">Mis datos</a></li>
                <li><a href="error.php">Darme de baja</a></li>
                <li><a href="misAnuncios.php">Mis anuncios</a></li>
                <li><a href="crearAnuncio.php">Crear anuncio nuevo</a></li>
                <li><a href="mensajes.php">Mis mensajes</a></li>
                <li><a href="folleto.php">Solicitar folleto publicitario</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
