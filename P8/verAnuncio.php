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
    $error = 'No se ha proporcionado un identificador de anuncio.';
} elseif (!is_numeric($idParam)) {
    $error = 'El identificador de anuncio debe ser un número entero válido.';
} else {
    $idNum = (int)$idParam;
    if ($idNum <= 0) {
        $error = 'El identificador de anuncio debe ser mayor que cero.';
    } else {
        if ($idNum % 2 == 0) {
            $anuncio = isset($anuncios[2]) ? $anuncios[2] : null;
        } else {
            $anuncio = isset($anuncios[1]) ? $anuncios[1] : null;
        }

        if ($anuncio === null) {
            $error = 'El anuncio solicitado no existe en el sistema.';
        }
    }
}

// CONFIGURAR PLANTILLA
$title = $anuncio !== null ? 'Ver anuncio: ' . $anuncio['titulo'] : 'Anuncio no encontrado';
$cssAdicional = 'anuncio.css';
$esPrivada = true;

if (file_exists('inc/cabecera.php')) {
    require_once('inc/cabecera.php');
}
if (file_exists('inc/inicio.php')) {
    require_once('inc/inicio.php');
}
?>

<?php if ($error !== ''): ?>
    <section>
        <h2>Error al cargar el anuncio</h2>
        <p><?= e($error) ?></p>
        <p><a href="misAnuncios.php">Volver a Mis anuncios</a></p>
    </section>
<?php else: ?>
    <section id="anuncioPlaceholder">
        <h2><?= e($anuncio['titulo']) ?></h2>

        <p><strong>Tipo de anuncio:</strong> <?= e($anuncio['tipo_anuncio']) ?></p>
        <p><strong>Tipo de vivienda:</strong> <?= e($anuncio['tipo_vivienda']) ?></p>

        <img src="<?= e($anuncio['foto_principal']) ?>" alt="<?= e($anuncio['alt_foto_principal']) ?>" style="width: 400px; height: 300px;">

        <p><?= e($anuncio['texto']) ?></p>
        <p><strong>Fecha de publicación:</strong> <?= e($anuncio['fecha']) ?></p>
        <p><strong>Ubicación:</strong> <?= e($anuncio['ciudad']) ?>, <?= e($anuncio['pais']) ?></p>
        <p><strong>Precio:</strong> <?= e($anuncio['precio']) ?></p>
        <p><strong>Publicado por el usuario:</strong> <?= e($anuncio['usuario']) ?></p>

        <h3>Características de la vivienda</h3>
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

    <p style="text-align: center; margin-top: 15px;">
        <a href="anadirFoto.php?id=<?= (int)$anuncio['id'] ?>" style="display: inline-block; background-color: var(--color-btn-bg); color: var(--color-btn-text); padding: 10px 20px; border-radius: var(--radio); text-decoration: none; font-weight: bold;">Añadir foto a este anuncio</a>
    </p>

    <p style="text-align: center; margin-top: 10px;">
        <a href="misAnuncios.php">Volver a mis anuncios</a>
    </p>
<?php endif; ?>

<?php
if (file_exists('inc/pie.php')) {
    require_once('inc/pie.php');
}
?>

