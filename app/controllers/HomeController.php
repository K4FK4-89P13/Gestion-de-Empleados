<?php

class HomeController extends Controller {

    public function index() {
        $this->load_view('admin/home');
    }

    public function showAdmin() {
        $adminModel = $this->load_model('Admin');
        $admin = $adminModel->getAllAdmin();
        header('Content-Type: applicatoin/json');
        echo json_encode($admin);
    }
    
    public function showPersonal() {
        $personalModel = $this->load_model('Personal');
        $personal = $personalModel->getAllPersonal();
        header('Content-Type: application/json');
        echo json_encode($personal);
    }
    public function showAreas() {
        $areasModel = $this->load_model('Areas');
        $areas = $areasModel->getAllAreas();
        header('Content-Type: application/json');
        echo json_encode($areas);
    }
    
    /* Insertar nuevos registros */
    public function newPersonal() {
        $data = json_decode( file_get_contents('php://input'), true );

        if( $data ) {
            $personalModel = $this->load_model('Personal');
            $personal = $personalModel->insertPersonal($data);
            header('Content-Type: application/json');
            echo json_encode($personal);
        }
    }
}