document.addEventListener('DOMContentLoaded', () => {

    /* Obtener los elementos */
    //Sección Administradores
    const modalAdmin = document.querySelector('#modal-admin');
    const formAdmin = document.querySelector('#form-admin');

    //Sección Empleados
    const formEmpleado = document.querySelector('#form-empleado');
    const modalEmpleado = document.querySelector('#modal-empleado');

    //Sección Áreas
    const formAreas = document.querySelector('#form-areas');
    const modalArea = document.querySelector('#modal-areas');

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

    /* Funcion para actualizar cualquier tabla */
    function actualizarTabla(url, idTabla) {
        fetch(`${BASE_URL}${url}`)
        .then(res => res.json())
        .then(data => {
            if(data.datos) {
                const tbody = document.querySelector(`#${idTabla}`).querySelector('tbody');
                tbody.innerHTML = "";
                data.datos.forEach(item => {
                    const tr = document.createElement('tr');
                    Object.keys(item).forEach(key => tr.innerHTML += `<td>${item[key] ? item[key] : '--'}</td>`);
                    tr.innerHTML += `<td>
                                        <button class="btn btn-blank editar">Editar</button>
                                        <button class="btn btn-red borrar">Eliminar</button>
                                    </td>`;
                    tbody.appendChild(tr);
                });
            }
        })
        .catch(err => console.error(err));
    }

    /* Funcion general para abrir el modal en modo Editar */
    function openModalEditar(dataObject) {
        document.querySelector(dataObject['id_tabla']).addEventListener('click', e => {
            if(e.target.classList.contains('editar')) {
                const fila = e.target.closest('tr');
                dataObject['form'].querySelector('h3').textContent = dataObject['titulo'];
                dataObject['form'].querySelector('p').textContent = dataObject['descripcion'];
        
                const entradas = document.querySelectorAll(`${dataObject['form_id']} .control-form`);
                let i = 2;
                entradas.forEach( item => {
                    item.value = fila.querySelector(`td:nth-child(${i})`).textContent;
                    i++;
                } );
        
                dataObject['modal'].style.display = "block";
            }
        })
    }

    function actualizarResgistro(form, modal, url_rewrite, url_get, id_tabla) {
        form.addEventListener('submit', e => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            console.log(data);
            fetch(`${BASE_URL}${url_rewrite}`, {
                method: 'POST',
                headers: {'Conten-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if(data.datos){
                    alert(data.datos);
                    actualizarTabla(url_get, id_tabla);
                }else{
                    alert(data.error);
                }
            })
            modal.style.display = "none";
        })
    }

    /* Funcion para eliminar cualquier registro */
    function eliminarRegistro(url_delete, idTabla, url_get) {
        document.querySelector('#'+idTabla).addEventListener('click', e => {
            if( e.target.classList.contains('borrar') ) {
                if( confirm('¿Seguro que quieres eliminar este registro?') ){
                    const id_fila = e.target.closest('tr').querySelector('td').textContent;
                    console.log(id_fila);
                    fetch(`${BASE_URL}${url_delete}`, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({'id_fila': id_fila})
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        if(data.message) {
                            alert(data.message);
                            actualizarTabla(url_get, idTabla);
                        }else{
                            alert(data.error);
                        }
                    })
                    .catch(err => console.error(err));
                }
            }
        })
    }


    /*--Obtener todos los Administradores --------------------------------------------------------------------*/
        actualizarTabla('/Home/showAdmin', 'table-admin');
        actualizarResgistro(formAdmin, modalAdmin);

        //Insertar nuevos Administradores
        /* formAdmin.addEventListener('submit', e => {
            e.preventDefault();

            const data = Object.fromEntries( new FormData(e.target) );
            console.log(data);
            fetch(`${BASE_URL}/Personal/newAdmin`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(datos => {
                console.log(datos);
                actualizarTabla('/Home/showAdmin', 'table-admin');
                modalAdmin.style.display = "none";
            })
            .catch(err => console.error(err))
        }); */

        // Abrir el modal de Admnistradores en modo Editar //
        openModalEditar({
            form: formAdmin,
            form_id: '#form-admin',
            id_tabla: '#table-admin',
            titulo: 'Editar Administrador',
            descripcion: 'Modifica los datos del administrador',
            modal: modalAdmin
        });

        // Eliminar Administrador //
        eliminarRegistro('/Personal/disable', 'table-admin', '/Home/showAdmin');
    /* ------------------------------------------------------------------------------------------ */
        

    /*--Obtener todos los Empleados --------------------------------------------------------------*/
        actualizarTabla('/Home/showPersonal', 'table-personal');
        
        // Abrir modal empleado en modo Editar //
        openModalEditar({
            'form': formEmpleado,
            form_id: '#form-empleado',
            id_tabla: '#table-personal',
            'titulo': 'Editar Empleado',
            'descripcion': 'Modifica los datos del empleado',
            'modal': modalEmpleado
        });

        // Eliminar Empleado //
        eliminarRegistro('/Personal/disablePersonal', 'table-personal', '/Home/showPersonal');
    /* ----------------------------------------------------------------------------------------- */

        
    /*--Obtener todas las Areas------------------------------------------------------------------*/
        actualizarTabla('/Home/showAreas', 'table-areas');
        
        /* Abrir modal de Areas en modo editor */
        openModalEditar({
            form: formAreas,
            form_id: '#form-areas',
            id_tabla: '#table-areas',
            titulo: 'Editar Area',
            descripcion: 'Modifica los datos del area',
            modal: modalArea
        });

        // Eliminar Area //
        eliminarRegistro('/Personal/disableArea', 'table-areas', '/Home/showAreas');
    /* ----------------------------------------------------------------------------------------- */


    /*--Obtener todas las Asistencias ---------------------------------------------------------- */
        actualizarTabla('/Personal/getAllAsistencias', 'table-asistencias');

        // Obtener datos para el select de Personal //
        fetch(`${BASE_URL}/Home/showPersonal`)
        .then(res => res.json())
        .then(data => {
            if(data.datos) {
                const select = document.querySelector('#form-asistencia #personal');
                select.innerHTML = `<option value=''>Selecciona un personal</option>`;
                data.datos.forEach(item => {
                    select.innerHTML += `<option value=${item.id_personal}>${item.nombres}</option>`;
                });
            }
        }).catch(err => console.error(err));
    /* ----------------------------------------------------------------------------------------- */
    


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

    /* Nuevos registros */
    document.querySelector('#form-empleado').addEventListener('submit', e => {
        e.preventDefault();
        const data = Object.fromEntries( new FormData(e.target) );
        console.log(data);
        fetch(`${BASE_URL}/Home/newPersonal`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        })
            .then(response => response.text())
            .then(res => console.log(res))
            .catch(err => console.log(err))
    });
    document.querySelector('#form-areas').addEventListener('submit', e => {
        e.preventDefault();
        const data = Object.fromEntries( new FormData(e.target) );
        console.log(data);
    });
});