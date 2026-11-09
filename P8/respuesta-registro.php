<?php 
    function e($value) {
        if ($value === null) {
            return '';
        }
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
        $nombre = isset($_POST ['nombre']) ? $_POST ['nombre'] :'';
        $pwd = isset($_POST ['password']) ? $_POST ['password'] :'';
        $rePwd = isset($_POST ['repetir_password']) ? $_POST ['repetir_password'] :'';
        $email = isset($_POST ['email']) ? $_POST ['email'] :'';
        $sexo = isset($_POST ['sexo']) ? $_POST ['sexo'] :'';
        $fNac = isset($_POST ['fecha_nacimiento']) ? $_POST ['fecha_nacimiento'] :'';
        $ciudad = isset($_POST ['ciudad']) ? $_POST ['ciudad'] :'';
        $pais = isset($_POST ['pais']) ? $_POST ['pais'] :'';

        $errores = [];

        if ($nombre == '') {
            $errores[] = "El nombre de usuario no puede estar vacío.";
        }

        if ($pwd == '' || $rePwd == '') {
            $errores[] = "Debes rellenar la contraseña y repetirla.";
        } 
        
        elseif ($pwd !== $rePwd) {
            $errores[] = "Las contraseñas no coinciden.";
        }

        if (!empty($errores)) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Error en el registro</title>
                <link href="css/global.css" rel = "stylesheet">
                <link href="css/respuesta-folleto.css" rel = "stylesheet">
                <?php include_once("inc/css.inc.php"); ?>
            </head>
            <body>
                <main>
                    <section>
                        <h2 id = "textoError">Se han encontrado errores en tu registro:</h2>
                            <ul>
                                <?php foreach ($errores as $error): ?>
                                    <li><?= e($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <p><a href="registro.php">Volver al formulario</a></p>
                    </section>
                </main>
            </body>
        </html>
    <?php
    exit; // Detiene la ejecución para que no muestre el HTML de éxito
    }
    ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro completado - PI Pisos e Inmuebles</title>
    <?php include_once("inc/css.inc.php"); ?>
</head>
<body>
    <main>
        <section>
            <h2>Registro completado con éxito</h2>
            <p>Estos son los datos que has introducido:</p>
            <ul>
                <li>Usuario: <?= e($nombre) ?></li>
                <li>Email: <?= e($email) ?></li>
                <li>Contraseña: <?= e($pwd) ?></li>
            </ul>
            <p><a href="indexSesionIni.php">Ir al inicio</a></p>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>