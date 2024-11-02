<script>
document.addEventListener('DOMContentLoaded', () => {
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
        
        
        // Obtén los elementos
        const modal = document.querySelector('#modal-agregar');
        const btnAbrir = document.querySelector('#agregarEmpleado');
        const btnCerrar = document.querySelectorAll('.close');
        const formEmpleado = document.querySelector('#form-empleado');

        // Abre el modal
        btnAbrir.onclick = function() {
            formEmpleado.reset(); //Limpia el formulario
            modal.style.display = "block";
        }

        // Cierra el modal
        const modalArray = document.querySelectorAll('.modal');
        btnCerrar.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                modalArray[i].style.display = "none";
            })
        })
        /* btnCerrar.onclick = function() {
            modal.style.display = "none";
        } */

        // Cierra el modal al hacer clic fuera del contenido
        window.onclick = function(event) {
            modalArray.forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            })
        }

        /* Funcion para abrir el modal en modo editar */
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

            modal.style.display = "block";
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


        /* Modal para Areas */
        /* -------------------------------------------------------------- */
        const modalArea = document.querySelector('#modal-areas');
        const abrirArea = document.querySelector('#agregarArea');
        const formAreas = document.querySelector('#form-areas');

        abrirArea.onclick = () => {
            formAreas.reset();
            modalArea.style.display = "block";
        }
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
        })
});
</script>