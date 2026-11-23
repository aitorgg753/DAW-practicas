document.addEventListener("DOMContentLoaded", () => {

    //---------------- Variables para la tabla -----------------
    const formularioTitulo = document.querySelector("h3");
    const seccion = document.querySelector("section");

    const btnCostes = document.createElement("button");
    btnCostes.type = "button";
    btnCostes.id = "btnCostes";
    btnCostes.textContent = "Mostrar posibles costes";
    btnCostes.style.display = "block";
    btnCostes.style.margin = "20px 0";

    const tablaCostes = document.createElement("table");
    tablaCostes.style.display = "none";

    const tr1 = document.createElement("tr");
    
    const thVacio = document.createElement("th");
    thVacio.colSpan = 2; // Ocupa las dos primeras columnas
    tr1.appendChild(thVacio);

    const thBN = document.createElement("th");
    thBN.colSpan = 2;
    thBN.textContent = "Blanco y negro";
    tr1.appendChild(thBN);

    const thColor = document.createElement("th");
    thColor.colSpan = 2;
    thColor.textContent = "Color";
    tr1.appendChild(thColor);

    tablaCostes.appendChild(tr1);

    //---------------- Variables para el formulario -----------------
    const formulario = document.querySelector("form");
    const texto_adicional = document.getElementById("texto_adicional");
    const nombre = document.getElementById("nombre");
    const email = document.getElementById("email");
    const calle = document.getElementById("calle");
    const numero = document.getElementById("numero");
    const cp = document.getElementById("cp");
    const localidad = document.getElementById("localidad");
    const provincia = document.getElementById("provincia");
    const copias = document.getElementById("copias");
    const anuncio = document.getElementById("anuncio");

    /*-----------------------------------------------------------
    CREACIÓN DE LA TABLA
    -----------------------------------------------------------*/
    const tr2 = document.createElement("tr");
    const titulosColumnas = ["Número de páginas", "Número de fotos", "150-300 dpi", "450-900 dpi", "150-300 dpi", "450-900 dpi"];
    for (let titulo of titulosColumnas) {
        const th = document.createElement("th");
        th.textContent = titulo;
        tr2.appendChild(th);
    }
    tablaCostes.appendChild(tr2);

    for (let pag = 1; pag <= 15; pag++) {
        const tr = document.createElement("tr");
        const fotos = pag * 3; // 3 fotos por página

        let costeBasePaginas = 10;
        for (let i = 1; i <= pag; i++) {
            if (i < 5) {
                costeBasePaginas += 2.0;
            } else if (i <= 10) {
                costeBasePaginas += 1.8;
            } else {
                costeBasePaginas += 1.6;
            }
        }

        const costeBN_Baja = costeBasePaginas;
        const costeBN_Alta = costeBasePaginas + (fotos * 0.2); 
        const costeColor_Baja = costeBasePaginas + (fotos * 0.5);
        const costeColor_Alta = costeBasePaginas + (fotos * 0.5) + (fotos * 0.2);

        const datosFila = [
            pag,
            fotos,
            formatearEuro(costeBN_Baja),
            formatearEuro(costeBN_Alta),
            formatearEuro(costeColor_Baja),
            formatearEuro(costeColor_Alta)
        ];

        for (let dato of datosFila) {
            const td = document.createElement("td");
            td.textContent = dato;
            tr.appendChild(td);
        }
        tablaCostes.appendChild(tr);
    }

    btnCostes.addEventListener("click", () => {
        if (tablaCostes.style.display === "none") {
            tablaCostes.style.display = "table";
            btnCostes.textContent = "Ocultar posibles costes";
        } else {
            tablaCostes.style.display = "none";
            btnCostes.textContent = "Mostrar posibles costes";
        }
    });

    seccion.insertBefore(btnCostes, formularioTitulo);
    seccion.insertBefore(tablaCostes, formularioTitulo);

    /*-----------------------------------------------------------
    RESTRICCIONES DEL FORMULARIO
    -----------------------------------------------------------*/

    function mostrarError(elemento, mensaje) {
        elemento.style.border = "2px solid red";
        
        const spanError = document.createElement("span");
        spanError.textContent = mensaje;
        spanError.style.color = "red";
        spanError.style.fontSize = "0.9em";
        spanError.style.display = "block";
        spanError.style.marginTop = "5px";
        spanError.className = "mensaje-error-js"; // Clase para poder borrarlos luego

        // Insertamos el error justo después del elemento
        elemento.parentNode.insertBefore(spanError, elemento.nextSibling);
    }

    // Función para limpiar los errores antes de volver a validar
    function limpiarErrores() {
        const errores = document.querySelectorAll(".mensaje-error-js");
        errores.forEach(error => error.remove());

        // Restaurar bordes de todos los inputs y selects
        const elementos = formulario.querySelectorAll("input, select, textarea");
        elementos.forEach(el => el.style.border = "");
    }

    formulario.addEventListener("submit", (event) => {
        limpiarErrores();
        let hayErrores = false;

        //  TEXTO ADICIONAL (Max 4000)
        if (texto_adicional.value.length > 4000) {
            mostrarError(texto_adicional, "El texto no puede superar los 4000 caracteres.");
            hayErrores = true;
        }

        //  NOMBRE (Obligatorio, Max 200)
        const valorNombre = nombre.value.trim();
        if (valorNombre.length === 0) {
            mostrarError(nombre, "El nombre es obligatorio.");
            hayErrores = true;
        } else if (valorNombre.length > 200) {
            mostrarError(nombre, "El nombre no puede superar los 200 caracteres.");
            hayErrores = true;
        }

        //  EMAIL (Obligatorio, Max 200, debe tener @ y .)
        const valorEmail = email.value.trim();
        if (valorEmail.length === 0) {
            mostrarError(email, "El correo electrónico es obligatorio.");
            hayErrores = true;
        } else if (valorEmail.length > 200) {
            mostrarError(email, "El correo no puede superar los 200 caracteres.");
            hayErrores = true;
        } else if (!valorEmail.includes("@") || !valorEmail.includes(".")) {
            mostrarError(email, "Formato de correo no válido.");
            hayErrores = true;
        }

        // DIRECCIÓN: CALLE y NÚMERO (Obligatorios)
        if (calle.value.trim().length === 0) {
            mostrarError(calle, "La calle es obligatoria.");
            hayErrores = true;
        }
        if (numero.value.trim().length === 0) {
            mostrarError(numero, "El número es obligatorio.");
            hayErrores = true;
        }

        // DIRECCIÓN: CP (Obligatorio, exactamente 5 dígitos, solo números)
        const valorCp = cp.value.trim();
        if (valorCp.length === 0) {
            mostrarError(cp, "El código postal es obligatorio.");
            hayErrores = true;
        } else if (valorCp.length !== 5) {
            mostrarError(cp, "El código postal debe tener exactamente 5 dígitos.");
            hayErrores = true;
        } else {
            let cpEsNumero = true;
            for (let i = 0; i < valorCp.length; i++) {
                let codigo = valorCp.charCodeAt(i); // Muestra el código del caracter en ASCII
                if (codigo < 48 || codigo > 57) {
                    cpEsNumero = false;
                    break;
                }
            }
            if (!cpEsNumero) {
                mostrarError(cp, "El código postal solo puede contener números.");
                hayErrores = true;
            }
        }

        //  LOCALIDAD Y PROVINCIA (Obligatorios)
        if (localidad.value === "") {
            mostrarError(localidad, "Debes seleccionar una localidad.");
            hayErrores = true;
        }
        if (provincia.value === "") {
            mostrarError(provincia, "Debes seleccionar una provincia.");
            hayErrores = true;
        }

        // NÚMERO DE COPIAS (Obligatorio, min 1, max 99)
        const valorCopias = parseInt(copias.value, 10);
        if (copias.value.trim().length === 0 || isNaN(valorCopias)) {
            mostrarError(copias, "El número de copias es obligatorio.");
            hayErrores = true;
        } else if (valorCopias < 1 || valorCopias > 99) {
            mostrarError(copias, "Debe ser un número entre 1 y 99.");
            hayErrores = true;
        }

        // ANUNCIO (Obligatorio)
        if (anuncio.value === "") {
            mostrarError(anuncio, "Debes seleccionar un anuncio.");
            hayErrores = true;
        }

        // Si existe cualquier error, detenemos el envío del formulario
        if (hayErrores) {
            event.preventDefault();
        }
    });
});

// Función para formatear los euros
function formatearEuro(numero) {
    return numero.toFixed(2).replace('.', ',') + " €";
}