<?php
// CONTROL DE ACCESO Y CARGA DE ANUNCIO
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();

if (file_exists('datos_anuncios.php')) {
    require_once('datos_anuncios.php');
}

$idParam = isset($_GET['id']) ? trim($_GET['id']) : '';
$anuncioPreseleccionado = null;
$bloqueado = false;

if ($idParam !== '' && is_numeric($idParam)) {
    $idNum = (int)$idParam;
    if ($idNum > 0) {
        $anuncioPreseleccionado = isset($anuncios[$idNum]) ? $anuncios[$idNum] : null;
        if ($anuncioPreseleccionado !== null) {
            $bloqueado = true;
        }
    }
}

$title = 'Añadir foto a anuncio - PI Pisos e Inmuebles';
$cssAdicional = 'registro.css';
$esPrivada = true;

if (file_exists('inc/cabecera.php')) {
    require_once('inc/cabecera.php');
}
if (file_exists('inc/inicio.php')) {
    require_once('inc/inicio.php');
}
?>

<section>
    <h2>Añadir foto a un anuncio</h2>
    <p>Completa el formulario para asociar una nueva fotografía a tu anuncio.</p>

    <form action="" method="post">
        <label for="anuncio">Anuncio al que se añade la foto (*):</label>
        <?php if ($bloqueado && $anuncioPreseleccionado !== null): ?>
            <select id="anuncio" name="anuncio_mostrar" disabled>
                <option value="<?= (int)$anuncioPreseleccionado['id'] ?>" selected>
                    <?= e($anuncioPreseleccionado['titulo']) ?> (<?= e($anuncioPreseleccionado['ciudad']) ?> - <?= e($anuncioPreseleccionado['precio']) ?>)
                </option>
            </select>
            <input type="hidden" name="anuncio" value="<?= (int)$anuncioPreseleccionado['id'] ?>">
            <small style="color: var(--color-texto-suave);">Anuncio seleccionado automáticamente desde la ficha del anuncio. No se puede modificar.</small>
        <?php else: ?>
            <select id="anuncio" name="anuncio" required>
                <option value="">-- Selecciona un anuncio --</option>
                <?php foreach ($anuncios as $item): ?>
                    <option value="<?= (int)$item['id'] ?>">
                        <?= e($item['titulo']) ?> (<?= e($item['ciudad']) ?> - <?= e($item['precio']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>

        <label for="foto">Fotografía (*):</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>

        <label for="texto_alt">Texto alternativo (*):</label>
        <small style="color: var(--color-texto-suave);">Descripción textual accesible de la imagen (mínimo 10 caracteres obligatorios).</small>
        <input type="text" id="texto_alt" name="texto_alt" required minlength="10" placeholder="Ejemplo: Vista panorámica del salón con ventanales">

        <label for="titulo_foto">Título de la foto:</label>
        <input type="text" id="titulo_foto" name="titulo_foto" placeholder="Ejemplo: Salón principal">

        <button type="submit">Guardar foto</button>
        <button type="reset">Borrar datos</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
        <a href="menu-usuario.php">Volver al menú de usuario</a>
    </p>
</section>

<?php
if (file_exists('inc/pie.php')) {
    require_once('inc/pie.php');
}
?>
