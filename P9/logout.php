<?php
// CERRAR SESION COMPLETA
require_once(__DIR__ . '/inc/inicio_sesion.php');

$_SESSION = [];

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

session_destroy();

recordar_borrar();
panel_anuncios_borrar_cookie();

redirigir('index.php');
