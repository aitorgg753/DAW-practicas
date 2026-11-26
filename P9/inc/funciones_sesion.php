<?php
// ESCAPAR HTML
if (!function_exists('e')) {
    function e($value)
    {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

// REDIRIGIR URL ABSOLUTA
if (!function_exists('redirigir')) {
    function redirigir($destino)
    {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/$destino");
        exit;
    }
}

// GUARDAR MENSAJE FLASH
function flash_guardar($clave, $valor)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'][$clave] = $valor;
}

// LEER MENSAJE FLASH
function flash_leer($clave)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['flash'][$clave])) {
        $valor = $_SESSION['flash'][$clave];
        unset($_SESSION['flash'][$clave]);
        return $valor;
    }
    return null;
}

// COMPROBAR EXISTENCIA MENSAJE FLASH
function flash_existe($clave)
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['flash'][$clave]);
}

// OBTENER RUTA FICHERO RECORDAR
function recordar_ruta_fichero()
{
    $ruta = __DIR__ . '/../datos_recordar.json';
    if (!file_exists($ruta)) {
        file_put_contents($ruta, json_encode([]), LOCK_EX);
    }
    return $ruta;
}

// GUARDAR RECORDATORIO EN SERVIDOR Y COOKIE
function recordar_guardar_usuario($nomUsu)
{
    $ruta = recordar_ruta_fichero();
    if (!is_writable($ruta) && !is_writable(dirname($ruta))) {
        return false;
    }
    $token = bin2hex(random_bytes(16));
    $expira = time() + (90 * 24 * 60 * 60);
    $ultimaVisita = date('d/m/Y \a \l\a\s H:i');

    $datos = [
        'token' => $token,
        'usuario' => $nomUsu,
        'expira' => $expira,
        'ultima_visita' => $ultimaVisita
    ];

    file_put_contents($ruta, json_encode($datos), LOCK_EX);

    setcookie('recuerdame', $token, [
        'expires' => $expira,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    $_COOKIE['recuerdame'] = $token;
    $_SESSION['recordado'] = true;
    $_SESSION['ultima_visita'] = $ultimaVisita;
    return true;
}

// VERIFICAR COOKIE RECORDARME
function recordar_verificar_cookie()
{
    if (!isset($_COOKIE['recuerdame']) || empty($_COOKIE['recuerdame'])) {
        return null;
    }
    $tokenCookie = $_COOKIE['recuerdame'];
    $ruta = recordar_ruta_fichero();
    if (!file_exists($ruta) || !is_readable($ruta)) {
        return null;
    }
    $contenido = file_get_contents($ruta);
    $datos = json_decode($contenido, true);
    if (!is_array($datos) || !isset($datos['token']) || !isset($datos['usuario']) || !isset($datos['expira'])) {
        recordar_borrar();
        return null;
    }
    if ($datos['token'] !== $tokenCookie) {
        recordar_borrar();
        return null;
    }
    if ((int)$datos['expira'] < time()) {
        recordar_borrar();
        return null;
    }
    return $datos;
}

// RESTAURAR SESION DESDE COOKIE RECORDARME
function recordar_restaurar_sesion()
{
    if (isset($_SESSION['usuario_logueado'])) {
        return true;
    }
    $datos = recordar_verificar_cookie();
    if ($datos === null) {
        return false;
    }
    $nomUsu = $datos['usuario'];
    $rutaUsuarios = __DIR__ . '/../datos_usuarios.php';
    if (!file_exists($rutaUsuarios)) {
        $rutaUsuarios = 'datos_usuarios.php';
    }
    if (!file_exists($rutaUsuarios)) {
        return false;
    }
    require($rutaUsuarios);
    if (!isset($usuarios[$nomUsu])) {
        recordar_borrar();
        return false;
    }

    session_regenerate_id(true);
    $_SESSION['usuario_logueado'] = $nomUsu;
    $_SESSION['nombre'] = $usuarios[$nomUsu]['nombre'];
    $_SESSION['estilo_css'] = $usuarios[$nomUsu]['estilo'];
    $_SESSION['recordado'] = true;
    $_SESSION['ultima_visita'] = isset($datos['ultima_visita']) ? $datos['ultima_visita'] : date('d/m/Y \a \l\a\s H:i');

    $datos['ultima_visita'] = date('d/m/Y \a \l\a\s H:i');
    $ruta = recordar_ruta_fichero();
    if (is_writable($ruta)) {
        file_put_contents($ruta, json_encode($datos), LOCK_EX);
    }
    return true;
}

// BORRAR DATOS DE RECORDARME
function recordar_borrar()
{
    setcookie('recuerdame', '', [
        'expires' => time() - 42000,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    unset($_COOKIE['recuerdame']);
    if (isset($_SESSION['recordado'])) {
        unset($_SESSION['recordado']);
    }
    if (isset($_SESSION['ultima_visita'])) {
        unset($_SESSION['ultima_visita']);
    }
    $ruta = __DIR__ . '/../datos_recordar.json';
    if (file_exists($ruta) && is_writable($ruta)) {
        file_put_contents($ruta, json_encode([]), LOCK_EX);
    }
}

// COMPROBAR SI USUARIO ESTA RECORDADO
function esta_recordado()
{
    if (isset($_SESSION['recordado']) && $_SESSION['recordado'] === true) {
        return true;
    }
    return (recordar_verificar_cookie() !== null);
}

// OBTENER MENSAJE ULTIMA VISITA
function obtener_mensaje_ultima_visita()
{
    if (!esta_recordado()) {
        return '';
    }
    $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
    $visita = isset($_SESSION['ultima_visita']) ? $_SESSION['ultima_visita'] : '';
    if ($nombre === '' || $visita === '') {
        $datos = recordar_verificar_cookie();
        if ($datos !== null) {
            $nomUsu = $datos['usuario'];
            $rutaUsuarios = __DIR__ . '/../datos_usuarios.php';
            if (file_exists($rutaUsuarios)) {
                require($rutaUsuarios);
                if (isset($usuarios[$nomUsu])) {
                    $nombre = $usuarios[$nomUsu]['nombre'];
                }
            }
            $visita = $datos['ultima_visita'];
        }
    }
    if ($nombre === '' || $visita === '') {
        return '';
    }
    return 'Hola ' . $nombre . ', su última visita fue el ' . $visita;
}

// COMPROBAR ACCESO A PAGINA PROTEGIDA
function comprobar_acceso()
{
    if (!isset($_SESSION['usuario_logueado']) || empty($_SESSION['usuario_logueado'])) {
        flash_guardar('error_acceso', 'Debes identificarte para acceder a esta página.');
        redirigir('index.php');
        exit;
    }
}

// OBTENER SALUDO SEGUN HORA
function obtener_saludo($nombre, $hora = null)
{
    if ($hora === null) {
        $hora = date('H:i');
    }
    if (is_int($hora)) {
        $h = $hora;
        $m = 0;
    } else {
        $partes = explode(':', (string)$hora);
        $h = (int)$partes[0];
        $m = isset($partes[1]) ? (int)$partes[1] : 0;
    }

    $minutos = $h * 60 + $m;
    if ($minutos >= 360 && $minutos <= 719) {
        return 'Buenos días, ' . $nombre . '.';
    } elseif ($minutos >= 720 && $minutos <= 959) {
        return 'Hola, ' . $nombre . '.';
    } elseif ($minutos >= 960 && $minutos <= 1199) {
        return 'Buenas tardes, ' . $nombre . '.';
    } else {
        return 'Buenas noches, ' . $nombre . '.';
    }
}

// OBTENER IDS ULTIMOS ANUNCIOS VISITADOS
function panel_anuncios_obtener_ids()
{
    $raw = '';
    if (isset($_COOKIE['ultimos_anuncios']) && $_COOKIE['ultimos_anuncios'] !== '') {
        $raw = $_COOKIE['ultimos_anuncios'];
    } elseif (isset($_COOKIE['historial_anuncios']) && $_COOKIE['historial_anuncios'] !== '') {
        $raw = $_COOKIE['historial_anuncios'];
    }
    if ($raw === '') {
        return [];
    }

    $decodificado = json_decode($raw, true);
    if (is_array($decodificado)) {
        $elementos = [];
        foreach ($decodificado as $item) {
            if (is_array($item) && isset($item['id'])) {
                $elementos[] = (string)$item['id'];
            } else {
                $elementos[] = (string)$item;
            }
        }
    } else {
        $elementos = explode(',', $raw);
    }

    $ids = [];
    foreach ($elementos as $elem) {
        $elem = trim((string)$elem);
        if ($elem !== '' && ctype_digit($elem)) {
            $id = (int)$elem;
            if ($id > 0 && !in_array($id, $ids, true)) {
                $ids[] = $id;
            }
        }
    }

    if (count($ids) > 4) {
        $ids = array_slice($ids, -4);
    }
    return $ids;
}

// REGISTRAR ANUNCIO VISITADO EN COOKIE
function panel_anuncios_registrar_visita($idAnuncio)
{
    if (!is_numeric($idAnuncio)) {
        return;
    }
    $idNum = (int)$idAnuncio;
    if ($idNum <= 0) {
        return;
    }

    $ids = panel_anuncios_obtener_ids();
    $pos = array_search($idNum, $ids, true);
    if ($pos !== false) {
        array_splice($ids, $pos, 1);
    }

    while (count($ids) >= 4) {
        array_shift($ids);
    }

    $ids[] = $idNum;
    $cadena = implode(',', $ids);
    $expira = time() + (7 * 24 * 60 * 60);

    setcookie('ultimos_anuncios', $cadena, [
        'expires' => $expira,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    $_COOKIE['ultimos_anuncios'] = $cadena;
}

// BORRAR COOKIE DE ULTIMOS ANUNCIOS
function panel_anuncios_borrar_cookie()
{
    setcookie('ultimos_anuncios', '', [
        'expires' => time() - 42000,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    setcookie('historial_anuncios', '', [
        'expires' => time() - 42000,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    unset($_COOKIE['ultimos_anuncios']);
    unset($_COOKIE['historial_anuncios']);
}