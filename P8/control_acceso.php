<?php
// 1. INICIAR LA SESIÓN (Imprescindible para usar $_SESSION)
session_start();

if (file_exists('inc/funciones.php')) {
    require_once('inc/funciones.php');
}
if (file_exists('datos_usuarios.php')) {
    require_once('datos_usuarios.php');
}

$redirigir = $_POST['redirigir'];
$redirigir == 'index' ? comprobarSes() : comprobarReg();

function comprobarSes () {
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
}

function comprobarReg() {
    $nombre = isset($_POST ['nombre']) ? $_POST ['nombre'] :'';
    $pwd = isset($_POST ['password']) ? $_POST ['password'] :'';
    $rePwd = isset($_POST ['repetir_password']) ? $_POST ['repetir_password'] :'';
    $email = isset($_POST ['email']) ? $_POST ['email'] :'';
    $sexo = isset($_POST ['sexo']) ? $_POST ['sexo'] :'';
    $fNac = isset($_POST ['fecha_nacimiento']) ? $_POST ['fecha_nacimiento'] :'';
    $ciudad = isset($_POST ['ciudad']) ? $_POST ['ciudad'] :'';
    $pais = isset($_POST ['pais']) ? $_POST ['pais'] :'';

    $datos = [
        $nombre,
        $pwd,
        $email,
        $sexo,
        $fNac,
        $ciudad,
        $pais
    ];

    $errores = [];

    if ($nombre == '') {
        $errores[] = "El nombre de usuario no puede estar vacío.";
    }

    if ($pwd == '' || $rePwd == '') {
        $errores[] = "Debes rellenar la contraseña y repetirla.";
    } 
    
    elseif ($pwd !== $rePwd) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    $_SESSION['flash_errores'] = $errores;
    $_SESSION['flash_datos'] = $datos;
    
    redirigir('respuesta-registro.php');
}
?>