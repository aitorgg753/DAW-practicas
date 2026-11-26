<?php
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();

$link = mysqli_connect('localhost', 'root', '', 'daw');
$errorBd = '';
$mensajeExito = flash_leer('estilo_ok');

if (!$link) {
    $errorBd = 'Error en la conexión con BD: ' . mysqli_connect_error();
} else {
    mysqli_set_charset($link, 'utf8mb4');

    // Procesar petición POST al pulsar un estilo
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_estilo'])) {
        $idEstilo = (int)$_POST['id_estilo'];
        $nomUsu = $_SESSION['usuario_logueado'];

        // Comprobar que el estilo existe y obtener su fichero CSS
        $stmtEstilo = mysqli_prepare($link, 'SELECT IdEstilo, Nombre, Fichero FROM estilos WHERE IdEstilo = ?');
        mysqli_stmt_bind_param($stmtEstilo, 'i', $idEstilo);
        mysqli_stmt_execute($stmtEstilo);
        $resEstilo = mysqli_stmt_get_result($stmtEstilo);
        $estiloElegido = mysqli_fetch_assoc($resEstilo);
        mysqli_stmt_close($stmtEstilo);

        if ($estiloElegido) {
            // Actualizar la columna Estilo en la tabla usuarios para el usuario logueado
            $stmtUpdate = mysqli_prepare($link, 'UPDATE usuarios SET Estilo = ? WHERE NomUsuario = ?');
            mysqli_stmt_bind_param($stmtUpdate, 'is', $idEstilo, $nomUsu);

            if (mysqli_stmt_execute($stmtUpdate)) {
                $_SESSION['estilo_css'] = $estiloElegido['Fichero'];
                mysqli_stmt_close($stmtUpdate);
                mysqli_close($link);
                flash_guardar('estilo_ok', 'Estilo actualizado a "' . $estiloElegido['Nombre'] . '".');
                redirigir('estilos.php');
            } else {
                $errorBd = 'Error al actualizar el estilo: ' . mysqli_error($link);
            }
            mysqli_stmt_close($stmtUpdate);
        } else {
            $errorBd = 'El estilo seleccionado no existe.';
        }
    }

    $consulta = 'SELECT IdEstilo, Nombre, Descripcion FROM estilos';
    $resultado = mysqli_query($link, $consulta);
    if (!$resultado) {
        $errorBd = 'Ha ocurrido un error: ' . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de estilo - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/menu-usuario.css">
    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <?php include_once("inc/headerSesIni.inc.php"); ?>
    <main>
        <section>
            <h2>Selección de estilo</h2>
            <?php if ($errorBd !== ''): ?>
                <p><?= e($errorBd) ?></p>
            <?php endif; ?>
            <?php if ($mensajeExito): ?>
                <p><?= e($mensajeExito) ?></p>
            <?php endif; ?>

            <?php if (isset($resultado) && $resultado): ?>
                <form method="post" action="estilos.php">
                    <ul>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <li>
                                <button type="submit" name="id_estilo" value="<?= (int)$fila['IdEstilo'] ?>">
                                    <?= e($fila['Nombre']) ?>
                                </button>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </form>
                <?php mysqli_free_result($resultado); ?>
            <?php endif; ?>
        </section>
    </main>
    <?php
    if ($link) {
        mysqli_close($link);
    }
    include_once("inc/footer.inc.php");
    ?>
</body>
</html>
