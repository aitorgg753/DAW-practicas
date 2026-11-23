<?php require_once(__DIR__ . '/inc/inicio_sesion.php'); ?>

<?php
   $filtroBusqueda = !empty($_GET["filtroBusqueda"]) ? $_GET["filtroBusqueda"] : "";

    $t_anuncio = !empty($_GET["anuncio"]) ? $_GET["anuncio"] : "(No seleccionado)";
    $vivienda = !empty($_GET["vivienda"]) ? $_GET["vivienda"] : "(No seleccionado)";
    $ciudad = !empty($_GET["ciudad"]) ? trim($_GET["ciudad"]) : "(No seleccionado)";
    $pais = !empty($_GET["pais"]) ? $_GET["pais"] : "(No seleccionado)";
    $fecha = !empty($_GET["fecha"]) ? $_GET["fecha"] : "(No seleccionado)";
    $desde = !empty($_GET["desde"]) ? $_GET["desde"] : "(No seleccionado)";
    $hasta = !empty($_GET["hasta"]) ? $_GET["hasta"] : "(No seleccionado)";

    $variables = [
        $t_anuncio,
        $vivienda,
        $ciudad,
        $pais,
        $fecha,
        $desde,
        $hasta
    ];

    $vacio = true;

    function comprobarVariables ($variables, $vacio) {
        foreach ($variables as $variable) {
            if($variable != "(No seleccionado)")  return $vacio = false;
        }
        return $vacio;
    }
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de búsqueda - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/listado.css">

    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <?php include_once("inc/headerSinSes.inc.php"); ?>

    <main>
        <section id="resBusqueda">
            <?php
                if (comprobarVariables($variables, $vacio) == false) {
                        echo "<h2>Resultados para ";
                        for ($i = 0; $i < count($variables); $i++) {
                            if ($i == count($variables)-1) {
                                echo e($variables[$i]) . "</h2>";
                            }
                            else {
                                echo e($variables[$i]) . ", ";
                            }
                        }
                } 
                elseif (empty($filtroBusqueda)) {
                    echo "<h2>Resultados de la búsqueda</h2>";
                }

                else {
                    echo "<h2>Resultados para " . e($filtroBusqueda) . "</h2>";
                }
            ?>

            <a href="detalle.php?id=1">
                <article>
                    <h3>Piso en San Vicente</h3>
                    <img src="img/pisoSanvi.jpg" alt="Piso en San Vicente" width="400" height="300">
                    <p>20/12/2025</p>
                    <p>Alicante</p>
                    <p>España</p>
                    <p>80000 €</p>
                </article>
            </a>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>

