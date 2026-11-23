<?php
// FORMULARIO DE REGISTRO
require_once(__DIR__ . '/inc/inicio_sesion.php');

$errores = flash_leer('registro_errores');
$datos = flash_leer('registro_datos');
if (!is_array($errores)) {
    $errores = [];
}
if (!is_array($datos)) {
    $datos = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de nuevo usuario - PI Pisos e Inmuebles</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/registro.css">
    <?php include_once("inc/css.inc.php"); ?>
</head>

<body>
    <?php include_once("inc/headerSinSes.inc.php"); ?>
    <main>
        <section>
            <h2>Formulario de registro</h2>
            <p class="info-obligatorio">Los campos marcados con (*) son obligatorios.</p>

            <?php if (!empty($errores)): ?>
                <div style="color: red; margin-bottom: 15px;">
                    <p><strong>Se han encontrado errores:</strong></p>
                    <ul>
                        <?php foreach ($errores as $err): ?>
                            <li><?= e($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form id="formRegistro" action="control_acceso.php" method="post" novalidate>
                <input type="hidden" name="redirigir" value="registro">

                <label for="nombre">Nombre de usuario (*):</label>
                <small class="texto-ayuda">Entre 3 y 15 caracteres. Solo letras inglesas y números. No puede empezar por número.</small>
                <input type="text" id="nombre" name="nombre" value="<?= isset($datos['nombre']) ? e($datos['nombre']) : '' ?>">

                <label for="password">Contraseña (*):</label>
                <small class="texto-ayuda">Entre 6 y 15 caracteres. Al menos una mayúscula, una minúscula y un número. Letras inglesas, números, guion (-) y guion bajo (_).</small>
                <input type="password" id="password" name="password">

                <label for="repetir_password">Repetir contraseña (*):</label>
                <small class="texto-ayuda">Debe coincidir con la contraseña anterior.</small>
                <input type="password" id="repetir_password" name="repetir_password">

                <label for="email">Dirección de email (*):</label>
                <small class="texto-ayuda">Formato usuario@dominio (máximo 254 caracteres). Ej: usuario@ejemplo.com</small>
                <input type="text" id="email" name="email" value="<?= isset($datos['email']) ? e($datos['email']) : '' ?>">

                <label for="sexo">Sexo (*):</label>
                <small class="texto-ayuda">Selecciona una opción de la lista.</small>
                <select id="sexo" name="sexo">
                    <option value="">Selecciona una opción</option>
                    <option value="femenino" <?= (isset($datos['sexo']) && $datos['sexo'] === 'femenino') ? 'selected' : '' ?>>Femenino</option>
                    <option value="masculino" <?= (isset($datos['sexo']) && $datos['sexo'] === 'masculino') ? 'selected' : '' ?>>Masculino</option>
                    <option value="otro" <?= (isset($datos['sexo']) && $datos['sexo'] === 'otro') ? 'selected' : '' ?>>Otro</option>
                </select>

                <label for="fecha_nacimiento">Fecha de nacimiento (*):</label>
                <small class="texto-ayuda">Formato DD/MM/AAAA. Debes tener al menos 18 años cumplidos a fecha de hoy.</small>
                <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="DD/MM/AAAA" value="<?= isset($datos['fecha_nacimiento']) ? e($datos['fecha_nacimiento']) : '' ?>">

                <label for="ciudad">Ciudad de residencia (opcional):</label>
                <input type="text" id="ciudad" name="ciudad" value="<?= isset($datos['ciudad']) ? e($datos['ciudad']) : '' ?>">

                <label for="pais">País de residencia (opcional):</label>
                <input type="text" id="pais" name="pais" value="<?= isset($datos['pais']) ? e($datos['pais']) : '' ?>">

                <label for="foto">Foto de perfil (opcional):</label>
                <input type="file" id="foto" name="foto" accept="image/*">

                <button type="submit">Enviar registro</button>
                <button type="reset">Borrar formulario</button>
            </form>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
