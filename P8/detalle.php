<?php
// CARGAR ARCHIVOS NECESARIOS
if (file_exists('inc/funciones.php')) {
    require_once('inc/funciones.php');
}
if (file_exists('datos_anuncios.php')) {
    require_once('datos_anuncios.php');
}

// OBTENER IDENTIFICADOR DEL ANUNCIO
$idParam = isset($_GET['id']) ? trim($_GET['id']) : '';
$anuncio = null;
$error = '';

if ($idParam === '') {
    $error = 'No se ha indicado ningún identificador de anuncio.';
} elseif (!is_numeric($idParam)) {
    $error = 'El identificador de anuncio debe ser un valor numérico.';
} else {
    $idNum = (int)$idParam;
    if ($idNum <= 0) {
        $error = 'El identificador de anuncio debe ser un número positivo.';
    } else {
        if ($idNum % 2 == 0) {
            $anuncio = isset($anuncios[2]) ? $anuncios[2] : null;
        } else {
            $anuncio = isset($anuncios[1]) ? $anuncios[1] : null;
        }

        if ($anuncio === null) {
            $error = 'No se ha encontrado el anuncio solicitado.';
        }
    }
}

// CONFIGURAR PLANTILLA
$title = $anuncio !== null ? $anuncio['titulo'] . ' - PI Pisos e Inmuebles' : 'Anuncio no encontrado';
$cssAdicional = 'anuncio.css';
$esPrivada = false;

if (file_exists('inc/cabecera.php')) {
    require_once('inc/cabecera.php');
}
if (file_exists('inc/inicio.php')) {
    require_once('inc/inicio.php');
}
?>

<?php if ($error !== ''): ?>
    <section>
        <h2>Error al consultar el anuncio</h2>
        <p><?= e($error) ?></p>
        <p><a href="index.php">Volver a la página principal</a></p>
    </section>
<?php else: ?>
    <section id="anuncioPlaceholder">
        <h2><?= e($anuncio['titulo']) ?></h2>

        <p><strong>Tipo de anuncio:</strong> <?= e($anuncio['tipo_anuncio']) ?></p>
        <p><strong>Tipo de vivienda:</strong> <?= e($anuncio['tipo_vivienda']) ?></p>

        <img src="<?= e($anuncio['foto_principal']) ?>" alt="<?= e($anuncio['alt_foto_principal']) ?>" style="width: 400px; height: 300px;">

        <p><?= e($anuncio['texto']) ?></p>
        <p><strong>Fecha:</strong> <?= e($anuncio['fecha']) ?></p>
        <p><strong>Ciudad:</strong> <?= e($anuncio['ciudad']) ?></p>
        <p><strong>País:</strong> <?= e($anuncio['pais']) ?></p>
        <p><strong>Precio:</strong> <?= e($anuncio['precio']) ?></p>
        <p><strong>Anunciante:</strong> <?= e($anuncio['usuario']) ?></p>

        <h3>Características</h3>
        <ul>
            <li><strong>Superficie:</strong> <?= e($anuncio['caracteristicas']['superficie']) ?></li>
            <li><strong>Habitaciones:</strong> <?= e($anuncio['caracteristicas']['habitaciones']) ?></li>
            <li><strong>Baños:</strong> <?= e($anuncio['caracteristicas']['banos']) ?></li>
            <li><strong>Planta:</strong> <?= e($anuncio['caracteristicas']['planta']) ?></li>
            <li><strong>Año de construcción:</strong> <?= e($anuncio['caracteristicas']['ano_construccion']) ?></li>
        </ul>

        <h3>Miniaturas de fotos</h3>
        <?php foreach ($anuncio['fotos'] as $foto): ?>
            <img src="<?= e($foto['src']) ?>" alt="<?= e($foto['alt']) ?>" style="width: 200px; height: 150px; display: inline-block; margin-right: 10px;">
        <?php endforeach; ?>
    </section>

    <a href="mensaje.php">Enviar un mensaje</a>
<?php endif; ?>

<?php
if (file_exists('inc/pie.php')) {
    require_once('inc/pie.php');
}
?>

