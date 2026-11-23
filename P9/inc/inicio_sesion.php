<?php
// CONFIGURACION DE ERRORES Y ZONA HORARIA
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Europe/Madrid');

// CARGAR ARCHIVOS DE FUNCIONES
if (file_exists(__DIR__ . '/funciones.php')) {
    require_once(__DIR__ . '/funciones.php');
}
require_once(__DIR__ . '/funciones_sesion.php');

// INICIAR SESION SEGURA
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// RESTAURAR SESION DESDE COOKIE RECORDARME
if (!isset($_SESSION['usuario_logueado'])) {
    recordar_restaurar_sesion();
}

