<?php
// CONFIGURACION DE ERRORES PHP
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// FUNCION ESCAPAR HTML
if (!function_exists('e')) {
    function e($value)
    {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

// FUNCION FORMATEAR CANTIDAD EN EUROS
if (!function_exists('formatearEuro')) {
    function formatearEuro($numero)
    {
        return number_format($numero, 2, ',', '') . ' €';
    }
}

// FUNCION REDIRIGIR CON URL ABSOLUTA
if (!function_exists('redirigir')) {
    function redirigir($destino)
    {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/$destino");
        exit;
    }
}

// FUNCION CARGAR FICHERO SI EXISTE
if (!function_exists('cargarFichero')) {
    function cargarFichero($ruta)
    {
        if (file_exists($ruta)) {
            require_once($ruta);
        }
    }
}

// FUNCION OBTENER ANUNCIO POR ID
if (!function_exists('obtenerAnuncioPorId')) {
    function obtenerAnuncioPorId($id)
    {
        if (!is_numeric($id)) {
            return null;
        }
        $idNum = (int)$id;
        if ($idNum <= 0) {
            return null;
        }

        $rutaAnuncios = __DIR__ . '/../datos_anuncios.php';
        if (!file_exists($rutaAnuncios)) {
            $rutaAnuncios = 'datos_anuncios.php';
        }
        if (!file_exists($rutaAnuncios)) {
            return null;
        }
        require_once($rutaAnuncios);

        return isset($anuncios[$idNum]) ? $anuncios[$idNum] : null;
    }
}
