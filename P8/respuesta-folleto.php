<?php 
    function e($value) {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function formatearEuro($numero) {
    return number_format($numero, 2, ',', '') . ' €';
    }

        $textoAdicional = isset($_POST['texto_adicional']) ? $_POST['texto_adicional'] : '';
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $calle = $_POST['calle'];
        $numero = $_POST['numero'];
        $cp = $_POST['cp'];
        $localidad = isset($_POST['localidad']) ? $_POST['localidad'] :'';
        $provincia = $_POST['provincia'];
        $tlf = isset($_POST['telefono']) ? $_POST['telefono'] :'';
        $color = $_POST['color_portada'];
        $copias = (int)$_POST['copias'];
        $resolucion = (int)$_POST['resolucion'];
        $anuncio = $_POST['anuncio'];
        $f_recepcion = isset($_POST['fecha_recepcion']) ? $_POST['fecha_recepcion'] : '';
        $impresion_c = $_POST['impresion_color'];
        $impresion_p = $_POST['impresion_precio'];

        
        $paginas = 10;
        $fotos = 20;
        $coste = 10;

        for ($i = 0; $i < $paginas; $i++) {
            if($i<5) {
                $coste += 2;
            }

            elseif($i >=5 || $i <= 10) {
                $coste += 1.8;
            }

            else {
                $coste += 1.6;
            }
        }

        if ($impresion_c == 'color') {
            $coste += $fotos * 0.5;
        }

        if ($resolucion > 300) {
            $coste += $fotos * 0.2;
        }

        $coste *= $copias;

        $coste = formatearEuro($coste);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud registrada - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/respuesta-folleto.css">
    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <main>
        <section>
            <h2>Solicitud registrada con éxito</h2>
            <p>Hemos registrado tu solicitud de folleto publicitario con los siguientes datos:</p>
                <ul>
                    <li>Texto adicional: <?= e($textoAdicional) ?></li>
                    <li>Nombre: <?= e($nombre); ?></li>
                    <li>Correo electrónico: <?= e($email); ?></li>
                    <li>Dirección: <?= e($calle);?>, <?= e($numero);?>, <?= e($cp);?>, <?= e($localidad);?>, <?= e($provincia);?></li>
                    <li>Teléfono <?= e($tlf) ?></li>
                    <li>Color de la portada: <?= e($color) ?></li>
                    <li>Número de copias: <?= e($copias) ?></li>
                    <li>Resolución de impresión: <?= e($resolucion)?> dpi</li>
                    <li>Anuncio: <?= e($anuncio) ?></li>
                    <li>Fecha recepción: <?= e($f_recepcion) ?></li>
                    <li>Impresión a color: <?= e($impresion_c) ?></li>
                    <li>Impresión del precio: <?= e($impresion_p) ?></li>
                </ul>

                <p><strong>Coste total del folleto publicitario: <?= $coste ?></strong></p>
            <p><a href="menu-usuario.php">Volver al menú de usuario</a></p>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>