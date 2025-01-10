<div class="header">
    <h1><?=$_SESSION['datosUser']['rol'] ?? 'Rol'?></h1>
    <div class="head-right">
        <div id="acciones-header" class="d-flex-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="margin: auto 10px auto 0;">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <a href=<?=BASE_URL.'/Login/logout'?>><button class="btn btn-red">Cerrar Sesion</button></a>
            <?php
            if( $_SESSION['datosUser']['rol'] == 'Personal' ) {
                echo '<button class="btn btn-blank btn-agregar" id="btn-asistencia">Registrar Asistencia</button>';
            }
            ?>
        </div>
    </div>

</div>
<!-- MODAL PARA EL REGISTRO DE ASISTENCIA -->
<?php if($_SESSION['datosUser']['rol'] == 'Personal') { ?>
 <div class="modal" id="modal-resgitroAsistencia">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-modal" id="form-registroAsistencia">
            <h3 class="titulo">Registrar Asistencia</h3>
            <div class="marginb-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" class="control-form" maxlength="8">
            </div>
            <div class="marginb-3">
                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" id="contrasenia" class="control-form">
            </div>
            <input type="submit" value="Resgistrar Asistencia" class="btn btn-black">
        </form>
    </div>
 </div>
<?php } ?>

<script type="module" src="./assets/js/header-menu.js"></script>