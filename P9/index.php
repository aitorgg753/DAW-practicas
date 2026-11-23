<?php
// INICIO DE PAGINA PRINCIPAL
require_once(__DIR__ . '/inc/inicio_sesion.php');

$mensajeError = flash_leer('error_login');
$mensajeAcceso = flash_leer('error_acceso');
$usuPrevio = flash_leer('nomUsu_previo');

$estaIdentificado = isset($_SESSION['usuario_logueado']);
$estaRecordado = esta_recordado();
$mensajeUltimaVisita = ($estaRecordado && !empty($_SESSION['ultima_visita'])) ? obtener_mensaje_ultima_visita() : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>PI - Pisos & Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <?php
    if ($estaIdentificado || $estaRecordado) {
        include_once("inc/headerSesIni.inc.php");
    } else {
        include_once("inc/headerSinSes.inc.php");
    }
    ?>
    <main>
        <h2 class="subtitulo" id="subBusqueda">Buscar vivienda</h2>

        <form id="formBusqueda" action="<?= ($estaIdentificado || $estaRecordado) ? 'listado.php' : 'listadoSinSes.php' ?>">
            <input type="text" placeholder="Ciudad, zona, código postal" class="borde" name="filtroBusqueda">
            <button type="submit">Buscar</button>
        </form>

        <?php if ($estaRecordado): ?>
            <div id="iniSes" class="tarjeta" style="margin: 20px 0; padding: 20px; border: 1px solid var(--color-borde, #ccc);">
                <h2 class="subtitulo">Sesión recordada</h2>
                <p><strong><?= e($mensajeUltimaVisita) ?></strong></p>
                <p style="margin-top: 15px;">
                    <a href="menu-usuario.php" class="boton" style="display:inline-block; padding:8px 16px; background-color:var(--color-primario, #0066cc); color:#fff; text-decoration:none; margin-right:10px; border-radius:4px;">Acceder</a>
                    <a href="logout.php" class="boton" style="display:inline-block; padding:8px 16px; background-color:#666; color:#fff; text-decoration:none; border-radius:4px;">Salir</a>
                </p>
            </div>
        <?php else: ?>
            <form id="iniSes" action="control_acceso.php" method="post" novalidate>
                <input type="hidden" name="redirigir" value="index">
                <h2 class="subtitulo">Iniciar sesión</h2>
                <p class="info-obligatorio">Los campos marcados con (*) son obligatorios.</p>

                <?php if (!empty($mensajeError)): ?>
                    <p style="color: red; font-weight: bold;"><?= e($mensajeError) ?></p>
                <?php endif; ?>

                <?php if (!empty($mensajeAcceso)): ?>
                    <p style="color: #b35900; font-weight: bold; background-color: #fff3cd; padding: 8px; border: 1px solid #ffeeba; border-radius: 4px;"><?= e($mensajeAcceso) ?></p>
                <?php endif; ?>

                <label for="nomUsu">Nombre de usuario (*)</label>
                <small class="texto-ayuda">Introduce tu nombre de usuario.</small>
                <input type="text" id="nomUsu" name="nomUsu" value="<?= e($usuPrevio) ?>">

                <label for="pwd">Contraseña (*)</label>
                <small class="texto-ayuda">Introduce tu contraseña.</small>
                <input type="password" id="pwd" name="pwd">

                <p style="margin-top: 10px;">
                    <input type="checkbox" id="recordarme" name="recordarme" value="1">
                    <label for="recordarme">Recordarme en este equipo</label>
                </p>

                <button type="submit" id="btnEntrar">Entrar</button>
            </form>
        <?php endif; ?>

        <section id="anuncios">
            <h2>Últimos anuncios publicados</h2>

            <a href="detalle.php?id=1">
                <article class="tarjeta">
                    <img src="img/foto1.jpg" alt="Anuncio 1" style="width: 400px; height: 300px;">
                    <h3>Piso en Alicante</h3>
                    <p>20 / 09 / 2025</p>
                    <p>Alicante</p>
                    <p>España</p>
                    <p>225000 €</p>
                </article>
            </a>

            <a href="detalle.php?id=2">
                <article class="tarjeta">
                    <img src="img/foto2.jpg" alt="Anuncio 2" style="width: 400px; height: 300px;">
                    <h3>Apartamento en Valladolid</h3>
                    <p>16 / 07 / 2026</p>
                    <p>Valladolid</p>
                    <p>España</p>
                    <p>600 € al mes</p>
                </article>
            </a>

            <a href="detalle.php?id=3">
                <article class="tarjeta">
                    <img src="img/foto3.jpg" alt="Anuncio 3" style="width: 400px; height: 300px;">
                    <h3>Pisito en Madrid centro</h3>
                    <p>19 / 06 / 2025</p>
                    <p>Madrid</p>
                    <p>España</p>
                    <p>2000 € al mes</p>
                </article>
            </a>

            <a href="detalle.php?id=4">
                <article class="tarjeta">
                    <img src="img/foto4.jpg" alt="Anuncio 4" style="width: 400px; height: 300px;">
                    <h3>Piso en Albacete</h3>
                    <p>12 / 10 / 2023</p>
                    <p>Albacete</p>
                    <p>España</p>
                    <p>234300 €</p>
                </article>
            </a>

            <a href="detalle.php?id=5">
                <article class="tarjeta">
                    <img src="img/foto5.jpg" alt="Anuncio 5" style="width: 400px; height: 300px;">
                    <h3>Apartamento en Alcorcón</h3>
                    <p>27 / 03 / 2024</p>
                    <p>Alcorcón</p>
                    <p>España</p>
                    <p>310000 €</p>
                </article>
            </a>

            <a href="detalle.php?id=6">
                <article class="tarjeta">
                    <img src="img/foto6.jpg" alt="Anuncio 6" style="width: 400px; height: 300px;">
                    <h3>Apartamento en La Vega Baja</h3>
                    <p>27 / 03 / 2023</p>
                    <p>La Vega Baja</p>
                    <p>España</p>
                    <p>220000 €</p>
                </article>
            </a>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
