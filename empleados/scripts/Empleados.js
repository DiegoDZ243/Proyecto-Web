const formulario = document.getElementById("formEmpleado");

formulario.addEventListener("submit", function(event){

    const nombre = document.getElementById("nombre").value;

    const paterno = document.getElementById("a_paterno").value;

    const materno = document.getElementById("a_materno").value;

    const sueldo = document.getElementById("sueldo").value;

    if(

        nombre == "" ||
        paterno == "" ||
        materno == "" ||
        sueldo == ""

    ){

        alert("Completa todos los campos");

        event.preventDefault();

    }

});