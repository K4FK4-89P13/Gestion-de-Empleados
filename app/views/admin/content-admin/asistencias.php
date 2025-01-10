<div class="tab-page">
    <div class="page-table" id="contenido-asistencias">
        <div class="titulo">
            <h3>Gestión de Asistencias</h3>
            <p>Administrar las asistencias</p>
        </div>
        <div class="agregar">
            <button class="btn btn-black btn-agregar" id="agregarAsistencia">Agregar Asistencia</button>
        </div>
        <table class="table" id="table-asistencias">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Personal</th>
                    <th>Fecha</th>
                    <th>Hora de entrada</th>
                    <th>Hora de salida</th>
                    <th>Justificación</th>
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

<!-- Formulario para insertar y editar asistencias -->
<div class="modal" id="modal-asistencia">
    <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <!-- Aquí van los campos del formulario para agregar una asistencia -->
        <form id="form-asistencia" class="form-modal">
            <h3 class="titulo">Agregar Nueva Asistencia</h3>

            <input type="hidden" name="id-asistencia" id="id-asistencia" class="control-form">
            <div class="marginb-3">
                <label for="personal" class="label-form">Personal</label>
                <select name="id-personal" id="id-personal" class="control-form">
                    <option value="">Selecciona un personal</option>
                </select>
            </div>
            <div class="marginb-3">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="hora-entrada">Hora de entrada</label>
                <input type="time" name="hora-entrada" id="hora-entrada" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="hora-salida">Hora de salida</label>
                <input type="time" name="hora-salida" id="hora-salida" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="justificacion">Justificación</label>
                <textarea name="justificacion" id="justificacion" class="control-form"></textarea>
            </div>
            <button type="submit" class="btn btn-black">Registrar Asistencia</button>
        </form>
    </div>
</div>
