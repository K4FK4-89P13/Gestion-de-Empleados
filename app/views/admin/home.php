<link rel="stylesheet" href="./assets/admin/adminStyle.css">

<?php include_once APP_PATH . '/app/views/inc/header.php'?>

    <div class="header">
        <h1>Personal de Empleados</h1>
        <div class="head-right">
            <span><?=$_SESSION['usuario'] ? $_SESSION['usuario'] : 'Usuario'?></span>
            <a href=<?=BASE_URL.'/Login/logout'?>><button class="btn btn-blank">Cerrar Sesion</button></a>
        </div>
    </div>

    <div class="container">
         <!-- Menu para navegar por las tablas -->
        <div class="contenedor-tab">
            <div class="admin-div">
                <div class="tab-header btn btn-black">
                    <span>Administradores</span>
                </div>
            </div>
            <div class="personal-div">
                <div class="tab-header btn btn-blank">
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

            <!-- Pagina de Administradores -->
            <div class="tab-page">
                <div class="page-table" id="contenido-admin">
                    <div class="titulo">
                        <h3>Gestión de Empleados</h3>
                        <p>Administra los empleados</p>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-black btn-agregar" id="agregarAdmin">Agregar Administrador</button>
                    </div>
                    <table class="table" id="table-admin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Oscar Aliaga</td>
                                <td>72467086</td>
                                <td>Biblioteca</td>
                                <td>
                                    <button class="btn btn-blank editar">Editar</button>
                                    <button class="btn btn-red borrar">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagina de Empleados -->
            <div class="tab-page">
                <div class="page-table" id="contenido-personal">
                    <?php include_once APP_PATH . '/app/views/buscadorAvanzado/buscador.php' ?>
                    <div class="titulo">
                        <h3>Gestión de Empleados</h3>
                        <p>Administra los empleados</p>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-black btn-agregar" id="agregarEmpleado">Agregar Empleado</button>
                    </div>
                    <table class="table" id="table-personal">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Departamento</th>
                                <th>Fecha de Ingreso</th>
                                <th>Sueldo</th>
                                <th>Area</th>
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

            <!-- Pagina de Areas -->
            <div class="tab-page">
                <div class="page-table" id="contenido-areas">
                    <div class="titulo">
                        <h3>Gestión de Areas</h3>
                        <p>Administrar las areas</p>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-black btn-agregar" id="agregarArea">Agregar Area</button>
                    </div>
                    <table class="table" id="table-areas">
                        <thead>
                            <tr>
                                <th>#</th>
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

    <!-- Modal para agregar Administradores -->
    <div class="modal" id="modal-admin">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <!-- Aquí van los campos del formulario para agregar un administrador -->
            <form id="form-admin" class="form-modal">
                <h3>Agregar Nuevo Administrador</h3>
                <p>Ingresa los datos del nuevo administrador</p>
                <div class="marginb-3">
                    <label for="nombre-admin" class="label-form">Nombres:</label>
                    <input type="text" id="nombre-admin" name="nombre-admin" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="dni-admin">DNI:</label>
                    <input type="text" name="dni-admin" id="dni-admin" class="control-form">
                </div>
                <button type="submit" class="btn btn-black">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Modal para agregar Personal -->
    <div class="modal" id="modal-empleado">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <!-- Aquí van los campos del formulario para agregar un empleado -->
            <form id="form-empleado" class="form-modal">
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
            <form id="form-areas" class="form-modal">
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
    <script src="./assets/admin/script.js"></script>
    
    
</body>
</html>