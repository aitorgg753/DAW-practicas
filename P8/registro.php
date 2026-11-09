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

            <form id="formRegistro" action="respuesta-registro.php" method="post" novalidate>

                <!-- Nombre de usuario -->
                <label for="nombre">Nombre de usuario (*):</label>
                <small class="texto-ayuda">Entre 3 y 15 caracteres. Solo letras inglesas y números. No puede empezar por número.</small>
                <input type="text" id="nombre" name="nombre">

                <!-- Contraseña -->
                <label for="password">Contraseña (*):</label>
                <small class="texto-ayuda">Entre 6 y 15 caracteres. Al menos una mayúscula, una minúscula y un número. Letras inglesas, números, guion (-) y guion bajo (_).</small>
                <input type="password" id="password" name="password">

                <!-- Repetir contraseña -->
                <label for="repetir_password">Repetir contraseña (*):</label>
                <small class="texto-ayuda">Debe coincidir con la contraseña anterior.</small>
                <input type="password" id="repetir_password" name="repetir_password">

                <!-- Email -->
                <label for="email">Dirección de email (*):</label>
                <small class="texto-ayuda">Formato usuario@dominio (máximo 254 caracteres). Ej: usuario@ejemplo.com</small>
                <input type="text" id="email" name="email">

                <!-- Sexo (desplegable) -->
                <label for="sexo">Sexo (*):</label>
                <small class="texto-ayuda">Selecciona una opción de la lista.</small>
                <select id="sexo" name="sexo">
                    <option value="">Selecciona una opción</option>
                    <option value="femenino">Femenino</option>
                    <option value="masculino">Masculino</option>
                    <option value="otro">Otro</option>
                </select>

                <!-- Fecha de nacimiento -->
                <label for="fecha_nacimiento">Fecha de nacimiento (*):</label>
                <small class="texto-ayuda">Formato DD/MM/AAAA. Debes tener al menos 18 años cumplidos a fecha de hoy.</small>
                <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="DD/MM/AAAA">

                <!-- Ciudad de residencia -->
                <label for="ciudad">Ciudad de residencia (opcional):</label>
                <input type="text" id="ciudad" name="ciudad">

                <!-- País de residencia -->
                <label for="pais">País de residencia (opcional):</label>
                <input type="text" id="pais" name="pais">

                <!-- Foto de perfil -->
                <label for="foto">Foto de perfil (opcional):</label>
                <input type="file" id="foto" name="foto" accept="image/*">

                <!-- Botones de envío -->
                <button type="submit">Enviar registro</button>
                <button type="reset">Borrar formulario</button>

            </form>
        </section>
    </main>
    <?php include_once("inc/footer.inc.php"); ?>
</body>
</html>
