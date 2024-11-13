<script>
document.addEventListener('DOMContentLoaded', () => {

    /* Obtener todos los Administradores */
        fetch(`<?=BASE_URL.'/Home/showAdmin'?>`)
            .then(res => res.json())
            .then(data => {
                const tbody = document.querySelector('#table-admin').querySelector('tbody');
                tbody.innerHTML = "";
                data.forEach(item => {
                    let row = `<tr>
                                <td>${item.id_admin}</td>
                                <td>${item.nombres}</td>
                                <td>${item.dni}</td>
                                <td>
                                    <button class="btn btn-black editar">Editar</button>
                                    <button class="btn btn-red borrar">Eliminar</button>
                                </td>
                                </tr>`;
                    tbody.innerHTML += row;
                })
            })
            .catch(err => console.error(err));

    /* Peticioin AJAX para obtener todos los Empleados */
        fetch(`<?=BASE_URL . '/Home/showPersonal'?>`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#table-personal').querySelector('tbody');
                const cargo = document.querySelector('#cargo');
                let cargoArray = [];
                tbody.innerHTML = "";
                data.forEach(item => {
                    let row = `<tr>
                                <td>${item.nombres}</td>
                                <td>${item.dni}</td>
                                <td>${item.telefono ? item.telefono : '--'}</td>
                                <td>${item.email ? item.email : '--'}</td>
                                <td>${item.area}</td>
                                <td>${item.cargo}</td>
                                <td>${item.departamento ? item.departamento : '--'}</td>
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red borrar">Eliminar</button>
                                </td>
                                </tr>`;
                    tbody.innerHTML += row;
                    if(!cargoArray.includes(item.cargo)) cargoArray.push(item.cargo);
                });
                cargoArray.forEach(item => cargo.innerHTML += `<option value="${item}">${item}</option>`);
            })
            .catch(err => console.error(err));
    
    /* Obtener todas las Areas */
        fetch(`<?=BASE_URL.'/Home/showAreas'?>`)
            .then(res => res.json())
            .then( data => {
                const tbody = document.querySelector('#table-areas').querySelector('tbody');
                tbody.innerHTML = "";
                data.forEach(item => {
                    let row = `<tr>
                                <td>${item.nombre}</td>
                                <td>${item.descripcion}</td>
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red borrar">Eliminar</button>
                                </td>
                                </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch(err => console.error(err));
    
        
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
        console.log(btnAgregar);

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

    /* Funcion para abrir le modal de Admnistradores en modo Editar */
    /* ------------------------------------------------------------------------------------------ */
        function editarAdmin(fila) {
            formAdmin.querySelector('h3').textContent = "Editar Administrador";
            formAdmin.querySelector('p').textContent = "Modifica los datos del administrador";

            document.querySelector('#nombre-admin').value = fila.querySelector('td:nth-child(2)').textContent;
            document.querySelector('#dni-admin').value = fila.querySelector('td:nth-child(3)').textContent;

            modalAdmin.style.display = "block";
        }
        
        document.querySelector('#table-admin').addEventListener('click', e => {
            if(e.target.classList.contains('editar')) {
                editarAdmin(e.target.closest('tr'));
            }
            if(e.target.classList.contains('borrar')) {
                confirm('¿Seguro que quieres eliminar a este administrador?');
            }
        })
    /* ------------------------------------------------------------------------------------------ */
        
    /* Funcion para abrir el modal de Empleados en modo editar */
    /* ----------------------------------------------------------------------------------------- */
        function abrirModalEditar(fila) {
            formEmpleado.querySelector('h3').textContent = "Editar Empleado";
            formEmpleado.querySelector('p').textContent = "Modifica los datos del empleado";

            document.querySelector('#nombre').value = fila.querySelector('td:nth-child(1)').textContent;
            document.querySelector('#dni').value = fila.querySelector('td:nth-child(2)').textContent;
            document.querySelector('#telefono').value = fila.querySelector('td:nth-child(3)').textContent;
            document.querySelector('#email').value = fila.querySelector('td:nth-child(4)').textContent;
            document.querySelector('#area').value = fila.querySelector('td:nth-child(5)').textContent;
            document.querySelector('#cargo').value = fila.querySelector('td:nth-child(6)').textContent;
            document.querySelector('#departamento').value = fila.querySelector('td:nth-child(7)').textContent;

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


    /* Modal para Areas */
    /* -------------------------------------------------------------- */
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
    /* -------------------------------------------------------------- */


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
        fetch(`<?=BASE_URL . '/Home/newPersonal'?>`, {
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
</script>