<style>
    #buscador-avanzado {
        border-bottom: 1px solid var(--second-color);
        /* border-right: none;
        border-left: none; */
        padding-bottom: 10px;
    }
    #formulario-buscador {  
        display: grid;  
        margin: 0;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }  
    .marginb-3 {  
        flex: 1; /* Cada elemento puede ocupar el mismo ancho */  
        min-width: 200px; /* Ancho mínimo para los inputs */  
    } 
</style>

<div id="buscador-avanzado">
    <h3>Búsqueda Avanzada</h3>
    <div id="form-buscador">
        <form id="formulario-buscador">
            <div class="marginb-3">
                <label for="dni">Buscar por DNI</label>
                <input type="text" name="dni" id="dni" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="nombres">Buscar por Nombre o Apellido</label>
                <input type="text" name="nombres" id="nombres" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="areas">Buscar por Área</label>
                <select name="areas" id="areas" class="control-form">
                    <option value="">Selecciona un Área</option>
                    <option value="1">Matemáticas</option>
                    <option value="2">Ciencias</option>
                </select>
            </div>
            <div class="marginb-3">
                <label for="fecha-ingreso">Buscar por Fecha de Ingreso</label>
                <input type="date" name="fecha-ingreso" id="fecha-ingreso" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="sueldo">Buscar por Sueldo menor a</label>
                <input type="number" name="sueldo" id="sueldo" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="puesto-trabajo">Buscar por Puesto de Trabajo</label>
                <input type="text" name="puesto-trabajo" id="puesto-trabajo" class="control-form">
            </div>
            <input type="submit" value="Buscar" class="btn btn-black">
        </form>
    </div>
   <!--  <button class="btn btn-black" id="btn-buscar">Buscar</button> -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        
        /* Obtener todas las areas para el select del formulario de busqueda avanzada */
        fetch(`${BASE_URL}/Home/showAreas`)
        .then(res => res.json())
        .then(data => {
            const areas = document.querySelector('#areas');
            areas.innerHTML = '';
            let option = `<option value=''>Selecciona un Área</option>`;
            data.datos.forEach(item => {
                option += `<option value='${item.id_area}'>${item.nombre}</option>`;
            });
            areas.innerHTML = option;
        })
        .catch(err => console.error(err));

        /* Busqueda Avanzada */
        document.querySelector('#formulario-buscador').addEventListener('submit', e => {
            e.preventDefault();
            const data = Object.fromEntries( new FormData(e.target) );
            //console.log(data);

            fetch(`${BASE_URL}/Personal/buscar`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                const tbody = document.querySelector('#table-personal tbody');
                tbody.innerHTML = "";

                if( data.datos ) {
                    data.datos.forEach(row => {
                        const tr = document.createElement('tr');
                        /* tr.innerHTML= `
                            <td>${row.id_personal}</td>
                            <td>${row.nombres}</td>
                            <td>${row.dni}</td>
                            <td>${row.telefono}</td>
                            <td>${row.email}</td>
                            <td>${row.cargo}</td>
                            <td>${row.departamento}</td>
                            <td>${row.fecha_ingreso}</td>
                            <td>${row.sueldo}</td>
                            <td>${row.area}</td>
                            <td>
                                <button class="btn btn-blank editar">Editar</button>
                                <button class="btn btn-red">Eliminar</button>
                            </td>
                        `; */
                        Object.keys(row).forEach(key => tr.innerHTML += `<td>${row[key] ? row[key] : '--'}</td>`);
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
            })
            .catch(err => console.error(err));
        })
    })
</script>