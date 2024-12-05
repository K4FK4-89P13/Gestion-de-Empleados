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


    /*--Obtener todos los Administradores --------------------------------------------------------------------*/
        actualizarTabla('/Home/showAdmin', 'table-admin');

        //Insertar nuevos Administradores
        formAdmin.addEventListener('submit', e => {
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
        });

        /* Funcion para abrir el modal de Admnistradores en modo Editar */
        function editarAdmin(fila) {
            formAdmin.querySelector('h3').textContent = "Editar Administrador";
            formAdmin.querySelector('p').textContent = "Modifica los datos del administrador";

            document.querySelector('#nombre-admin').value = fila.querySelector('td:nth-child(2)').textContent;
            document.querySelector('#dni-admin').value = fila.querySelector('td:nth-child(3)').textContent;

            modalAdmin.style.display = "block";
        }
        
        document.querySelector('#table-admin').addEventListener('click', e => {
            if(e.target.classList.contains('editar')) {
                const fila = e.target.closest('tr');
                editarAdmin(fila);
            }
            if(e.target.classList.contains('borrar')) {
                if( confirm('¿Seguro que quieres eliminar a este administrador?') ) {
                    const id_admin = e.target.closest('tr').querySelector('td').textContent;
                    console.log(id_admin);
                    fetch(`${BASE_URL}/Personal/disable`, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({'id_admin': id_admin})
                    })
                    .then(res => res.text())
                    .then(data => {
                        console.log(data);
                        getAllAdmin();
                    })
                    .catch(err => console.error(err))
                };
            }
        })
    /* ------------------------------------------------------------------------------------------ */
        

    /*--Peticioin AJAX para obtener todos los Empleados ------------------------------------------*/
        actualizarTabla('/Home/showPersonal', 'table-personal');
        
        /* Funcion para abrir el modal de Empleados en modo editar */
            function abrirModalEditar(fila) {
                formEmpleado.querySelector('h3').textContent = "Editar Empleado";
                formEmpleado.querySelector('p').textContent = "Modifica los datos del empleado";

                document.querySelector('#form-empleado #nombre').value = fila.querySelector('td:nth-child(1)').textContent;
                document.querySelector('#form-empleado #dni').value = fila.querySelector('td:nth-child(2)').textContent;
                document.querySelector('#form-empleado #telefono').value = fila.querySelector('td:nth-child(3)').textContent;
                document.querySelector('#form-empleado #email').value = fila.querySelector('td:nth-child(4)').textContent;
                document.querySelector('#form-empleado #area').value = fila.querySelector('td:nth-child(5)').textContent;
                document.querySelector('#form-empleado #cargo').value = fila.querySelector('td:nth-child(6)').textContent;
                document.querySelector('#form-empleado #departamento').value = fila.querySelector('td:nth-child(7)').textContent;

                modalEmpleado.style.display = "block";
            }

            document.querySelector('#table-personal').addEventListener('click', e => {
                if(e.target.classList.contains('editar')) {
                    const fila = e.target.closest('tr');
                    abrirModalEditar(fila);
                }
                if(e.target.classList.contains('borrar')) {
                    confirm("¿Seguro que quieres eliminar este registro?");
                }
            });
    /* ----------------------------------------------------------------------------------------- */

        
    /*--Obtener todas las Areas------------------------------------------------------------------*/
        actualizarTabla('/Home/showAreas', 'table-areas');
        
        /* Modal para Areas */
        /* Funcion para abrir modal de Areas en modo editor */
        function editarArea(fila) {
            formAreas.querySelector('h3').textContent = "Editar Area";
            formAreas.querySelector('p').textContent = "Modifica los datos del Area";

            document.querySelector('#nombre-area').value = fila.querySelector('td:nth-child(1)').textContent;
            document.querySelector('#descripcion').value = fila.querySelector('td:nth-child(2)').textContent;

            modalArea.style.display = "block";
        }

        document.querySelector('#table-areas').addEventListener('click', e => {
            if(e.target.classList.contains('editar')) {
                editarArea( e.target.closest('tr') );
            }
            if(e.target.classList.contains('borrar')){
                confirm('¿Seguro que desea eliminar este registro?');
            }
        })
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