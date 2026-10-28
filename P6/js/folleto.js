document.addEventListener("DOMContentLoaded", () => {
    const formularioTitulo = document.querySelector("h3");
    const seccion = document.querySelector("section");

    const btnCostes = document.createElement("button");
    btnCostes.type = "button";
    btnCostes.id = "btnCostes"
    btnCostes.textContent = "Mostrar posibles costes";

    // 3. Creamos la tabla y la ocultamos por defecto
    const tablaCostes = document.createElement("table");
    tablaCostes.style.display = "none";

    // --- CONSTRUIMOS EL THEAD (Encabezados) ---
    // Fila 1 de encabezados (Blanco y negro / Color)
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

    // Fila 2 de encabezados (Páginas, fotos, resoluciones)
    const tr2 = document.createElement("tr");
    const titulosColumnas = ["Número de páginas", "Número de fotos", "150-300 dpi", "450-900 dpi", "150-300 dpi", "450-900 dpi"];
    for (let titulo of titulosColumnas) {
        const th = document.createElement("th");
        th.textContent = titulo;
        tr2.appendChild(th);
    }
    tablaCostes.appendChild(tr2);

    // --- CONSTRUIMOS EL TBODY (Filas de datos) ---
    for (let pag = 1; pag <= 15; pag++) {
        const tr = document.createElement("tr");
        const fotos = pag * 3; // 3 fotos por página

        // Calcular el coste de las páginas en bloque (estilo factura del agua)
        let costeBasePaginas = 10; // 10€ de procesamiento y envío
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
        const costeBN_Baja = costeBasePaginas; // BN (0€) + Baja res (0€)
        const costeBN_Alta = costeBasePaginas + (fotos * 0.2); // BN (0€) + Alta res (0.2€ x foto)
        const costeColor_Baja = costeBasePaginas + (fotos * 0.5); // Color (0.5€ x foto) + Baja res (0€)
        const costeColor_Alta = costeBasePaginas + (fotos * 0.5) + (fotos * 0.2); // Color (0.5€) + Alta res (0.2€)

        // Preparamos los datos de la fila formateando los euros
        const datosFila = [
            pag,
            fotos,
            formatearEuro(costeBN_Baja),
            formatearEuro(costeBN_Alta),
            formatearEuro(costeColor_Baja),
            formatearEuro(costeColor_Alta)
        ];

        // Rellenamos los <td> de la fila
        for (let dato of datosFila) {
            const td = document.createElement("td");
            td.textContent = dato;
            tr.appendChild(td);
        }
        
        // Añadimos la fila a la tabla
        tablaCostes.appendChild(tr);
    }

    // 4. Lógica del botón (mostrar / ocultar usando style.display)
    btnCostes.addEventListener("click", () => {
        if (tablaCostes.style.display === "none") {
            tablaCostes.style.display = "table";
            btnCostes.textContent = "Ocultar posibles costes";
        } else {
            tablaCostes.style.display = "none";
            btnCostes.textContent = "Mostrar posibles costes";
        }
    });

    // 5. Inyectamos el botón y la tabla en el DOM antes del H3
    seccion.insertBefore(btnCostes, formularioTitulo);
    seccion.insertBefore(tablaCostes, formularioTitulo);
});

// Función de ayuda para formatear a "XX,XX €"
function formatearEuro(numero) {
    return numero.toFixed(2).replace('.', ',') + " €";
}