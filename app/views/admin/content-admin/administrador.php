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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal para agregar Administradores -->
            <div class="modal" id="modal-admin">
                <div class="modal-content">
                    <span class="close" id="close-modal">&times;</span>
                    <!-- Aquí van los campos del formulario para agregar un administrador -->
                    <form id="form-admin" class="form-modal">
                        <h3 class="titulo">Agregar Nuevo Administrador</h3>
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