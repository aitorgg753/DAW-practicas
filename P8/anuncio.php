<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del anuncio - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css" media="screen">
    <link rel="stylesheet" href="css/anuncio.css" media="screen">
    <?php include_once("inc/css.inc.php") ?>
</head>

<body>
    <?php include_once("inc/headerSesIni.inc.php") ?>
    <main>
        <section id = "anuncioPlaceholder">
            <h2>Piso en San Vicente</h2>

            <p>Tipo de anuncio: Venta</p>
            <p>Tipo de vivienda: Piso</p>

            <img src="img/pisoSanvi.jpg" alt="Piso en San Vicente" style = "width: 400px; height: 300px">

            <p>Piso con buenas vistas a San Vicente, con buena iluminación natural y el mercadona está cerca</p>
            </p>
            <p>20/12/2025</p>
            <p>Alicante</p>
            <p>España</p>
            <p>80000 €</p>

            <h3>Características</h3>
            <ul>
                <li>3 habitaciones</li>
                <li>2 baños</li>
                <li>Ascensor</li>
                <li>90 m²</li>
            </ul>

            <h3>Miniaturas de fotos</h3>
            <img src="img/salon.jpg" alt="Salón" style = "width: 400px; height: 300px">
        </section>
        <a href="mensaje.php">Enviar un mensaje</a>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>