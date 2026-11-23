<?php require_once(__DIR__ . '/inc/inicio_sesion.php'); comprobar_acceso(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar folleto publicitario - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/folleto.css">

    <?php include_once("inc/css.inc.php"); ?>
    <script src = "./js/folleto.js"></script>
</head>

<body>
    <?php include_once("inc/headerSesIni.inc.php"); ?>
    <main>
        <section>
            <h2>Solicitud de impresiÃ³n de folleto publicitario</h2>
            <p>Mediante esta opciÃ³n puedes solicitar la impresiÃ³n y el envÃ­o postal de uno de tus anuncios a todo color, toda resoluciÃ³n.</p>
            <p>Los campos marcados con un asterisco (<strong>*</strong>) son obligatorios.</p>

            <table>
                <caption>Tarifas de impresiÃ³n del folleto publicitario</caption>
                <tr>
                    <th scope="col">Concepto</th>
                    <th scope="col">Tarifa</th>
                </tr>
                <tr>
                    <th scope="row">Coste procesamiento y envÃ­o</th>
                    <td>10 â‚¬</td>
                </tr>
                <tr>
                    <th scope="row">Menos de 5 pÃ¡ginas</th>
                    <td>2 â‚¬ por pÃ¡gina</td>
                </tr>
                <tr>
                    <th scope="row">Entre 5 y 10 pÃ¡ginas</th>
                    <td>1,8 â‚¬ por pÃ¡gina</td>
                </tr>
                <tr>
                    <th scope="row">MÃ¡s de 10 pÃ¡ginas</th>
                    <td>1,6 â‚¬ por pÃ¡gina</td>
                </tr>
                <tr>
                    <th scope="row">Blanco y negro</th>
                    <td>0 â‚¬</td>
                </tr>
                <tr>
                    <th scope="row">Color</th>
                    <td>0,5 â‚¬ por foto</td>
                </tr>
                <tr>
                    <th scope="row">ResoluciÃ³n &le; 300 dpi</th>
                    <td>0 â‚¬ por foto</td>
                </tr>
                <tr>
                    <th scope="row">ResoluciÃ³n &gt; 300 dpi</th>
                    <td>0,2 â‚¬ por foto</td>
                </tr>
            </table>


            <table>
                <thead>
                    <tr>
                        <th colspan="2"></th>
                        <th colspan="2">Blanco y negro</th>
                        <th colspan="2">Color</th>
                    </tr>
                    <tr>
                        <th>Numero de pÃ¡ginas</th>
                        <th>NÃºmero de fotos</th>
                        <th>150-300 dpi</th>
                        <th>450-900 dpi</th>
                        <th>150-300 dpi</th>
                        <th>450-900 dpi</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    for ($pag = 1; $pag <= 15; $pag++) {
                        $fotos = $pag * 3; // 3 fotos por pÃ¡gina
                        $costeBasePaginas = 10;
                    
                        for ($i = 1; $i <= $pag; $i++) {
                            if ($i < 5) {
                                $costeBasePaginas += 2.0;
                            } elseif ($i <= 10) {
                                $costeBasePaginas += 1.8;
                            } else {
                                $costeBasePaginas += 1.6;
                            }
                        }

                        $costeBN_Baja = $costeBasePaginas;
                        $costeBN_Alta = $costeBasePaginas + ($fotos * 0.2); 
                        $costeColor_Baja = $costeBasePaginas + ($fotos * 0.5);
                        $costeColor_Alta = $costeBasePaginas + ($fotos * 0.5) + ($fotos * 0.2);
                        echo "<tr>";
                        echo "<td>{$pag}</td>";
                        echo "<td>{$fotos}</td>";
                        echo "<td>" . formatearEuro($costeBN_Baja) . "</td>";
                        echo "<td>" . formatearEuro($costeBN_Alta) . "</td>";
                        echo "<td>" . formatearEuro($costeColor_Baja) . "</td>";
                        echo "<td>" . formatearEuro($costeColor_Alta) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            

            <h3>Formulario de solicitud</h3>
            <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu folleto publicitario.</p>

            <form action="respuesta-folleto.php" method="post">

                <!-- Texto adicional -->
                <p>
                    <label for="texto_adicional">Texto adicional:</label><br>
                    <textarea id="texto_adicional" name="texto_adicional" rows="4" cols="50"
                        placeholder="informaciÃ³n adicional a la que ya tiene el propio anuncio"></textarea>
                </p>

                <!-- Nombre -->
                <p>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej. David Garrido">
                    <span>(*)</span>
                </p>

                <!-- Email -->
                <p>
                    <label for="email">Correo electrÃ³nico:</label>
                    <input type="text" id="email" name="email" placeholder="tu e-mail">
                    <span>(*)</span>
                </p>

                <!-- DirecciÃ³n -->
                <p>
                    <label for="calle">DirecciÃ³n:</label>
                    <input type="text" id="calle" name="calle" placeholder="Calle">
                    <input type="text" id="numero" name="numero" placeholder="NÃºmero">
                    <input type="text" id="cp" name="cp" placeholder="CP"
                        title="5 dÃ­gitos, por ejemplo 03001">
                    <label for="localidad">
                        <select id="localidad" name="localidad">
                            <option value="">Localidad</option>
                            <option value="Alicante">Alicante</option>
                            <option value="Valencia">Valencia</option>
                            <option value="Madrid">Madrid</option>
                            <option value="Barcelona">Barcelona</option>
                        </select>
                    </label>
                    <label for="provincia">
                        <select id="provincia" name="provincia">
                            <option value="">Provincia</option>
                            <option value="Alicante">Alicante</option>
                            <option value="Valencia">Valencia</option>
                            <option value="Madrid">Madrid</option>
                            <option value="Barcelona">Barcelona</option>
                        </select>
                    </label>
                    <span>(*)</span>
                </p>

                <!-- TelÃ©fono -->
                <p>
                    <label for="telefono">TelÃ©fono:</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="### ## ## ##">
                </p>

                <!-- Color de portada -->
                <p>
                    <label for="color_portada">Color de la portada:</label>
                    <input type="color" id="color_portada" name="color_portada" value="#000000">
                    <span>(*)</span> <br>
                </p>

                <!-- NÃºmero de copias -->
                <p>
                    <label for="copias">NÃºmero de copias:</label>
                    <input type="number" id="copias" name="copias" value="1">
                    <span>(*)</span>
                </p>

                <!-- ResoluciÃ³n -->
                <p>
                    <label for="resolucion">ResoluciÃ³n de impresiÃ³n:</label>
                    <input type="range" id="resolucion" name="resolucion" step="150" min = "150" max = "900"
                        value="150" oninput="salida_resolucion.value = resolucion.value + ' dpi'">
                    <output id="salida_resolucion" for="resolucion">150 dpi</output>
                </p>

                <!-- Anuncio -->
                <p>
                    <label for="anuncio">Anuncio:</label>
                    <select id="anuncio" name="anuncio">
                        <option value="">mis anuncios</option>
                        <option value="piso-centro">Piso luminoso en el centro</option>
                        <option value="casa-afueras">Casa con jardÃ­n en las afueras</option>
                    </select>
                    <span>(*)</span>
                </p>

                <!-- Fecha de recepciÃ³n -->
                <p>
                    <label for="fecha_recepcion">Fecha recepciÃ³n:</label>
                    <input type="date" id="fecha_recepcion" name="fecha_recepcion">
                    <small>Fecha aproximada de recepciÃ³n, no se puede garantizar su cumplimiento.</small>
                </p>

                <!-- ImpresiÃ³n a color -->
                <fieldset>
                    <legend>Â¿ImpresiÃ³n a color?</legend>
                    <input type="radio" id="color_si" name="impresion_color" value="color" checked>
                    <label for="color_si">Color</label>
                    <input type="radio" id="color_no" name="impresion_color" value="bn">
                    <label for="color_no">Blanco y negro</label>
                </fieldset>

                <!-- ImpresiÃ³n del precio -->
                <fieldset>
                    <legend>Â¿ImpresiÃ³n del precio?</legend>
                    <input type="radio" id="precio_si" name="impresion_precio" value="si" checked>
                    <label for="precio_si">SÃ­</label>
                    <input type="radio" id="precio_no" name="impresion_precio" value="no">
                    <label for="precio_no">No</label>
                </fieldset>

                <p>
                    <button type="submit">Â¡Solicitar!</button>
                    <button type="reset">Borrar formulario</button>
                </p>

            </form>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
