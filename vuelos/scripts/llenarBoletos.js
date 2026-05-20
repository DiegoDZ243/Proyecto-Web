const contenedorLlenarBoletos = document.getElementById("contenedorLlenarBoletos");

function generarBoletos(asiento) {

    const llenarBoleto = document.createElement("section");
    llenarBoleto.className = "cuerpo-llenar-boletos";

    const contenedorLlenado = document.createElement("div");
    contenedorLlenado.className = "contenedor-llenado";

    // FORMULARIO
    const formularioCliente = document.createElement("div");
    formularioCliente.className = "formulario-cliente";

    generarContenedorInput(`nombre-${asiento}`, "Nombre", formularioCliente);
    generarContenedorInput(`a_paterno-${asiento}`, "Apellido Paterno", formularioCliente);
    generarContenedorInput(`a_materno-${asiento}`, "Apellido Materno", formularioCliente);

    contenedorLlenado.appendChild(formularioCliente);

    // BOLETO
    const boleto = document.createElement("div");
    boleto.className = "boleto";

    // ENCABEZADO
    const encabezadoBoleto = document.createElement("div");
    encabezadoBoleto.className = "encabezado-boleto";

    const contenedorEncabezado = document.createElement("div");
    contenedorEncabezado.className = "contenedor-encabezado";

    const titulo = document.createElement("h4");
    titulo.className = "pase-abordaje";
    titulo.innerText = "Pase de Abordaje";

    const stickerAvion = document.createElement("img");
    stickerAvion.id = `stickerAvion-${asiento}`;

    contenedorEncabezado.appendChild(titulo);
    contenedorEncabezado.appendChild(stickerAvion);

    const contenedorAerolinea = document.createElement("div");
    contenedorAerolinea.className = "contenedor-nombre-aerolinea";

    const nombreAerolinea = document.createElement("h3");
    nombreAerolinea.className = "nombre-aerolinea";
    nombreAerolinea.innerText = "AeroPHP";

    const logo = document.createElement("img");
    logo.id = `logoAeropuerto-${asiento}`;

    contenedorAerolinea.appendChild(nombreAerolinea);
    contenedorAerolinea.appendChild(logo);

    encabezadoBoleto.appendChild(contenedorEncabezado);
    encabezadoBoleto.appendChild(contenedorAerolinea);

    // CUERPO BOLETO
    const cuerpoBoleto = document.createElement("div");
    cuerpoBoleto.className = "cuerpo-boleto";

    const contNombre = document.createElement("section");
    contNombre.className = "contenedor-nombre";

    const h3Nombre = document.createElement("h3");
    h3Nombre.innerText = "Nombre del pasajero:";

    const h4Nombre = document.createElement("h4");
    h4Nombre.id = `nombre-pasajero-${asiento}`;
    h4Nombre.innerText = "-----";

    contNombre.appendChild(h3Nombre);
    contNombre.appendChild(h4Nombre);

    const contBarcode = document.createElement("section");
    contBarcode.className = "contenedor-codigo-barras";

    const imgBarcode = document.createElement("img");
    imgBarcode.id = `codigo-abordaje-${asiento}`;

    contBarcode.appendChild(imgBarcode);

    cuerpoBoleto.appendChild(contNombre);
    cuerpoBoleto.appendChild(contBarcode);

    // PIE
    const pieBoleto = document.createElement("div");
    pieBoleto.className = "pie-boleto";

    const contDestino = document.createElement("div");
    contDestino.className = "contenedor-destino";

    contDestino.innerHTML = `
        <h3>Destino:</h3>
        <h5>-----</h5>
    `;

    const contFechaHora = document.createElement("div");
    contFechaHora.className = "contenedor-fecha-y-hora";

    contFechaHora.innerHTML = `
        <div class="contenedor-fecha">
            <h3>Fecha:</h3>
            <h5>-----</h5>
        </div>
        <div class="contenedor-hora">
            <h3>Hora:</h3>
            <h5>-----</h5>
        </div>
    `;

    const contAsiento = document.createElement("div");
    contAsiento.className = "contenedor-asiento";

    contAsiento.innerHTML = `
        <h3>Asiento: ${asiento}</h3>
    `;

    pieBoleto.appendChild(contDestino);
    pieBoleto.appendChild(contFechaHora);
    pieBoleto.appendChild(contAsiento);

    // ARMADO FINAL
    boleto.appendChild(encabezadoBoleto);
    boleto.appendChild(cuerpoBoleto);
    boleto.appendChild(pieBoleto);

    contenedorLlenado.appendChild(boleto);
    llenarBoleto.appendChild(contenedorLlenado);

    contenedorLlenarBoletos.appendChild(llenarBoleto);
}

function generarContenedorInput(nombre,campo,padre){
    const contenedorInput=document.createElement("div"); 
    const labelInput=document.createElement("label"); 
    const input=document.createElement("input"); 

    contenedorInput.className="contenedor-input";
    labelInput.innerText=campo+": "; 
    input.name=nombre; 
    contenedorInput.appendChild(labelInput); 
    contenedorInput.appendChild(input); 
    padre.appendChild(contenedorInput); 
}

generarBoletos('A1'); 