<style type="text/css">
    .header{
        background-color: var(--second-color);
        color: var(--main-color);

        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 0 15;
    }
    .container{
        width: 75%;
        margin: 40 auto;
    }
    .contenedor-tab{
        width: 100%;
        padding: 10 15;
        background-color: #fff;
        border: 2px solid #e4e4e7;
        border-radius: 10px;
        margin: 10 0;
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
    .page-table{
        width: 100%;
        background-color: #fff;
        padding: 10 15;
        border: 2px solid #e4e4e7;
        border-radius: 10px;
        
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .page-table h3, .page-table p{
        margin: 7 5;
    }
    .tab-page{
        display: none;
    }
    .tab-page:first-child{
        display: block;
    }



    /* 
    * Estilo para el fondo del modal *
    */
    .modal {
        display: none; /* Oculto por defecto */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro transparente */
    }

    /* Contenido del modal */
    .modal-content {
        position: relative;
        background-color: #fff;
        margin: 2% auto; /* Centrado vertical */
        padding: 20px;
        border-radius: 8px;
        width: 400px;
        max-width: 90%;
    }

    /* Botón de cerrar modal */
    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }
</style>

<?php include_once APP_PATH . '/app/views/inc/header.php'?>

    <div class="header">
        <h1>Personal de Empleados</h1>
        <div class="head-right">
            <span>Admin</span>
            <button class="btn btn-blank">Cerrar Sesion</button>
        </div>
    </div>

    <div class="container">
         <!-- Menu para navegar por l as tablas -->
        <div class="contenedor-tab">
            <div class="personal-div">
                <div class="tab-header btn btn-black">
                    <span>Personal</span>
                </div>
            </div>
            <div class="areas-div">
                <div class="tab-header btn btn-blank">
                    <span>Areas</span>
                </div>
            </div>
        </div>

        <div id="contenido" class="tab-content">
            <div class="tab-page">
                <div class="page-table" id="contenido-personal">
                    <div class="titulo">
                        <h3>Gestión de Empleados</h3>
                        <p>Administra los empleados</p>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-black" id="agregarEmpleado">Agregar Empleado</button>
                    </div>
                    <table class="table" id="table-personal">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Area</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Oscar Aliaga</td>
                                <td>72467086</td>
                                <td>Biblioteca</td>
                                <td>976257472</td>
                                <td>email@example.com</td>
                                <td>Servicios Generales</td>
                                <td>Matematicas</td>
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-page">
                <div class="page-table" id="contenido-areas">
                    <div class="titulo">
                        <h3>Gestión de Areas</h3>
                        <p>Administrar las areas</p>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-black" id="agregarArea">Agregar Area</button>
                    </div>
                    <table class="table" id="table-areas">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administración</td>
                                <td>Area de Administración</td>
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar Personal -->
    <div class="modal" id="modal-agregar">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <!-- Aquí van los campos del formulario para agregar un empleado -->
            <form id="form-empleado">
                <h3>Agregar Nuevo Empleado</h3>
                <p>Ingresa los datos del nuevo empleado.</p>
                <div class="marginb-3">
                    <label for="nombre" class="label-form">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="area">Area</label>
                    <input type="text" name="area" id="area" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="cargo">Cargo</label>
                    <select name="cargo" id="cargo" class="control-form">
                    </select>
                </div>
                <div class="marginb-3">
                    <label for="departamento">Departamento</label>
                    <input type="text" name="departamento" id="departamento" class="control-form">
                </div>
                <button type="submit" class="btn btn-black">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal formulario para Areas -->
    <div class="modal" id="modal-areas">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <!-- Aquí van los campos del formulario para agregar un empleado -->
            <form id="form-areas">
                <h3>Agregar Nueva Area</h3>
                <p>Ingresa los datos de la nueva area.</p>
                <div class="marginb-3">
                    <label for="nombre-area" class="label-form">Nombre:</label>
                    <input type="text" id="nombre-area" name="nombre-area" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="descripcion">Descripción:</label>
                    <!-- <input type="text" id="descripcion" name="descripcion" class="control-form"> -->
                    <textarea name="descripcion" id="descripcion" class="control-form"></textarea>
                </div>
                <button type="submit" class="btn btn-black">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once APP_PATH . '/app/views/inc/footer.php'?>

    <!-- javaScript de la Vista -->
    <?php include_once APP_PATH . '/app/views/admin/script.php'?>
    
</body>
</html>