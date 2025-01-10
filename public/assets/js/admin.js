import { actualizarResgistro, apiRequest, eliminarRegistro, llernarSelect, nuevoRegistro, openModalEditar, showAlert } from "./app.js";
import { actualizarTabla } from "./app.js";

document.addEventListener('DOMContentLoaded', () => {

    /* Tab Menu */
    const tabHeaders = document.querySelectorAll('.tab-header');
    const tabPages = document.querySelectorAll('.tab-page');
    tabHeaders.forEach((head, i) => {
        head.addEventListener('click', () => {
            tabPages.forEach(page => page.style.display = "none");
            tabPages[i].style.display = "block";

            tabHeaders.forEach(header => {
                header.classList.remove('btn-black');
                header.classList.add('btn-blank');
            });
            head.classList.remove('btn-blank');
            head.classList.add('btn-black');
        })
    });

    actualizarTabla(`${BASE_URL}/admin/allAdmin`, 'table-admin', true);

    /* Obtener los elementos */

    //Conjunto de elementos
    const modalArray = document.querySelectorAll('.modal');
    const btnAgregar = document.querySelectorAll('.btn-agregar');
    const btnCerrar = document.querySelectorAll('.close');
    const modalForm = document.querySelectorAll('.form-modal');

    // Abrir el modal
    btnAgregar.forEach((item, i) => {
        item.onclick = () => {
            modalForm.forEach(form => form.reset()); //Limpia cada formulario
            modalArray[i].style.display = "block";
        }
    });

    // Cierra el modal
    btnCerrar.forEach((btn, i) => {
        btn.addEventListener('click', () => {
            modalArray[i].style.display = "none";
        })
    });

    // Cierra el modal al hacer clic fuera del contenido
    window.onclick = function(event) {
        modalArray.forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        })
    }

    


    /*--Obtener todos los Administradores --------------------------------------------------------------------*/
        document.querySelector('#admin-div').addEventListener('click', e => {
            const urlUpdate = `${BASE_URL}/admin/updateAdmin`;
            const urlGet = `${BASE_URL}/admin/allAdmin`;

            actualizarTabla(urlGet, 'table-admin', true);
            actualizarResgistro('form-admin', 'modal-admin', urlUpdate, urlGet, 'table-admin');

            // Abrir el modal de Admnistradores en modo Editar
            openModalEditar({
                idForm: 'form-admin',
                idTabla: 'table-admin',
                titulo: 'Editar Administrador',
                idModal: 'modal-admin'
            });

            // Eliminar Administrador
            eliminarRegistro(`${BASE_URL}/admin/disableAdmin`, 'table-admin', urlGet);
        });
    /* ------------------------------------------------------------------------------------------ */
        

    /*--Obtener todos los Personal --------------------------------------------------------------*/
        document.querySelector('#personal-div').addEventListener('click', e => {

            /* Obtener todas las areas para el select del formulario de busqueda avanzada */
            apiRequest(`${BASE_URL}/admin/allAreas`, 'GET')
            .then(data => {
                const areas = document.querySelector('#areas');
                areas.innerHTML = '';
                let option = `<option value=''>Selecciona un Área</option>`;
                data.datos.forEach(item => {
                    option += `<option value='${item.id_area}'>${item.nombre}</option>`;
                });
                areas.innerHTML = option;
            });

            /* Busqueda Avanzada */
            document.querySelector('#formulario-buscador').addEventListener('submit', e => {
                e.preventDefault();
                const data = Object.fromEntries( new FormData(e.target) );

                apiRequest(`${BASE_URL}/admin/buscarPersonal`, 'POST', data)
                .then(data => {
                    const tbody = document.querySelector('#table-personal tbody');
                    tbody.innerHTML = "";

                    if( data.datos ) {
                        data.datos.forEach(row => {
                            const tr = document.createElement('tr');

                            Object.keys(row).forEach(key => tr.innerHTML += `<td>${row[key] ?? '--'}</td>`);
                            tr.innerHTML += `
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red">Eliminar</button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        });
                    }else{
                        tbody.innerHTML = data.error;
                    }
                });
            });
            
            const urlUpdate = `${BASE_URL}/admin/updatePersonal`;
            const urlGet = `${BASE_URL}/admin/allPersonal`;

            actualizarTabla(urlGet, 'table-personal', true);
            actualizarResgistro('form-empleado', 'modal-empleado', urlUpdate, urlGet, 'table-personal');
            
            // Abrir modal empleado en modo Editar //
            openModalEditar({
                idForm: 'form-empleado',
                idTabla: 'table-personal',
                titulo: 'Editar Empleado',
                idModal: 'modal-empleado'
            });

            // Eliminar Empleado //
            eliminarRegistro(`${BASE_URL}/Personal/disablePersonal`, 'table-personal', urlGet);
        });
    /* ----------------------------------------------------------------------------------------- */

        
    /*--Obtener todas las Areas------------------------------------------------------------------*/
        document.querySelector('#areas-div').addEventListener('click', e => {
            
            const urlRewrite = `${BASE_URL}/admin/updateArea`;
            const urlGet = `${BASE_URL}/admin/allAreas`;

            actualizarTabla(urlGet, 'table-areas', true);
            actualizarResgistro('form-areas', 'modal-areas', urlRewrite, urlGet, 'table-areas');
        
            /* Abrir modal de Areas en modo editor */
            openModalEditar({
                idForm: 'form-areas',
                idTabla: 'table-areas',
                titulo: 'Editar Area',
                idModal: 'modal-areas'
            });

            // Eliminar Area //
            eliminarRegistro(`${BASE_URL}/admin/disableArea`, 'table-areas', urlGet);
        });
    /* ----------------------------------------------------------------------------------------- */


    /*--Obtener todas las Asistencias ---------------------------------------------------------- */
        document.querySelector('#asistencias-div').addEventListener('click', e => {
            // Obtener datos para el select de Personal //
            apiRequest(`${BASE_URL}/admin/allPersonal`, 'GET')
            .then(data => {
                if(data.datos) {
                    const select = document.querySelector('#form-asistencia #id-personal');
                    select.innerHTML = `<option value=''>Selecciona un personal</option>`;
                    data.datos.forEach(item => {
                        select.innerHTML += `<option value=${item.id_personal}>${item.nombres}</option>`;
                    });
                }
            }).catch(err => console.error(err));

            
            const urlUpdate = `${BASE_URL}/admin/updateAsistencia`;
            const urlGet = `${BASE_URL}/admin/allAsistencias`;

            actualizarTabla(urlGet, 'table-asistencias', true);
            // nuevas asistencias
            document.getElementById('agregarAsistencia').addEventListener('click', e => {
                actualizarResgistro('form-asistencia', 'modal-asistencia', `${BASE_URL}/admin/newAsistencia`, urlGet, 'table-asistencias');
            });
            // Editar asistencias
            document.querySelector('#table-asistencias').addEventListener('click', e => {
                if(e.target.classList.contains('editar')) {
                    actualizarResgistro('form-asistencia', 'modal-asistencia', urlUpdate, urlGet, 'table-asistencias');
                    console.log('editar');
                }
            });

            openModalEditar({
                idForm: 'form-asistencia',
                idTabla: 'table-asistencias',
                titulo: 'Editar Asistencia',
                idModal: 'modal-asistencia'
            });

            eliminarRegistro(`${BASE_URL}/admin/disableAsistencia`, 'table-asistencias', urlGet);

        });
    /* ----------------------------------------------------------------------------------------- */
    

    /* SECCION CONSULTAS -----------------------------------------------------------------------*/
    document.getElementById('consultas-div').addEventListener('click', () => {
        
        

        openModalEditar({
            idForm: 'form-set-justificacion',
            idTabla: 'tabla-buscador-asistencias',
            titulo: 'Editar Justificacion',
            idModal: 'modal-justificacion'
        }, 6);

        // BUSCAR ASISTENCIA POR DNI Y FECHA
        document.querySelector('#formulario-buscador-asistencias').addEventListener('submit', e => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            console.log(data);
            apiRequest(`${BASE_URL}/admin/asistenciaPorDni`, 'POST', data)
            .then(data => {
                //console.log(data);
                const tbody = document.querySelector('#tabla-buscador-asistencias tbody');
                if(data.datos){
                    //const tdAll = tbody.querySelectorAll('tr td');
                    let tr = document.createElement('tr');
                    tbody.innerHTML = '';
        
                    Object.keys(data.datos).forEach((key, i) => {
                        tr.innerHTML += `<td>${data.datos[key] ?? ''}</td>`;
                        //tdAll[i].textContent = data.datos[key] ?? '--';
                    });
                    tr.innerHTML += `<td><button class="btn btn-blank editar">Editar Justificación</button></td>`;
                    tbody.appendChild(tr);
                    //console.log('correcto:',data.datos);
                }else{
                    tbody.innerHTML = `<tr><td colspan="7" style='text-align: center'>${data.error}</td></tr>`;
                    //console.log('error:',data.error);
                }
            }).catch(err => {
                console.error(err);
                showAlert(err.message, 'error');
            });
        });

        actualizarResgistro('form-set-justificacion', 'modal-justificacion', `${BASE_URL}/admin/setJustificacion`);


        // Llenar los select
        llernarSelect(`${BASE_URL}/admin/allAreas`, '.page-table #area-faltas');
        llernarSelect(`${BASE_URL}/admin/allAreas`, '.page-table #area-justificacion');

        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre', 'Noviembre','Diciembre'];

        /* Faltas por Mes */
        document.querySelector('#content-faltasXmes #form-faltasxmes').addEventListener('submit', (e) => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));

            apiRequest(`${BASE_URL}/Admin/faltasXmes`, 'POST', data)
            .then(data => {
                const tbody = document.querySelector('#contenido-faltasXmes #tabla-faltasxmes tbody');
                if(data.datos){
                    tbody.innerHTML = '';
                    data.datos.forEach(falta => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${meses[falta.mes - 1]}</td>
                            <td>${falta.total_faltas}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }else{
                    tbody.innerHTML = `<tr><td colspan="2" style='text-align: center'>${data.error}</td></tr>`;
                }
            }).catch(err => console.error(err));
        });

        /* Justificaciones por mes */
        document.querySelector('#content-justificacionesxmes #form-justificacionesxmes').addEventListener('submit', (e) => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            fetch(`${BASE_URL}/Admin/justificacionesXMes`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if(data.datos){
                    //const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre', 'Noviembre','Diciembre'];
                    const tbody = document.querySelector('#content-justificacionesxmes #tabla-justificacionesxmes tbody');
                    tbody.innerHTML = '';
                    data.datos.forEach(justificacion => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${meses[justificacion.mes - 1]}</td>
                            <td>${justificacion.total_justificaciones}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }
            }).catch(err => console.error(err));
        });

        /* Justificaciones por Area */
        document.querySelector('#content-justificacionesxarea #form-justificacionesxarea').addEventListener('submit', (e) => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            fetch(`${BASE_URL}/Admin/justificacionesXArea`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if(data.datos){
                    const tbody = document.querySelector('#content-justificacionesxarea #tabla-justificacionesxarea tbody');
                    tbody.innerHTML = '';
                    data.datos.forEach(justificacion => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${justificacion.personal}</td>
                            <td>${justificacion.fecha}</td>
                            <td>${justificacion.justificacion ?? '--'}</td>
                            <td>${justificacion.area}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }else{
                    document.querySelector('#content-justificacionesxarea #tabla-justificacionesxarea tbody').innerHTML = `<tr><td colspan="4" style='text-align: center'>${data.error}</td></tr>`;
                }
            }).catch(err => console.error(err));
        });


        /* Resumen de asistencia de personal por año y mes */
        document.querySelector('#content-resumen-asistencias #form-resumen-asistencias').addEventListener('submit', (e) => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            fetch(`${BASE_URL}/Admin/asistenciasXPersonal`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if(data.datos){
                    const tbody = document.querySelector('#content-resumen-asistencias #tabla-resumen-asistencias tbody');
                    tbody.innerHTML = '';
                    data.datos.forEach(resumen => {
                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${resumen.dni}</td>
                            <td>${resumen.personal}</td>
                            <td>${resumen.area}</td>
                            <td>${resumen.total_asistencias}</td>
                            <td>${resumen.total_faltas}</td>
                            <td>${resumen.total_justificaciones}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                }else{
                    document.querySelector('#content-resumenasistencia #tabla-resumenasistencia tbody').innerHTML = `<tr><td colspan="4" style='text-align: center'>${data.error}</td></tr>`;
                }
            }).catch(err => console.error(err));
        });

    });
    /* --------------------------------------------------------------------------------------- */

   
});