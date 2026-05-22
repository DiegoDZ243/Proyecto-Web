const destino=document.getElementById("input-nombre"); 
const url=document.getElementById("input-url"); 
const imagen=document.getElementById("imagen-destino"); 
const formulario=document.getElementById("formulario-destino"); 
const contenedorError=document.getElementById("contenedor-error"); 
const textoError=document.getElementById("texto-error"); 



formulario.addEventListener('submit',(e)=>{
    if(!destino.value.trim()){
        textoError.innerText="Complete el campo de destino"; 
        contenedorError.style.display="flex"; 
        e.preventDefault();
        return;
    }
}); 

destino.addEventListener('change',()=>{
    if(destino.value.trim()){
        contenedorError.style.display="none"; 
    }
}); 

url.addEventListener('change',(e)=>{
    if(!url.value.trim()){
        imagen.src='img/imagen-default.jpg'; 
    }
    else{
        imagen.src=url.value.trim(); 
    }
}); 

imagen.onerror = () => {
    imagen.src = "img/imagen-default.jpg";
    textoError.innerText="Imagen no encontrada. Se procede con imagen default"; 
    contenedorError.style.display="flex"; 
};