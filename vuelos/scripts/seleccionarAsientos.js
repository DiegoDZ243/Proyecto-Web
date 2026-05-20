const contenedorMitadIzquierdaAvion=document.getElementById("avion-mitad1"); 
const contenedorMitadDerechaAvion=document.getElementById("avion-mitad2"); 
const btnConfirmar=document.getElementById("confirmarAsientos"); 
const dashBoardBoletos=document.getElementById("boletosCuerpo"); 


let asientosActuales=[];

function generarAsientos(){
    const letrasIzquierda=['A','B','C']; 
    const letrasDerecha=['D','E','F']; 

    for(let i=1;i<=8; i++){
        const filaActual=document.createElement("div"); 
        filaActual.className="fila-asientos";
        for(let j=0;j<letrasIzquierda.length;j++){
            const asiento=document.createElement("div"); 
            asiento.innerHTML=`${letrasIzquierda[j]}${i}`
            asiento.className="asiento";
            asiento.id=`asiento-${asiento.innerText}`;
           
            asiento.addEventListener('click',(e)=>{
                if(asiento.classList.contains('ocupado')) return; 
                if(asiento.classList.contains('seleccionado')){
                    asientosActuales=asientosActuales.filter(i=>i!==asiento.innerText);
                    quitarAsientoElegido(asiento.innerText); 
                }else{
                    asientosActuales.push(asiento.innerText);
                    generaAsientoElegido(asiento.innerText); 
                }
                asiento.classList.toggle('seleccionado'); 
                console.log(asientosActuales.toString()); 
            }); 
            filaActual.appendChild(asiento); 
        }
        contenedorMitadIzquierdaAvion.appendChild(filaActual); 
    }

    for(let i=1;i<=8;i++){
        const filaActual=document.createElement("div"); 
        filaActual.className="fila-asientos";
        for(let j=0;j<letrasDerecha.length;j++){
            const asiento=document.createElement("div"); 
            asiento.innerHTML=`${letrasDerecha[j]}${i}`;
            asiento.className="asiento";
            asiento.id=`asiento-${asiento.innerText}`;
            asiento.addEventListener('click',(e)=>{
                
                if(asiento.classList.contains('seleccionado')){
                    asientosActuales=asientosActuales.filter(i=>i!==asiento.innerText);
                    quitarAsientoElegido(asiento.innerText); 
                }else{
                    asientosActuales.push(asiento.innerText);
                    generaAsientoElegido(asiento.innerText); 
                }
                asiento.classList.toggle('seleccionado'); 
                console.log(asientosActuales.toString()); 
            }); 
            filaActual.appendChild(asiento); 

        }
        contenedorMitadDerechaAvion.appendChild(filaActual); 
    }
}

function generaAsientoElegido(asiento){
    const asiento_boleto=document.createElement("div"); 
    asiento_boleto.className="boleto-item"; 
    asiento_boleto.id=`asientoBoleto-${asiento}`; 
    const numeroAsiento=document.createElement("div"); 
    numeroAsiento.className="boleto-numero"; 
    numeroAsiento.innerHTML=asiento; 
    asiento_boleto.appendChild(numeroAsiento); 
    dashBoardBoletos.appendChild(asiento_boleto); 
}

function quitarAsientoElegido(asiento){
    const asientoAQuitar=document.getElementById(`asientoBoleto-${asiento}`); 
    dashBoardBoletos.removeChild(asientoAQuitar); 
}


btnConfirmar.addEventListener('click',(e)=>{
    const inputParaPost=document.getElementById("asientoInput"); 
    inputParaPost.value=asientosActuales.toString(); 
    
}); 

generarAsientos(); 