import { apiRequest, showAlert } from './app.js';

document.addEventListener('DOMContentLoaded', () => {
    //showAlert('Asistencia registrada<br><br><b>Nombre:</b> Oscar Wilde, <b>Fecha:</b> 2024-12-11, <b>Hora:</b> 12:00:00', 'error', 0);
    /* REGISTRAR ASISTENCIAS */
    if( JSON.parse(localStorage.getItem('datosUser')).fechaAsistencia ){
        document.querySelector('#acciones-header #btn-asistencia').textContent = 'Registro de Salida';
        document.querySelector('#form-registroAsistencia .titulo').textContent = 'Registro de Salida';
        document.querySelector('#form-registroAsistencia').addEventListener('submit', registrarSalida);
    }else{
        document.querySelector('#form-registroAsistencia').addEventListener('submit', registrarAsistencia);
    }
});

/* REGISTRAR ENTRADA */
function registrarAsistencia(e) {
    e.preventDefault(); 
    
    const data = {
        ...Object.fromEntries(new FormData(e.target)),
        'id_personal': JSON.parse(localStorage.getItem('datosUser')).id_personal,
        'fecha_asistencia': new Date().toLocaleDateString('en-CA'), // 'en-CA' format is YYYY-MM-DD
        'hora_entrada': new Date().toTimeString().split(' ')[0]
    }
    const nombres = JSON.parse(localStorage.getItem('datosUser')).nombres;

    document.getElementById('modal-resgitroAsistencia').style.display = 'none';
    console.log(data);

    apiRequest(`${BASE_URL}/Personal/registrarEntrada`, 'POST', data)
    .then(res => {
        console.log(res);
        if(res.message){
            localStorage.setItem('datosUser', JSON.stringify({
                ...JSON.parse(localStorage.getItem('datosUser')),
                fechaAsistencia: data.fecha_asistencia,
                horaEntrada: data.hora_entrada
            }));
            const mensaje = `${res.message}<br><br> <b>Nombre:</b> ${nombres} <b>Fecha:</b> ${data.fecha_asistencia}, <b>Hora:</b> ${data.hora_entrada}`;
            showAlert(mensaje, 'success');
            document.querySelector('#acciones-header #btn-asistencia').textContent = 'Registro de Salida';
            document.querySelector('#form-registroAsistencia .titulo').textContent = 'Registro de Salida';
            document.querySelector('#form-registroAsistencia').removeEventListener('submit', registrarAsistencia);
            document.querySelector('#form-registroAsistencia').addEventListener('submit', registrarSalida);
        }else{
            showAlert(res.error, 'error');
        }
    }).catch(err => console.error(err));
}

/* REGISTRAR SALIDA */
function registrarSalida(e) {
    e.preventDefault();

    const data = {
        ...Object.fromEntries(new FormData(e.target)),
        'id_personal': JSON.parse(localStorage.getItem('datosUser')).id_personal,
        'fecha_asistencia': new Date().toLocaleDateString('en-CA'), // 'en-CA' format is YYYY-MM-DD
        'hora_salida': new Date().toTimeString().split(' ')[0]
    }
    document.getElementById('modal-resgitroAsistencia').style.display = 'none';
    console.log(data);
    apiRequest(`${BASE_URL}/Personal/registrarSalida`, 'POST', data)
    .then(res => {
        console.log(res);
        if(res.message){
            const datosUser = JSON.parse( localStorage.getItem('datosUser') );
            const mensaje = `
                            ${res.message}<br><br>
                            <b>Nombre:</b> ${datosUser.nombres} <b>DNI:</b> ${datosUser.dni}<br>
                            <b>Fecha:</b> ${datosUser.fechaAsistencia}, <b>Hora de entrada:</b> ${datosUser.horaEntrada} <br>
                            <b>Hora de salida: </b> ${data.hora_salida}`;
            showAlert(mensaje, 'success', 1);
            document.querySelector('#acciones-header #btn-asistencia').disabled = true;return;
            document.querySelector('#form-registroAsistencia .titulo').textContent = 'Registro de Entrada';
            document.querySelector('#form-registroAsistencia').removeEventListener('submit', registrarSalida);
            document.querySelector('#form-registroAsistencia').addEventListener('submit', registrarAsistencia);
        }else{
            showAlert(res.error, 'error');
        }
    }).catch(err => console.error(err));
}