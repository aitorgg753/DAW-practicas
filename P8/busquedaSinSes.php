<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Buscador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/busqueda.css">   
        <?php include_once("inc/css.inc.php") ?>
    </head>

    <body>
        <?php include_once("inc/headerSinSes.inc.php") ?>
        <main>
            <form action="listadoSinSes.php" class="tarjeta" id="formBusqueda" method="get">
                <h2>Buscar vivienda</h2>

                <label for = "anuncio">Tipo de anuncio</label>
                <select id = "anuncio" class="borde" name="anuncio">
                    <option>Venta</option>
                    <option>Alquiler</option>
                </select>
                
                <label for = "vivienda">Tipo de vivienda</label>
                <select id = "vivienda" class="borde" name="vivienda">
                    <option>Obra nueva</option>
                    <option>Vivienda</option>
                    <option>Oficina</option>
                    <option>Local</option>
                    <option>Garaje</option>
                </select>

                <label for = "ciudad">Ciudad</label>
                <input type="text" id = "ciudad" placeholder="Alicante" class="borde" name="ciudad">

                <label for = "pais">País</label>
                <select id = "pais" class="borde" name="pais">
                    <option>España</option>
                    <option>Moldavia</option>
                    <option>Alemania</option>
                    <option>Yemen</option>
                    <option>Francia</option>
                </select>

                <label for = "fecha">Fecha de publicación</label>
                <input type = "date" id = "fecha" class="borde" name="fecha">

                <div id = "filtroPrecio">
                    <label for="desde">Desde</label>
                    <input type="number" id = "desde" class="borde" name="desde">
                    <label for = "hasta">hasta</label>
                    <input type="number" id = "hasta" class="borde" name="hasta">
                </div>

                <button type="submit">Buscar</button>
            </form>
        </main>
        <?php include_once("inc/footer.inc.php"); ?>
    </body>
</html>