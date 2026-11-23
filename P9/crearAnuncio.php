<?php
// CONTROL DE ACCESO
require_once(__DIR__ . '/inc/inicio_sesion.php');
comprobar_acceso();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de nuevo usuario - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/registro.css">
    <?php include_once("inc/css.inc.php") ?>
</head>

<body>
    <?php include_once("inc/headerSesIni.inc.php") ?>

    <main>
        <section>
            <h2 style = "text-align: center; margin-bottom: 20px;">Crear anuncio</h2>

            <form action="" method="post">

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ej. Piso en Algeciras">

                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ej. Piso de 3 habitaciones, 2 baños, cocina equipada...">

                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ej. Algeciras">

                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" placeholder="Ej. España">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Ej. 150000 €">

                <button type="submit">Crear anuncio</button>
                <button type="reset">Borrar datos</button>
            </form>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php") ?>
</body>
</html>
