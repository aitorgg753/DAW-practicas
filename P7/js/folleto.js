document.addEventListener("DOMContentLoaded", () => {

    //---------------- Variables para la tabla -----------------

    const formularioTitulo = document.querySelector("h3");
    const seccion = document.querySelector("section");

    const btnCostes = document.createElement("button");
    btnCostes.type = "button";
    btnCostes.id = "btnCostes"
    btnCostes.textContent = "Mostrar posibles costes";

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

const texto_adicional = document.getElementById("texto_adicional");
const nombre = document.getElementById("nombre");
const email = document.getElementById("email");
const calle = document.getElementById("calle");
const numero = document.getElementById("numero");
const cp = document.getElementById("cp");
const color_portada = document.getElementById("color_portada");
const copias = document.getElementById("copias");

/*-----------------------------------------------------------
CREACIÓN DE LA TABLA
-----------------------------------------------------------*/

    // Fila 2 de encabezados (Páginas, fotos, resoluciones)
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
                costeBasePaginas += 2.0; // Menos de 5 páginas
            } else if (i <= 10) {
                costeBasePaginas += 1.8; // Entre 5 y 10 páginas
            } else {
                costeBasePaginas += 1.6; // Más de 10 páginas
            }
        }

        // Calculamos los 4 escenarios de impresión
        const costeBN_Baja = costeBasePaginas;
        const costeBN_Alta = costeBasePaginas + (fotos * 0.2); 
        const costeColor_Baja = costeBasePaginas + (fotos * 0.5);
        const costeColor_Alta = costeBasePaginas + (fotos * 0.5) + (fotos * 0.2);

        // Formateamos los euros
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

    //  Lógica del botón mostrar / ocultar
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
});

// Función para formatear los euros (XX,XX €)
function formatearEuro(numero) {
    return numero.toFixed(2).replace('.', ',') + " €";
}


/*-----------------------------------------------------------
RESTRICCIONES  DEL FORMULARIO
-----------------------------------------------------------*/

