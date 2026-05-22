const btnGuardar=document.getElementById("btn-boletos");
const inputsDeBoletos=document.querySelectorAll(".formulario-cliente");
const formulario=document.getElementById("contenedorLlenarBoletos"); 

function validarBoletos(e){
    inputsDeBoletos.forEach(i=>{
        const a_paterno=document.getElementById(`a_paterno-${i.id}`); 
        const a_materno=document.getElementById(`a_materno-${i.id}`); 
        const nombre=document.getElementById(`nombre-${i.id}`); 
        if(!nombre.value.trim()){
            nombre.focus(); 
            alert("Llene el campo de nombre para continuar"); 
            e.preventDefault(); 
            return;
        }
        else if(!a_materno.value.trim()){
            a_materno.focus(); 
            alert("Llene el campo con sus apellidos maternos para continuar"); 
            e.preventDefault(); 
            return;
        }
        else if(!a_paterno.value.trim()){
            a_paterno.focus(); 
           alert("Llene el campo con sus apellidos paternos para continuar"); 
           e.preventDefault(); 
           return;
        }
        
    }); 
}

formulario.addEventListener('submit',validarBoletos); 