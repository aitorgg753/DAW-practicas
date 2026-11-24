<?php
// CARGAR ESTILO ASIGNADO A USUARIO
if (isset($_SESSION['estilo_css']) && $_SESSION['estilo_css'] !== '') {
    $archivoCss = $_SESSION['estilo_css'];
    if ($archivoCss !== '') {
        echo '<link rel="stylesheet" href="'. e($archivoCss) . '">';
    }
}
?>

<link rel="alternate stylesheet" type="text/css" href="css/noche.css" title="Modo noche" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="css/grande.css" title="Texto grande" media="screen" />
<link rel="alternate stylesheet" type="text/css" href="css/contraste.css" title="Alto contraste" media="screen"/>
<link rel="alternate stylesheet" type="text/css" href="css/contrasteGrande.css" title="Alto contraste y texto grande" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/impresion.css" media="print"/>
