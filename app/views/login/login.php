
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

<div id="customAlert">
    <span class="close-alert">&times;</span>
    <span id="alertMessage">Este es un mensaje.</span>
</div>


<div class="content">
    <div class="content-form-login">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
        </svg>
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

<script type="module" src="./assets/js/login.js"></script>
