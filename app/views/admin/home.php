
<link rel="stylesheet" href="./assets/css/admin.css">
    <?php include_once APP_PATH . '/app/views/inc/header.php' ?>

    <div id="customAlert">
        <span class="close-alert">&times;</span>
        <span id="alertMessage">Este es un mensaje.</span>
    </div>
    
    <?php include_once APP_PATH . '/app/views/components/header-menu.php' ?>  

    <div class="container">
         <!-- Menu para navegar por las tablas -->
        <div class="contenedor-tab">
            <div id="admin-div">
                <div class="tab-header btn btn-black">
                    <span>Administradores</span>
                </div>
            </div>
            <div id="personal-div">
                <div class="tab-header btn btn-blank">
                    <span>Personal</span>
                </div>
            </div>
            <div id="areas-div">
                <div class="tab-header btn btn-blank">
                    <span>Areas</span>
                </div>
            </div>
            <div id="asistencias-div">
                <div class="tab-header btn btn-blank">
                    <span>Asistencias</span>
                </div>
            </div>
            <div id="consultas-div">
                <div class="tab-header btn btn-blank">
                    <span>Consultas</span>
                </div>
            </div>
        </div>

        <div id="contenido" class="tab-content">

            <!-- Pagina de Administradores -->
            <?php include_once APP_PATH . '/app/views/admin/content-admin/administrador.php'?>

            <!-- Pagina de Empleados -->
            <?php include_once APP_PATH . '/app/views/admin/content-admin/personal.php'?>

            <!-- Pagina de Areas -->
            <?php include_once APP_PATH . '/app/views/admin/content-admin/areas.php'?>

            <!-- Pagina de asistencias -->
            <?php include_once APP_PATH . '/app/views/admin/content-admin/asistencias.php'?>

            <!-- Pagina de consultas -->
             <?php include_once APP_PATH . '/app/views/admin/content-admin/consultas.php' ?>

        </div>
    </div>
    

    <!-- javaScript de la Vista -->
    <script type="module" src="./assets/js/admin.js"></script>

    <!-- Footer -->
    <?php include_once APP_PATH . '/app/views/inc/footer.php'?>
