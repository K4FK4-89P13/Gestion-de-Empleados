export function apiRequest(url, method, data = null) {
    let options = {
        method: method,
        headers: {"Content-Type": "application/json"}
    }
    if( data ) options.body = JSON.stringify(data);

    return fetch(url, options)
    .then(res => res.ok ? res.json() : Promise.reject(res))
    //.catch(err => console.error(err));
}

export function showAlert(message, type, timeOut = 1) {
    const alertBox = document.getElementById('customAlert');
    const alertMessage = document.getElementById('alertMessage');

    // Configura el mensaje y el color según el tipo
    alertMessage.innerHTML = message;

    if( type == 'success' ){
        alertBox.classList.remove('error');
        alertBox.classList.add('success');
    }else{
        alertBox.classList.add('error');
        alertBox.classList.remove('success');
    }
    alertBox.style.display = 'block'; // Muestra el div

    //alertBox.style.display = 'none'; 
    if(timeOut === 1){
        setTimeout(() => {
            alertBox.style.display = 'none'; // Oculta el div después de 4 segundos
        }, 4000);
    }else if(timeOut === 0) {
        const closeModal = alertBox.querySelector('.close-alert');
        closeModal.style.display = 'block';
        closeModal.addEventListener('click', () => {
            alertBox.style.display = 'none';
        });
    }
}

/* Funcion para actualizar cualquier tabla */
export function actualizarTabla(url, idTabla, acciones = false) {
    apiRequest(url, 'GET')
    .then(data => {
        if(data.datos) {
            const tbody = document.getElementById(idTabla).querySelector('tbody');
            tbody.innerHTML = "";
            data.datos.forEach(item => {
                const tr = document.createElement('tr');
                Object.keys(item).forEach(key => tr.innerHTML += `<td>${item[key] ?? '--'}</td>`);
                if (acciones) {
                    tr.innerHTML += `
                        <td>
                            <button class="editar btn btn-blank">Editar</button>
                            <button class="borrar btn btn-red">Borrar</button>
                        </td>
                    `;
                }
                tbody.appendChild(tr);
            });
        }else{ alert(data.error); }
    }).catch(err => console.error(err));
}

function handleSubmit(e) {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target));
    console.log(data);

    apiRequest(urlnewAsistencia, 'POST', data)
    .then(data => {
        console.log(data);
        if(data.message){
            alert(data.message);
            actualizarTabla(urlGet, idTabla, true);
        } else {
            alert(data.error);
        }
    });
    document.getElementById(idModal).style.display = "none";
}
export function nuevoRegistro(idForm, idModal, urlnewAsistencia, urlGet, idTabla) {
    const form = document.getElementById(idForm);

    form.addEventListener('submit', handleSubmit);
    form.removeEventListener('submit', handleSubmit);

}

export function actualizarResgistro(idForm, idModal, url_rewrite, url_get = null, idTabla = null) {

    document.getElementById(idForm).onsubmit = e => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target));
        console.log(data);

        apiRequest(url_rewrite, 'POST', data)
        .then(data => {
            console.log(data);
            if(data.message){
                showAlert(data.message, 'success', 0);
                if( url_get && idTabla ) actualizarTabla(url_get, idTabla, true);
            } else {
                showAlert(data.error, 'error', 0);
            }
        });
        document.getElementById(idModal).style.display = "none";
    };
}

/* Funcion general para abrir el modal en modo Editar */
export function openModalEditar(data, numTd = null) {
    document.getElementById(data.idTabla).addEventListener('click', e => {
        if(e.target.classList.contains('editar')) {
            const fila = e.target.closest('tr');
            document.getElementById(data.idForm).querySelector('.titulo').textContent = data.titulo;
    
            const entradas = document.querySelectorAll(`#${data.idForm} .control-form`);
            let i = numTd ?? 1;
            entradas.forEach( item => {
                item.value = fila.querySelector(`td:nth-child(${i})`).textContent;
                i++;
            } );
            entradas[0].value = fila.querySelector('td:nth-child(1)').textContent;
            console.log(entradas[0], entradas[1]);
    
            document.getElementById(data.idModal).style.display = "block";
        }
    })
}


/* Funcion para eliminar cualquier registro */
export function eliminarRegistro(url_delete, idTabla, url_get) {
    document.getElementById(idTabla).addEventListener('click', e => {
        if( e.target.classList.contains('borrar') ) {
            if( confirm('¿Seguro que quieres eliminar este registro?') ){
                const id_fila = e.target.closest('tr').querySelector('td').textContent;

                apiRequest(url_delete, 'POST', {'id_fila': id_fila})
                .then(data => {
                    if(data.message) {
                        alert(data.message);
                        actualizarTabla(url_get, idTabla, true);
                    }else{
                        alert(data.error);
                    }
                });
            }
        }
    });
}


/* FUNCION PARA LLENAR SELECTS ---------------------- */
export function llernarSelect(urlGet, selector) {
    apiRequest(urlGet, 'GET')
    .then(data => {
        const select = document.querySelector(selector);
        select.innerHTML = '';
        select.innerHTML = '<option value="">Selecciona</option>';
        let option = '';
        data.datos.forEach(item => {
            const keys = Object.keys(item);
            option += `<option value='${item[keys[0]]}'>${item[keys[1]]}</option>`;
        });
        select.innerHTML += option;
    })
    .catch(err => console.error(err));
}