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
            <a href = "verAnuncio.php">
                <article>
                    <h3>Pisillo en Alcorcón</h3>
                    <img src="img/pisoAlcorcon.webp" alt="Piso en Alcorcón" width="400" height="300">
                    <p>Madrid</p>
                    <p>España</p>
                    <p>80000 €</p>
                </article>
                <article>
                    <h3>Bungalow en Alicante</h3>
                    <img src="img/bungalowAlicante.jpg" alt="Bungalow en Alicante" width="400" height="300">
                    <p>Alicante</p>
                    <p>España</p>
                    <p>210000 €</p>
                </article>
            </a>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
    </body>
</html>