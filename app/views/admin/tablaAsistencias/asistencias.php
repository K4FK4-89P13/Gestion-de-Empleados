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
                    <td>1</td>
                    <td>Adrian Polmar</td>
                    <td>2024-10-25</td>
                    <td>08:00:00</td>
                    <td>16:00:00</td>
                    <td>Ninguna</td>
                    <td>
                        <button class="btn btn-blank editar">Editar</button>
                        <button class="btn btn-red">Eliminar</button>
                    </td>
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
            <h3>Agregar Nueva Asistencia</h3>
            <p>Ingresa los datos de la asistencia</p>
            <div class="marginb-3">
                <label for="personal" class="label-form">Personal</label>
                <select name="personal" id="personal" class="control-form">
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

<script src="./assets/tablaAsistencias/asistencias.js"></script>