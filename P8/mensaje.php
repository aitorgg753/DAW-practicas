<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Enviar mensaje</title>
        <meta charset="utf-8">
        <link href="css/global.css" rel="stylesheet">
        <link href="css/mensaje.css" rel="stylesheet">
        <?php include_once("inc/css.inc.php"); ?>
        
    </head>

    <body>
        <?php include_once("inc/headerSesIni.inc.php"); ?>
        <main>
            <form action = "mensajeRes.php" class="tarjeta">
                <h2>Enviar un mensaje</h2>
                <p>Tipo de mensaje</p>
                <select class="borde">
                    <option>Más información</option>
                    <option>Solicitar una cita</option>
                    <option>Comunicar una oferta</option>
                </select>
                
                <p>Mensaje</p>
                <textarea class="borde" required></textarea>
                <button type="submit">Enviar mensaje</button>
            </form>
        </main>
        <?php include_once("inc/footer.inc.php"); ?>
    </body>
</html>