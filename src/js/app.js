let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const servicio = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    taxis: []
}


document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){  
    mostrarSeccion(); //Muestra y oculta las secciones
    tabs(); //Cambia la seccion cuando se presionen los tabs
    botonesPaginador(); //Agrega o quita los botones del paginador
    paginaAnterior();
    paginaSiguiente();

    consultarAPI(); //Consulta la API en el backend de PHP

    idCliente(); //Añade el id del cliente al objeto de servicio
    nombreCliente(); //Añade el nombre del cliente al objeto de servicio
    seleccionarFecha(); //Añade la fecha de la servicio en el objeto
    seleccionarHora(); //Añade la hora de la servicio en el objeto

    mostrarResumen(); //Muestra el resumen del servicio
}

function mostrarSeccion(){
    //Ocultar la seecion que tenga la clase demostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //Quitar la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton =>{
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    })
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarResumen();
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial)return;
        paso--;

        botonesPaginador();
    })
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal)return;
        paso++;

        botonesPaginador();
    })
}

async function consultarAPI(){

    try {
        const url = '/api/taxis';
        const resultado = await fetch(url);
        const taxis = await resultado.json();
        mostrarTaxis(taxis); 

    } catch (error) {
        console.log(error)
    }

}

function mostrarTaxis(taxis){
    taxis.forEach(taxi => {
        const {id, conductor, placa, disponibilidad, tarifa} = taxi;

        const conductorTaxi = document.createElement('P');
        conductorTaxi.classList.add('conductor-taxi');
        conductorTaxi.textContent = conductor;

        const placaTaxi = document.createElement('P');
        placaTaxi.classList.add('placa-taxi');
        placaTaxi.textContent = `#${placa}`;

        const tarifaTaxi = document.createElement('P');
        tarifaTaxi.classList.add('tarifa-taxi');
        tarifaTaxi.textContent = `$${tarifa}`;

        const disponibilidadTaxi = document.createElement('P');
        disponibilidadTaxi.classList.add('disponibilidad-taxi');
        if(disponibilidad == 1){
            disponibilidadTaxi.textContent = 'Disponible';
        }else{
            disponibilidadTaxi.textContent = 'Ocupado';
        }

        const taxiDiv = document.createElement('DIV');
        taxiDiv.classList.add('taxi');
        taxiDiv.dataset.idTaxi = id;
        taxiDiv.onclick = function(){
            seleccionarTaxi(taxi);
        }

        taxiDiv.appendChild(conductorTaxi);
        taxiDiv.appendChild(placaTaxi);
        taxiDiv.appendChild(disponibilidadTaxi);
        taxiDiv.appendChild(tarifaTaxi);

        document.querySelector('#taxis').appendChild(taxiDiv);
    })
}

function seleccionarTaxi(taxi){
    const {id} = taxi;
    const {taxis} = servicio;

    //Identificar el elemneto al que se la da clcik
    const divTaxi = document.querySelector(`[data-id-taxi="${id}"]`)

    //Comprobar si un servicio ya fue agregado
    if (taxis.some(agregado => agregado.id === id)) {
        //Eliminarlo
        servicio.taxis = taxis.filter(agregado => agregado.id !== id)
        divTaxi.classList.remove('seleccionado');
    }else{
        //Agregarlo
        servicio.taxis = [...taxis, taxi]; 
        divTaxi.classList.add('seleccionado');
    }
}

function idCliente(){
    servicio.id = document.querySelector('#id').value;
}

function nombreCliente(){
    servicio.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){

        const dia = new Date(e.target.value).getUTCDay();

        if( [6, 0].includes(dia) ){ //El 6 y el 0 hacen referencia a los dias sabados y domingos
            e.target.value = '';
            mostrarAlerta('fines de semana no permitidos', 'error', '.formulario');
        }else{
            servicio.fecha = e.target.value;
        }
    });
}

function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){

        const horaServicio = e.target.value;
        const hora = horaServicio.split(":")[0];
        if (hora < 10 || hora > 18) {
            e.target.value = '';
            mostrarAlerta('Hora no valida', 'error', '.formulario')
        }else{
            servicio.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    //Previenen que se genere mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia){
        alertaPrevia.remove();
    }

    //Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if (desaparece) {
        //Eliminar la alerta
        setTimeout(()=>{
            alerta.remove();
        }, 2000)
    }
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');

    //Limpiar el contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(servicio).includes('') || servicio.taxis.length === 0) { //Aqui iteramos sobre el objeto de servicios
        mostrarAlerta('Faltan datos de servicios, fecha u hora', 'error', '.contenido-resumen', false)

        return;
    }
    
    //Formatear el div de resumen
    const {nombre, fecha, hora, taxis} = servicio;

    //Heading para taxis y resumen
    const headingTaxis = document.createElement('H3');
    headingTaxis.textContent = 'Resumen de taxis a solicitar';
    resumen.appendChild(headingTaxis);

    //Iterando y mostrando los taxis
    taxis.forEach(taxi => {
        const {id, placa, conductor} = taxi;
        const contenedorTaxi = document.createElement('DIV');
        contenedorTaxi.classList.add('contenedor-taxi');

        const conductorTaxi = document.createElement('P');
        conductorTaxi.innerHTML = `<span>Conductor:</span> ${conductor}`;

        const placaTaxi = document.createElement('P');
        placaTaxi.innerHTML = `<span>Placa:</span> ${placa}`;

        const tarifaMinima = document.createElement('P');
        tarifaMinima.innerHTML = '<span>Tarifa minima: </span>5.000';

        contenedorTaxi.appendChild(conductorTaxi);
        contenedorTaxi.appendChild(placaTaxi);
        contenedorTaxi.appendChild(tarifaMinima);

        resumen.appendChild(contenedorTaxi);
    });

    //Heading para servicio resumen
    const headingServicio = document.createElement('H3');
    headingServicio.textContent = 'Resumen de servicio';
    resumen.appendChild(headingServicio);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    const fechaFormateada = fechaUTC.toLocaleDateString('es-CO', opciones);

    const fechaServicio = document.createElement('P');
    fechaServicio.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaServicio = document.createElement('P');
    horaServicio.innerHTML = `<span>Hora:</span> ${hora} horas`;

    console.log(resumen);
    

    //Boton para crear un servicio
    const botonSolicitar= document.createElement('BUTTON');
    botonSolicitar.classList.add('boton');
    botonSolicitar.textContent = 'Solicitar Servicio';
    botonSolicitar.onclick = solicitarServicio;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaServicio);
    resumen.appendChild(horaServicio);

    resumen.appendChild(botonSolicitar);

}

async function solicitarServicio(){

    const {nombre, fecha, hora, taxis, id} = servicio;

    const idtaxis = taxis.map(servicio => servicio.id);

    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);
    datos.append('taxis', idtaxis);

    try {
        //Peticion hacia la API
        const url = '/api/servicios';

        const respuesta = await fetch(url, { 
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado.resultado);

        if(resultado.resultado){
            Swal.fire({
                icon: 'success',
                title: 'Servicio Confirmado',
                text: 'Tu servicio fue solicitado correctamente',
                button: 'Ok'
            }).then(() =>{ //Usamos la funcion then con el callback de reload para recargar la pagina
                setTimeout(() =>{
                    window.location.reload();
                }, 3000)
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar el servicio'
          })
    }
}