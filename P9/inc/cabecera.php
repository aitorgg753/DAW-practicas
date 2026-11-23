<?php
// CARGAR ARCHIVO DE FUNCIONES
if (file_exists(__DIR__ . '/funciones.php')) {
    require_once(__DIR__ . '/funciones.php');
} elseif (file_exists('inc/funciones.php')) {
    require_once('inc/funciones.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? e($title) : 'PI - Pisos & Inmuebles' ?></title>
    <link rel="stylesheet" href="css/global.css">
<?php if (isset($cssAdicional) && $cssAdicional !== ''): ?>
    <link rel="stylesheet" href="css/<?= e($cssAdicional) ?>">
<?php endif; ?>
<?php
if (file_exists(__DIR__ . '/css.inc.php')) {
    require_once(__DIR__ . '/css.inc.php');
} elseif (file_exists('inc/css.inc.php')) {
    require_once('inc/css.inc.php');
}
?>
</head>

