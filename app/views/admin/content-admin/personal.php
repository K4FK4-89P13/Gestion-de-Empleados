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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal para agregar Personal -->
            <div class="modal" id="modal-empleado">
                <div class="modal-content">
                    <span class="close" id="close-modal">&times;</span>
                    <!-- Aquí van los campos del formulario para agregar un empleado -->
                    <form id="form-empleado" class="form-modal">
                        <h3 class="titulo">Agregar Nuevo Empleado</h3>
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