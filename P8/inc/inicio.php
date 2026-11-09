<?php
// COMPROBAR TIPO DE VISTA
$esPrivada = isset($esPrivada) ? (bool)$esPrivada : false;
?>
<body>
    <header>
        <div id="imgTit">
            <img src="img/Logo.svg" alt="Logo" width="100">
            <h1>PI - Pisos &amp; Inmuebles</h1>
        </div>
        <nav>
            <ul>
<?php if ($esPrivada): ?>
                <li><a href="indexSesionIni.php">Inicio</a></li>
                <li><a href="menu-usuario.php">Mi perfil</a></li>
                <li><a href="misAnuncios.php">Mis anuncios</a></li>
                <li><a href="crearAnuncio.php">Crear anuncio</a></li>
                <li><a href="anadirFoto.php">Añadir foto</a></li>
                <li><a href="mensajes.php">Mis mensajes</a></li>
                <li><a href="busqueda.php">Buscar</a></li>
                <li><a href="index.php">Salir</a></li>
<?php else: ?>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="busquedaSinSes.php">Buscar</a></li>
                <li><a href="index.php#iniSes">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
<?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>

