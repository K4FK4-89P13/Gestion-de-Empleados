<div class="tab-page">
    <div class="page-table" id="contenido-consultas">
        <div class="titulo">
            <h3>Gestión de Consultas</h3>
            <p>Administrar las consultas</p>
        </div>
        <div id="content-buscador-asistencias">
            <form id="formulario-buscador-asistencias">
                <div class="marginb-3">
                    <label for="dni">Buscar por DNI</label>
                    <input type="text" name="dni-personal" id="dni-personal" class="control-form">
                </div>
                <div class="marginb-3">
                    <label for="fecha">Buscar por Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="control-form">
                </div>
                <input type="submit" value="Buscar" class="btn btn-black">
            </form>
        </div>
        <table class="table" id="tabla-buscador-asistencias">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Personal</th>
                    <th>Fecha</th>
                    <th>Hora de Entrada</th>
                    <th>Hora de Salida</th>
                    <th>Justificación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </div>
    <!-- Formulario para insertar y editar asistencias -->
    <div class="modal modalCrud" id="modal-justificacion">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <!-- Aquí van los campos del formulario para agregar un producto -->
            <form id="form-set-justificacion" class="form-modal">
                <h3 class="titulo">Editar Justificacion</h3>
                <input type="hidden" name="id_asistencia" id="id_asistencia" class="control-form">
                <div class="marginb-3">
                    <h4>Personal</h4>
                </div>
                <div class="marginb-3">
                    <label for="justificacion" class="label-form">Justificación</label>
                    <textarea name="justificacion" id="justificacion" class="control-form"></textarea>
                </div>
                <button type="submit" class="btn btn-black">Guardar</button>
            </form>
        </div>
    </div>


    <div class="page-table" id="contenido-faltasXmes">
        
        <h3>Faltas por Mes Clasificado por Area: </h3>
        <div id="content-faltasxmes">
            <form id="form-faltasxmes">
                <div class="marginb-3">
                    <select name="area-faltas" id="area-faltas" class="control-form select-areas">
                        <option value="">Selecciona un Área</option>
                    </select>
                </div>
                <input type="submit" value="Buscar" class="btn btn-black">
            </form>
        </div>
        <table class="table" id="tabla-faltasxmes">
            <thead>
                <tr>
                    <th>Numero de Faltas</th>
                    <th>Mes</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

    <!-- Cantidad de justificaciones por mes -->
    <div class="page-table" id="contenido-justificacionesXmes">

        <h3>Justificaciones por mes clasificado por Área:</h3>
        <div id="content-justificacionesxmes">
            <form id="form-justificacionesxmes">
                <div class="marginb-3">
                    <select name="area-justificacion" id="area-justificacion" class="control-form select-areas">
                        <option value="">Selecciona un Área</option>
                    </select>
                </div>
                <input type="submit" value="Buscar" class="btn btn-black">
            </form>
        </div>
        <table class="table" id="tabla-justificacionesxmes">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Justificaciónes</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</div>



    
