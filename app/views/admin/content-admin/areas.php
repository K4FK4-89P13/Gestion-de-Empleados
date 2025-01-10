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
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal formulario para Areas -->
            <div class="modal" id="modal-areas">
                <div class="modal-content">
                    <span class="close" id="close-modal">&times;</span>
                    <!-- Aquí van los campos del formulario para agregar un empleado -->
                    <form id="form-areas" class="form-modal">
                        <h3 class="titulo">Agregar Nueva Area</h3>
                        <p>Ingresa los datos de la nueva area.</p>
                        <div class="marginb-3">
                            <label for="nombre-area" class="label-form">Nombre:</label>
                            <input type="text" id="nombre-area" name="nombre-area" class="control-form">
                        </div>
                        <div class="marginb-3">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" class="control-form"></textarea>
                        </div>
                        <button type="submit" class="btn btn-black">Guardar</button>
                    </form>
                </div>
            </div>