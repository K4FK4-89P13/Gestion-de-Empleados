<?php

class HomeController extends Controller {

    public function index() {
        $this->load_view('admin/home');
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
}