<?php
// CONTROL DE ACCESO Y CARGA DE ANUNCIO
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();

$idParam = isset($_GET['id']) ? trim($_GET['id']) : '';
$link = mysqli_connect('localhost', 'root', '', 'daw');

$peticion = mysqli_query($link, "SELECT a.*, u.NomUsuario as Usuario, p.NomPais as Pais, tv.NomTVivienda as tipo_vivienda, ta.NomTAnuncio as tipo_anuncio 
FROM anuncios a LEFT JOIN tiposviviendas tv ON a.TVivienda = tv.IdTVivienda 
LEFT JOIN tiposanuncios ta ON a.TAnuncio = ta.IdTAnuncio 
LEFT JOIN usuarios u ON a.Usuario = u.IdUsuario
LEFT JOIN paises p ON a.Pais = p.IdPais
WHERE IdAnuncio = '" . $idParam . "'");

$anuncio = mysqli_fetch_assoc($peticion);
$error = '';


if ($idParam === '') {
    $error = 'No se ha proporcionado un identificador de anuncio.';
}
if ($anuncio === null) {
    $error = 'El anuncio solicitado no existe en el sistema.';
}
    
$title = $anuncio !== null ? 'Ver anuncio: ' . $anuncio['Titulo'] : 'Anuncio no encontrado';
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
        <h2><?= e($anuncio['Titulo']) ?></h2>

        <p><strong>Tipo de anuncio:</strong> <?= e($anuncio['tipo_anuncio']) ?></p>
        <p><strong>Tipo de vivienda:</strong> <?= e($anuncio['tipo_vivienda']) ?></p>

        <img src="<?= e($anuncio['FPrincipal']) ?>" alt="<?= e($anuncio['Alternativo']) ?>" style="width: 400px; height: 300px;">

        <p><?= e($anuncio['Texto']) ?></p>
        <p><strong>Fecha de publicación:</strong> <?= e($anuncio['FRegistro']) ?></p>
        <p><strong>Ubicación:</strong> <?= e($anuncio['Ciudad']) ?>, <?= e($anuncio['Pais']) ?></p>
        <p><strong>Precio:</strong> <?= e($anuncio['Precio']) ?> €</p>
        <p><strong>Publicado por el usuario:</strong> <?= e($anuncio['Usuario']) ?></p>

        <h3>Características de la vivienda</h3>
        <ul>
            <li><strong>Superficie:</strong> <?= e($anuncio['Superficie']) ?></li>
            <li><strong>Habitaciones:</strong> <?= e($anuncio['NHabitaciones']) ?></li>
            <li><strong>Baños:</strong> <?= e($anuncio['NBanyos']) ?></li>
            <li><strong>Planta:</strong> <?= e($anuncio['Planta']) ?></li>
            <li><strong>Año de construcción:</strong> <?= e($anuncio['Anyo']) ?></li>
        </ul>
        <?php
            $peticion2 = mysqli_query($link, "SELECT Foto, Alternativo FROM fotos WHERE Anuncio = '" . $idParam . "'");
        ?>
        <h3>Miniaturas de fotos</h3>
        <?php while ($foto = mysqli_fetch_assoc($peticion2)): ?>
            <img src="<?= e($foto['Foto']) ?>" alt="<?= e($foto['Alternativo']) ?>" style="width: 200px; height: 150px; display: inline-block; margin-right: 10px;">
        <?php endwhile; ?>
    </section>

    <p style="text-align: center; margin-top: 15px;">
        <a href="anadirFoto.php?id=<?= (int)$anuncio['IdAnuncio'] ?>" style="display: inline-block; background-color: var(--color-btn-bg); color: var(--color-btn-text); padding: 10px 20px; border-radius: var(--radio); text-decoration: none; font-weight: bold;">Añadir foto a este anuncio</a>
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
