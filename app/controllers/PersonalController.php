<?php

class PersonalController extends Controller {

    protected $asistenciasModel;
    public function __construct()
    {
        $this->asistenciasModel = $this->load_model('Asistencias');
    }

    public function index() {
        $this->load_view('personal/home');
    }

    public function registrarEntrada() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->asistenciasModel->registrarEntrada($data);
        echo json_encode($resultado);
    }

    public function registrarSalida() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->asistenciasModel->registrarSalida($data);
        echo json_encode($resultado);
    }

}