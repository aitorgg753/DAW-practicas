// COMPROBAR SI UN CARACTER ES LETRA MAYUSCULA
function esLetraMayuscula(c) {
    const code = c.charCodeAt(0);
    return code >= 65 && code <= 90;
}

// COMPROBAR SI UN CARACTER ES LETRA MINUSCULA
function esLetraMinuscula(c) {
    const code = c.charCodeAt(0);
    return code >= 97 && code <= 122;
}

// COMPROBAR SI UN CARACTER ES LETRA INGLESA
function esLetraInglesa(c) {
    return esLetraMayuscula(c) || esLetraMinuscula(c);
}

// COMPROBAR SI UN CARACTER ES DIGITO
function esDigito(c) {
    const code = c.charCodeAt(0);
    return code >= 48 && code <= 57;
}

// COMPROBAR SI UN CARACTER ES ESPECIAL DE EMAIL
function esCaracterEspecialEmail(c) {
    const especiales = "!#$%&'*+-/=?^_`{|}~";
    return especiales.includes(c);
}

// MOSTRAR ERROR DE UN CAMPO
function mostrarError(campo, mensaje) {
    campo.classList.add("campo-error");
    const etiqueta = document.querySelector(`label[for="${campo.id}"]`);
    if (etiqueta !== null) {
        etiqueta.classList.add("etiqueta-error");
    }
    let spanError = document.getElementById(`${campo.id}-error`);
    if (spanError === null) {
        spanError = document.createElement("span");
        spanError.id = `${campo.id}-error`;
        spanError.classList.add("mensaje-error");
        campo.parentNode.insertBefore(spanError, campo.nextSibling);
    }
    spanError.textContent = mensaje;
}

// QUITAR ERROR DE UN CAMPO
function quitarError(campo) {
    campo.classList.remove("campo-error");
    const etiqueta = document.querySelector(`label[for="${campo.id}"]`);
    if (etiqueta !== null) {
        etiqueta.classList.remove("etiqueta-error");
    }
    const spanError = document.getElementById(`${campo.id}-error`);
    if (spanError !== null) {
        spanError.remove();
    }
}

// VALIDAR NOMBRE DE USUARIO
function validarUsuario(campo) {
    const valor = campo.value.trim();
    if (valor.length === 0) {
        mostrarError(campo, `El nombre de usuario es obligatorio.`);
        return false;
    }
    if (valor.length < 3 || valor.length > 15) {
        mostrarError(campo, `El nombre de usuario debe tener entre 3 y 15 caracteres.`);
        return false;
    }
    const primerCaracter = valor.charAt(0);
    if (esDigito(primerCaracter)) {
        mostrarError(campo, `El nombre de usuario no puede comenzar por un número.`);
        return false;
    }
    for (let i = 0; i < valor.length; i = i + 1) {
        const c = valor.charAt(i);
        if (!esLetraInglesa(c) && !esDigito(c)) {
            mostrarError(campo, `El nombre de usuario solo puede contener letras inglesas y números.`);
            return false;
        }
    }
    quitarError(campo);
    return true;
}

// VALIDAR CONTRASENA
function validarPassword(campo) {
    const valor = campo.value;
    if (valor.length === 0) {
        mostrarError(campo, `La contraseña es obligatoria.`);
        return false;
    }
    if (valor.length < 6 || valor.length > 15) {
        mostrarError(campo, `La contraseña debe tener entre 6 y 15 caracteres.`);
        return false;
    }
    let tieneMayuscula = false;
    let tieneMinuscula = false;
    let tieneNumero = false;
    for (let i = 0; i < valor.length; i = i + 1) {
        const c = valor.charAt(i);
        if (esLetraMayuscula(c)) {
            tieneMayuscula = true;
        } else if (esLetraMinuscula(c)) {
            tieneMinuscula = true;
        } else if (esDigito(c)) {
            tieneNumero = true;
        } else if (c !== "-" && c !== "_") {
            mostrarError(campo, `La contraseña solo puede contener letras inglesas, números, guion (-) y guion bajo (_).`);
            return false;
        }
    }
    if (!tieneMayuscula || !tieneMinuscula || !tieneNumero) {
        mostrarError(campo, `La contraseña debe contener al menos una mayúscula, una minúscula y un número.`);
        return false;
    }
    quitarError(campo);
    return true;
}

// VALIDAR REPETIR CONTRASENA
function validarRepetirPassword(campoRepetir, campoPassword) {
    const valorRepetir = campoRepetir.value;
    const valorPassword = campoPassword.value;
    if (valorRepetir.length === 0) {
        mostrarError(campoRepetir, `Debes repetir la contraseña.`);
        return false;
    }
    if (valorRepetir !== valorPassword) {
        mostrarError(campoRepetir, `Las contraseñas no coinciden.`);
        return false;
    }
    quitarError(campoRepetir);
    return true;
}

// VALIDAR EMAIL
function validarEmail(campo) {
    const valor = campo.value.trim();
    if (valor.length === 0) {
        mostrarError(campo, `El correo electrónico es obligatorio.`);
        return false;
    }
    if (valor.length > 254) {
        mostrarError(campo, `El correo electrónico no puede superar los 254 caracteres.`);
        return false;
    }
    const primeraArroba = valor.indexOf("@");
    const ultimaArroba = valor.lastIndexOf("@");
    if (primeraArroba === -1 || primeraArroba !== ultimaArroba) {
        mostrarError(campo, `El correo debe contener exactamente un signo @.`);
        return false;
    }
    const partes = valor.split("@");
    const parteLocal = partes[0];
    const dominio = partes[1];
    if (parteLocal.length < 1 || parteLocal.length > 64) {
        mostrarError(campo, `La parte local debe tener entre 1 y 64 caracteres.`);
        return false;
    }
    if (dominio.length < 1 || dominio.length > 255) {
        mostrarError(campo, `El dominio debe tener entre 1 y 255 caracteres.`);
        return false;
    }
    if (parteLocal.startsWith(".") || parteLocal.endsWith(".")) {
        mostrarError(campo, `El punto no puede estar al principio ni al final de la parte local.`);
        return false;
    }
    if (parteLocal.includes("..")) {
        mostrarError(campo, `La parte local no puede tener dos puntos seguidos.`);
        return false;
    }
    for (let i = 0; i < parteLocal.length; i = i + 1) {
        const c = parteLocal.charAt(i);
        if (!esLetraInglesa(c) && !esDigito(c) && !esCaracterEspecialEmail(c) && c !== ".") {
            mostrarError(campo, `La parte local contiene un carácter no permitido (${c}).`);
            return false;
        }
    }
    const subdominios = dominio.split(".");
    for (let i = 0; i < subdominios.length; i = i + 1) {
        const sub = subdominios[i];
        if (sub.length < 1 || sub.length > 63) {
            mostrarError(campo, `Cada subdominio debe tener entre 1 y 63 caracteres.`);
            return false;
        }
        if (sub.startsWith("-") || sub.endsWith("-")) {
            mostrarError(campo, `El guion no puede estar al principio ni al final de un subdominio.`);
            return false;
        }
        for (let j = 0; j < sub.length; j = j + 1) {
            const c = sub.charAt(j);
            if (!esLetraInglesa(c) && !esDigito(c) && c !== "-") {
                mostrarError(campo, `El subdominio contiene un carácter no permitido (${c}).`);
                return false;
            }
        }
    }
    quitarError(campo);
    return true;
}

// VALIDAR SEXO
function validarSexo(campo) {
    if (campo.value === "") {
        mostrarError(campo, `Debes seleccionar una opción para el sexo.`);
        return false;
    }
    quitarError(campo);
    return true;
}

// VALIDAR FECHA DE NACIMIENTO
function validarFechaNacimiento(campo) {
    const valor = campo.value.trim();
    if (valor.length === 0) {
        mostrarError(campo, `La fecha de nacimiento es obligatoria.`);
        return false;
    }
    let separador = "";
    if (valor.includes("/")) {
        separador = "/";
    } else if (valor.includes("-")) {
        separador = "-";
    } else {
        mostrarError(campo, `El formato de fecha debe ser DD/MM/AAAA.`);
        return false;
    }
    const partes = valor.split(separador);
    if (partes.length !== 3) {
        mostrarError(campo, `El formato de fecha debe ser DD/MM/AAAA.`);
        return false;
    }
    for (let p = 0; p < partes.length; p = p + 1) {
        const parte = partes[p];
        if (parte.length === 0) {
            mostrarError(campo, `La fecha introducida no es válida.`);
            return false;
        }
        for (let k = 0; k < parte.length; k = k + 1) {
            if (!esDigito(parte.charAt(k))) {
                mostrarError(campo, `La fecha solo puede contener números y separadores.`);
                return false;
            }
        }
    }
    let dia = 0;
    let mes = 0;
    let anio = 0;
    if (partes[0].length <= 2 && partes[2].length === 4) {
        dia = parseInt(partes[0], 10);
        mes = parseInt(partes[1], 10);
        anio = parseInt(partes[2], 10);
    } else if (partes[0].length === 4 && partes[2].length <= 2) {
        anio = parseInt(partes[0], 10);
        mes = parseInt(partes[1], 10);
        dia = parseInt(partes[2], 10);
    } else {
        mostrarError(campo, `El año debe tener 4 dígitos (DD/MM/AAAA).`);
        return false;
    }
    if (isNaN(dia) || isNaN(mes) || isNaN(anio) || dia <= 0 || mes <= 0 || anio <= 0) {
        mostrarError(campo, `La fecha introducida no es válida.`);
        return false;
    }
    const fecha = new Date(anio, mes - 1, dia);
    if (fecha.getFullYear() !== anio || fecha.getMonth() !== (mes - 1) || fecha.getDate() !== dia) {
        mostrarError(campo, `La fecha no existe en el calendario.`);
        return false;
    }
    const hoy = new Date();
    const anioHoy = hoy.getFullYear();
    const mesHoy = hoy.getMonth();
    const diaHoy = hoy.getDate();
    if (anio > anioHoy || (anio === anioHoy && (mes - 1) > mesHoy) || (anio === anioHoy && (mes - 1) === mesHoy && dia > diaHoy)) {
        mostrarError(campo, `La fecha de nacimiento no puede ser futura.`);
        return false;
    }
    let edad = anioHoy - anio;
    if (mesHoy < (mes - 1) || (mesHoy === (mes - 1) && diaHoy < dia)) {
        edad = edad - 1;
    }
    if (edad < 18) {
        mostrarError(campo, `Debes tener al menos 18 años cumplidos a fecha de hoy.`);
        return false;
    }
    quitarError(campo);
    return true;
}

// VALIDAR FORMULARIO DE REGISTRO
function validarRegistro(evento) {
    let esValido = true;
    const campoNombre = document.getElementById("nombre");
    const campoPassword = document.getElementById("password");
    const campoRepetir = document.getElementById("repetir_password");
    const campoEmail = document.getElementById("email");
    const campoSexo = document.getElementById("sexo");
    const campoFecha = document.getElementById("fecha_nacimiento");

    if (!validarUsuario(campoNombre)) {
        esValido = false;
    }
    if (!validarPassword(campoPassword)) {
        esValido = false;
    }
    if (!validarRepetirPassword(campoRepetir, campoPassword)) {
        esValido = false;
    }
    if (!validarEmail(campoEmail)) {
        esValido = false;
    }
    if (!validarSexo(campoSexo)) {
        esValido = false;
    }
    if (!validarFechaNacimiento(campoFecha)) {
        esValido = false;
    }

    if (!esValido) {
        evento.preventDefault();
    }
}

// INICIALIZACION AL CARGAR EL DOM
document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.getElementById("formRegistro");
    const campoNombre = document.getElementById("nombre");
    const campoPassword = document.getElementById("password");
    const campoRepetir = document.getElementById("repetir_password");
    const campoEmail = document.getElementById("email");
    const campoSexo = document.getElementById("sexo");
    const campoFecha = document.getElementById("fecha_nacimiento");

    if (formulario !== null) {
        formulario.addEventListener("submit", validarRegistro);
        formulario.addEventListener("reset", () => {
            quitarError(campoNombre);
            quitarError(campoPassword);
            quitarError(campoRepetir);
            quitarError(campoEmail);
            quitarError(campoSexo);
            quitarError(campoFecha);
        });
    }

    if (campoNombre !== null) {
        campoNombre.addEventListener("input", () => {
            if (campoNombre.classList.contains("campo-error")) {
                validarUsuario(campoNombre);
            }
        });
    }

    if (campoPassword !== null) {
        campoPassword.addEventListener("input", () => {
            if (campoPassword.classList.contains("campo-error")) {
                validarPassword(campoPassword);
            }
            if (campoRepetir !== null && campoRepetir.value.length > 0) {
                validarRepetirPassword(campoRepetir, campoPassword);
            }
        });
    }

    if (campoRepetir !== null) {
        campoRepetir.addEventListener("input", () => {
            if (campoRepetir.classList.contains("campo-error")) {
                validarRepetirPassword(campoRepetir, campoPassword);
            }
        });
    }

    if (campoEmail !== null) {
        campoEmail.addEventListener("input", () => {
            if (campoEmail.classList.contains("campo-error")) {
                validarEmail(campoEmail);
            }
        });
    }

    if (campoSexo !== null) {
        campoSexo.addEventListener("change", () => {
            validarSexo(campoSexo);
        });
    }

    if (campoFecha !== null) {
        campoFecha.addEventListener("input", () => {
            if (campoFecha.classList.contains("campo-error")) {
                validarFechaNacimiento(campoFecha);
            }
        });
    }
});

