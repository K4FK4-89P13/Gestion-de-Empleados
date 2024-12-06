<?php

class PersonalController extends Controller {

    public function newAdmin() {
        $data = json_decode( file_get_contents('php://input'), true );
        //echo json_encode(['datos' => $data]);
        //echo print_r($data);
        $adminModel = $this->load_model('Admin');
        $resultado = $adminModel->insertAdmin([$data['nombre-admin'], $data['dni-admin']]);
        echo json_encode($resultado);
    }

    public function buscar() {
        $filtros = json_decode( file_get_contents('php://input'), true );
        //echo print_r($filtros);
        $personalModel = $this->load_model('Personal');
        $resultados = $personalModel->buscarPersonal($filtros);
        echo json_encode($resultados);
    }

    public function disable() {
        $data = json_decode( file_get_contents('php://input'), true );
        $adminModel = $this->load_model('Admin');
        //echo print_r($data);
        $resultados = $adminModel->disableAdmin($data['id_fila']);
        echo json_encode($resultados);
    }

    public function disablePersonal() {
        $data = json_decode( file_get_contents('php://input'), true );
        $adminModel = $this->load_model('Personal');
        //echo print_r($data);
        $resultados = $adminModel->disablePersonal($data['id_fila']);
        echo json_encode($resultados);
    }

    public function disableArea() {
        $data = json_decode( file_get_contents('php://input'), true );
        $areaModel = $this->load_model('Areas');
        $resultados = $areaModel->deleteArea($data['id_fila']);
        echo json_encode($resultados);
    }

    public function getAllAsistencias() {
        $data = json_decode( file_get_contents('php://input'), true );
        $asistenciaModel = $this->load_model('Asistencias');
        $resultados = $asistenciaModel->getAsistencias();
        echo json_encode($resultados);
    }
}