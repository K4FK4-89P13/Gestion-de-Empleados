import { showAlert } from "./app.js";

document.querySelector('#form-login').addEventListener('submit', e => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target));
    console.log(data);
    fetch(`${BASE_URL}/Login/authUsuario`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(res => {
            if(res.datos) {
                console.log('Datos: ',res.datos);
                localStorage.setItem('datosUser', JSON.stringify(res.datos));

                if(res.datos.rol === 'Administrador'){
                    window.location.replace(`${BASE_URL}/admin`);
                }else if(res.datos.rol === 'Personal'){
                    window.location.replace(`${BASE_URL}/personal`);
                }
            }else{
                showAlert(res.error, 'danger', 0);
            }
            //!res.message ? alert(res.error) : window.location.replace(`${BASE_URL}/admin`);
        })
        .catch(err => console.error(err))
});