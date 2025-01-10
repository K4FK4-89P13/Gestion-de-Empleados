<?php

class AdminController extends Controller {

    private $adminModel, $personalModel, $areaModel, $asistenciasModel;
    
    public function __construct() {
        $this->adminModel = $this->load_model('Admin');
        $this->personalModel = $this->load_model('Personal');
        $this->areaModel = $this->load_model('Areas');
        $this->asistenciasModel = $this->load_model('Asistencias');
    }

    public function index() {
        $this->load_view('admin/home');
    }


    /* ADMINISTRADOR */
    public function allAdmin() {
        $admin = $this->adminModel->allAdmin();
        header('Content-Type: applicatoin/json');
        echo json_encode($admin);
    }
    public function newAdmin() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->adminModel->insertAdmin([$data['nombre-admin'], $data['dni-admin']]);
        echo json_encode($resultado);
    }
    public function disableAdmin() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultados = $this->adminModel->disableAdmin($data['id_fila']);
        echo json_encode($resultados);
    }
    

    /* PERSONAL */
    public function allPersonal() {
        $personal = $this->personalModel->allPersonal();
        header('Content-Type: application/json');
        echo json_encode($personal);
    }
    public function newPersonal() {
        $data = json_decode( file_get_contents('php://input'), true );
        $personal = $this->personalModel->insertPersonal($data);
        header('Content-Type: application/json');
        echo json_encode($personal);
    }
    public function disablePersonal() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultados = $this->adminModel->disablePersonal($data['id_fila']);
        echo json_encode($resultados);
    }
    public function buscarPersonal() {
        $filtros = json_decode( file_get_contents('php://input'), true );
        //echo print_r($filtros);
        $resultados = $this->personalModel->buscarPersonal($filtros);
        echo json_encode($resultados);
    }


    /* AREAS */
    public function allAreas() {
        $areas = $this->areaModel->allAreas();
        header('Content-Type: application/json');
        echo json_encode($areas);
    }
    public function disableArea() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultados = $this->areaModel->disableArea($data['id_fila']);
        echo json_encode($resultados);
    }


    /* ASISTENCIAS */
    public function allAsistencias() {
        $asistencias = $this->asistenciasModel->allAsistencias('Asistencias');
        header('Content-Type: application/json');
        echo json_encode($asistencias);
    }
    public function newAsistencia() {
        $data = json_decode( file_get_contents('php://input'), true );
        $asistencia = $this->asistenciasModel->insertAsistencia($data);
        header('Content-Type: application/json');
        echo json_encode($asistencia);
    }
    public function disableAsistencia() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultados = $this->asistenciasModel->disableAsistencia($data['id_fila']);
        echo json_encode($resultados);
    }
    public function updateAsistencia() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultados = $this->asistenciasModel->updateAsistencia($data);
        echo json_encode($resultados);
    }
    public function asistenciaPorDni() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->asistenciasModel->asistenciaPorDni($data);
        echo json_encode($resultado);
    }
    public function setJustificacion() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->asistenciasModel->setJustificacion($data);
        echo json_encode($resultado);
    }
    public function faltasXmes() {
        $data = json_decode( file_get_contents('php://input'), true );
        $resultado = $this->asistenciasModel->faltasXmes($data);
        echo json_encode($resultado);
    }

}