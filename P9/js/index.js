// MOSTRAR ERROR
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

// QUITAR ERROR
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

// VALIDAR FORMULARIO DE LOGIN
function validarLogin(evento) {
    let esValido = true;
    const campoUsuario = document.getElementById("nomUsu");
    const campoPassword = document.getElementById("pwd");

    const valorUsuario = campoUsuario.value.trim();
    if (valorUsuario === "") {
        mostrarError(campoUsuario, `El nombre de usuario es obligatorio.`);
        esValido = false;
    } else {
        quitarError(campoUsuario);
    }

    const valorPassword = campoPassword.value.trim();
    if (valorPassword === "") {
        mostrarError(campoPassword, `La contraseña es obligatoria.`);
        esValido = false;
    } else {
        quitarError(campoPassword);
    }

    if (!esValido) {
        evento.preventDefault();
    }
}

// INICIALIZACION AL CARGAR EL DOM
document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.getElementById("iniSes");
    const campoUsuario = document.getElementById("nomUsu");
    const campoPassword = document.getElementById("pwd");

    if (formulario !== null) {
        formulario.addEventListener("submit", validarLogin);
    }

    if (campoUsuario !== null) {
        campoUsuario.addEventListener("input", () => {
            if (campoUsuario.value.trim() !== "") {
                quitarError(campoUsuario);
            }
        });
    }

    if (campoPassword !== null) {
        campoPassword.addEventListener("input", () => {
            if (campoPassword.value.trim() !== "") {
                quitarError(campoPassword);
            }
        });
    }
});

