document.addEventListener('DOMContentLoaded', function() {  // asegura que el codigo se ejecute hasta que el DOM este completamente cargado
    
    eventListeners();

    darkMode(); // llama a la funcion darkMode
}); 

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme :dark)');

    // console.log(prefiereDarkMode.matches);
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change',function(){
        
        if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });


    const botonDarkMode = document.querySelector('.dark-mode-boton'); // selecciona el boton de dark mode

    botonDarkMode.addEventListener('click', function() { // agrega el evento click al boton

        document.body.classList.toggle('dark-mode'); // agrega o quita la clase dark-mode al body
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu'); // selecciona el menu movil

    mobileMenu.addEventListener('click', navegacionResponsive); // agrega el evento click al menu movil

    // muestra los campos condicionales

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]'); // selecciona los input de contacto

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto)); // agrega el evento click a cada input de contacto

}

function navegacionResponsive() {

    const navegacion = document.querySelector('.navegacion'); // selecciona la navegacion

    navegacion.classList.toggle('mostrar'); // agrega o quita la clase mostrar
}   


function mostrarMetodosContacto(e) {

    const contactoDiv = document.querySelector('#contacto'); // selecciona el div de contacto

    if(e.target.value === 'telefono') { // si el valor del input es telefono

        contactoDiv.innerHTML = `
            <label for="telefono">Número De Teléfono</label>
            <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Tu teléfono">

            <p>Elija la fecha y hora para la llamada</p>

            <label for="fecha">fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `; // agrega el html al div de contacto
    } else { // si el valor del input es email

        contactoDiv.innerHTML = `
            <label for="email">Email</label>
            <input type="email" id="email" name="contacto[email]" placeholder="Tu email">
        `; // agrega el html al div de contacto
    }
}