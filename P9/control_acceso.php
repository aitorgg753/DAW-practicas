<?php
// CONTROL DE ACCESO Y REGISTRO
require_once(__DIR__ . '/inc/inicio_sesion.php');

if (file_exists('datos_usuarios.php')) {
    require_once('datos_usuarios.php');
}

$redirigir = isset($_POST['redirigir']) ? $_POST['redirigir'] : '';
if ($redirigir === 'registro') {
    comprobarReg();
} else {
    comprobarSes();
}

// COMPROBAR LOGIN DE USUARIO
function comprobarSes()
{
    $link = mysqli_connect('localhost', 'root', '', 'daw');
    global $usuarios;

    $nomUsu = isset($_POST['nomUsu']) ? trim($_POST['nomUsu']) : '';
    $pwd = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

    if ($nomUsu === '' || $pwd === '') {
        flash_guardar('error_login', 'Debes rellenar todos los campos.');
        flash_guardar('nomUsu_previo', $nomUsu);
        redirigir('index.php');
        exit;
    }

    $peticion = mysqli_query($link, "SELECT u.*, e.Fichero AS EstiloFichero FROM usuarios u LEFT JOIN
     estilos e ON u.Estilo = e.IdEstilo WHERE NomUsuario = '$nomUsu'");
    $respuesta = mysqli_fetch_assoc($peticion);

    if (empty($respuesta) || $respuesta['Clave'] !== $pwd) {
        flash_guardar('error_login', 'El usuario o la contraseña son incorrectos.');
        flash_guardar('nomUsu_previo', $nomUsu);
        redirigir('index.php');
        exit;
    }

    session_regenerate_id(true);
    $_SESSION['usuario_logueado'] = $respuesta['NomUsuario'];
    $_SESSION['estilo_css'] = $respuesta['EstiloFichero'];
    $_SESSION['nombre'] = $respuesta['NomUsuario'];

    if (isset($_POST['recordarme']) && ($_POST['recordarme'] === '1' || $_POST['recordarme'] === 'on')) {
        recordar_guardar_usuario($nomUsu);
    }

    redirigir('menu-usuario.php');
}

// COMPROBAR FORMULARIO DE REGISTRO
function comprobarReg()
{
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $pwd = isset($_POST['password']) ? trim($_POST['password']) : '';
    $rePwd = isset($_POST['repetir_password']) ? trim($_POST['repetir_password']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $fNac = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
    $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';

    $datos = [
        'nombre' => $nombre,
        'email' => $email,
        'sexo' => $sexo,
        'fecha_nacimiento' => $fNac,
        'ciudad' => $ciudad,
        'pais' => $pais
    ];

    $errores = [];

    if ($nombre === '') {
        $errores[] = 'El nombre de usuario no puede estar vacío.';
    }

    if ($pwd === '' || $rePwd === '') {
        $errores[] = 'Debes rellenar la contraseña y repetirla.';
    } elseif ($pwd !== $rePwd) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    if ($email === '') {
        $errores[] = 'El email no puede estar vacío.';
    }

    if ($sexo === '') {
        $errores[] = 'Debes seleccionar un sexo.';
    }

    if ($fNac === '') {
        $errores[] = 'Debes indicar una fecha de nacimiento.';
    }

    if (!empty($errores)) {
        flash_guardar('registro_errores', $errores);
        flash_guardar('registro_datos', $datos);
        redirigir('registro.php');
        exit;
    }

    flash_guardar('registro_datos', $datos);
    redirigir('respuesta-registro.php');
}
