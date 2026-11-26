<?php
session_start();
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <title>Mis anuncios</title>
        <meta charset="UTF-8">
        <link href="css/global.css" rel="stylesheet">
        <link href="css/listado.css" rel="stylesheet">
        <?php include_once("inc/css.inc.php"); ?>
    </head>
    <body>
        <?php include_once("inc/headerSesIni.inc.php"); ?>
        <main>
        <section id = "resBusqueda">
            <h2>Mis anuncios</h2>
            <?php
                $link = mysqli_connect('localhost', 'root', '', 'daw');

                $peticion = mysqli_query($link, "SELECT a.*, p.NomPais as NomPais FROM anuncios a
                INNER JOIN usuarios u ON a.Usuario = u.IdUsuario LEFT JOIN paises p ON a.Pais = p.IdPais
                WHERE u.NomUsuario = '". $_SESSION['usuario_logueado'] ."'");

                $n_anuncios = 0;
            
                while ($fila = mysqli_fetch_assoc($peticion)) {
                    $n_anuncios++;
                    echo '<a href = "verAnuncio.php?id=' . $fila['IdAnuncio'] . '">';    
                    echo "<article>";
                    echo "<h3>" . $fila['Titulo'] . "</h3>";
                    echo '<img src="./' . $fila['FPrincipal'] . '" alt="' . $fila['Alternativo'] . '" width="400" height="300">';
                    echo "<p>" . $fila['Ciudad'] . "</p>";
                    echo "<p>" . $fila['NomPais'] . "</p>";
                    echo "<p>" . $fila['Precio'] . " €</p>";
                    echo "</article>";
                    echo "</a>";
                }
            ?>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
    </body>
</html>
