
<?php include_once APP_PATH . '/app/views/inc/header.php' ?>

<style>
    .content-form-login {
        width: 500px;
        max-width: 90%;
        margin: 10% auto;
        background-color: #fff;
        border: 2px solid var(--second-color);
        border-radius: 6px;
        padding: 15px 10px;
    }
    .marginb-3{
        width: 100%;
        padding: 0px 1px;
    }
</style>

<div class="content">
    <div class="content-form-login">
        <h2>Inicio de Sesión</h2>
        <form id="form-login">
            <div class="marginb-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" id="contrasenia" class="control-form">
            </div>
            <input type="submit" value="Iniciar Sesión" class="btn btn-black">
        </form>
    </div>
</div>

<script>
    document.querySelector('#form-login').addEventListener('submit', e => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target));
        console.log(data);
        fetch(`<?=BASE_URL . '/Login/authUsuario'?>`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(res => {
                console.log('Respuesta: ',res);
                alert( res.message ? res.message : res.error );
                if( res.message ) window.location.replace(`<?=BASE_URL?>`);
                alert(res.error);
            })
            .catch(err => console.error(err))
    });
</script>
