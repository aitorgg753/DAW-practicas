<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8">
        <title>PI - Pisos & Inmuebles</title>
        <link rel = "stylesheet" href = "css/global.css">
        <link rel = "stylesheet" href = "css/index.css">
        <?php include_once("inc/css.inc.php") ?>

    <body>
        <?php include_once("inc/headerSesIni.inc.php") ?>
        <main>
            <h2 id = "subBusqueda">Buscar vivienda</h2>
            <form action="listado.php" id = "formBusqueda">
                <input type="text" placeholder="Ciudad, zona, código postal" class="borde" name="filtroBusqueda">
                <button type ="submit">Buscar</button>
            </form>

            <section id = "anuncios">
                <h2>Últimos anuncios publicados</h2>
                
                <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto1.jpg" alt = "Anuncio 1" style = "width: 400px; height: 300px;">
                        <h3>Piso en Alicante</h3>
                        <p>20 / 09 / 2025</p>
                        <p>Alicante</p>
                        <p>España</p>
                        <p>225000 €</p>
                    </article>
                </a>

                <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto2.jpg" alt = "Anuncio 2" style = "width: 400px; height: 300px;">
                        <h3>Apartamento en Valladolid</h3>
                        <p>16 / 07 / 2026</p>
                        <p>Valladolid</p>
                        <p>España</p>
                        <p>600 € al mes</p>
                    </article>
                </a>

            <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto3.jpg" alt = "Anuncio 3" style = "width: 400px; height: 300px;">
                        <h3>Pisito en Madrid centro</h3>
                        <p>19 / 06 / 2025</p>
                        <p>Madrid</p>
                        <p>España</p>
                        <p>2000 € al mes</p>
                    </article>
                </a>

                <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto4.jpg" alt = "Anuncio 4" style = "width: 400px; height: 300px;">
                        <h3>Piso en Albacete</h3>
                        <p>12 / 10 / 2023</p>
                        <p>Albacete</p>
                        <p>España</p>
                        <p>234300 €</p>
                    </article>
                </a>

                <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto5.jpg" alt = "Anuncio 5" style = "width: 400px; height: 300px;">
                        <h3>Apartamento en Alcorcón</h3>
                        <p>27 / 03 / 2024</p>
                        <p>Alcorcón</p>
                        <p>España</p>
                        <p>310000 €</p>
                    </article>
                </a>

                <a href = "anuncio.php">
                    <article class="tarjeta">
                        <img src = "img/foto6.jpg" alt = "Anuncio 6" style = "width: 400px; height: 300px;">
                        <h3>Apartamento en La Vega Bja</h3>
                        <p>27 / 03 / 2023</p>
                        <p>La Vega Baja</p>
                        <p>España</p>
                        <p>220000 €</p>
                    </article>
                </a>
            </section>
        </main>
        <?php include_once("inc/footer.inc.php"); ?>
    </body>
</html>