<style>
    #buscador-avanzado {
        border-bottom: 1px solid var(--second-color);
        /* border-right: none;
        border-left: none; */
        padding-bottom: 10px;
    }
    #formulario-buscador {  
        display: grid;  
        margin: 0;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }  
    .marginb-3 {  
        flex: 1; /* Cada elemento puede ocupar el mismo ancho */  
        min-width: 200px; /* Ancho mínimo para los inputs */  
    } 
</style>

<div id="buscador-avanzado">
    <h3>Búsqueda Avanzada</h3>
    <div id="form-buscador">
        <form id="formulario-buscador">
            <div class="marginb-3">
                <label for="dni">Buscar por DNI</label>
                <input type="text" name="dni" id="dni" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="nombres">Buscar por Nombre o Apellido</label>
                <input type="text" name="nombres" id="nombres" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="areas">Buscar por Área</label>
                <select name="areas" id="areas" class="control-form">
                    <option value="">Selecciona un Área</option>
                    <option value="1">Matemáticas</option>
                    <option value="2">Ciencias</option>
                </select>
            </div>
            <div class="marginb-3">
                <label for="fecha-ingreso">Buscar por Fecha de Ingreso</label>
                <input type="date" name="fecha-ingreso" id="fecha-ingreso" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="sueldo">Buscar por Sueldo menor a</label>
                <input type="number" name="sueldo" id="sueldo" class="control-form">
            </div>
            <div class="marginb-3">
                <label for="puesto-trabajo">Buscar por Puesto de Trabajo</label>
                <input type="text" name="puesto-trabajo" id="puesto-trabajo" class="control-form">
            </div>
            <input type="submit" value="Buscar" class="btn btn-black">
        </form>
    </div>
   <!--  <button class="btn btn-black" id="btn-buscar">Buscar</button> -->
</div>
