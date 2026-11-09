<?php
// 1. INICIAR LA SESIÓN (Imprescindible para usar $_SESSION)
session_start();

if (file_exists('inc/funciones.php')) {
    require_once('inc/funciones.php');
}
if (file_exists('datos_usuarios.php')) {
    require_once('datos_usuarios.php');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$nomUsu = isset($_POST['nomUsu']) ? trim($_POST['nomUsu']) : '';
$pwd = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

if ($nomUsu === '' || $pwd === '') {
    // 2. GUARDAMOS EL ERROR EN SESIÓN (Flashdata)
    $_SESSION['_flash_error'] = "Debes rellenar todos los campos.";
    // También guardamos el nombre de usuario para repoblar el formulario (opcional pero recomendado)
    $_SESSION['_flash_nomUsu'] = $nomUsu; 
    
    redirigir("index.php");
    exit(); // Añade un exit después de redirigir por seguridad
}

if (!isset($usuarios[$nomUsu]) || $usuarios[$nomUsu] !== $pwd) {
    // 2. GUARDAMOS EL ERROR EN SESIÓN (Flashdata)
    $_SESSION['_flash_error'] = "El usuario o la contraseña son incorrectos.";
    $_SESSION['_flash_nomUsu'] = $nomUsu;
    
    redirigir("index.php");
    exit();
}

// REDIRIGIR AL MENU DE USUARIO
// (Ojo: ¡aquí más adelante tendrás que crear la sesión de usuario logueado!)
redirigir('menu-usuario.php');

?>