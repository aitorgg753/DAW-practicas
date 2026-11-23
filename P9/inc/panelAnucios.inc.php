<?php
// CARGAR ULTIMOS ANUNCIOS VISITADOS
$idsUltimos = panel_anuncios_obtener_ids();

$rutaAnuncios = __DIR__ . '/../datos_anuncios.php';
if (!file_exists($rutaAnuncios)) {
    $rutaAnuncios = 'datos_anuncios.php';
}
if (file_exists($rutaAnuncios)) {
    require_once($rutaAnuncios);
}

echo '<section id="ultimos-visitados" style="margin-top: 40px; border-top: 2px solid var(--color-borde, #ccc); padding: 20px;">';
echo '<h2>Últimos anuncios visitados</h2>';

if (empty($idsUltimos)) {
    echo '<p>Todavía no has visitado ningún anuncio.</p>';
} else {
    echo '<div style="display: flex; gap: 20px; flex-wrap: wrap;">';
    foreach ($idsUltimos as $idAn) {
        $an = isset($anuncios[$idAn]) ? $anuncios[$idAn] : null;
        if ($an !== null) {
            $idEsc = e($an['id']);
            $fotoEsc = e($an['foto_principal']);
            $tituloEsc = e($an['titulo']);
            $ciudadEsc = e($an['ciudad']);
            $paisEsc = e($an['pais']);
            $precioEsc = e($an['precio']);

            echo '<a href="detalle.php?id=' . $idEsc . '" style="text-decoration: none; color: inherit;">';
            echo '  <article class="tarjeta" style="width: 250px; border: 1px solid var(--color-borde, #ddd); background-color: var(--color-superficie, transparent); color: var(--color-texto, inherit); padding: 10px;">';
            echo '      <img src="' . $fotoEsc . '" alt="' . $tituloEsc . '" style="width: 100%; height: 150px; object-fit: cover;">';
            echo '      <h3 style="font-size: 1.1em; margin: 10px 0;">' . $tituloEsc . '</h3>';
            echo '      <p style="margin: 2px 0;">' . $ciudadEsc . ', ' . $paisEsc . '</p>';
            echo '      <p style="font-weight: bold;">' . $precioEsc . '</p>';
            echo '  </article>';
            echo '</a>';
        }
    }
    echo '</div>';
}
echo '</section>';
?>
