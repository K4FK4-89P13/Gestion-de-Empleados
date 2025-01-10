<?php

class Areas extends Model{
    public function allAreas() {
        $sql = "SELECT id_area, nombre, descripcion FROM areas WHERE habilitado = 1";
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if( !($resultados) ){
                throw new Exception('Error en la consulta');
            }
            return ['datos' => $resultados];
        } catch (Exception $e) {
            return ['error' => $e->getMEssage()];
        }
    }

    public function deleteArea($data) {
        $sql = "UPDATE areas SET habilitado = 0 WHERE id_area = ?";
        $stmt = $this->db->prepare($sql);
        try {
            if(!$stmt->execute([$data])){
                throw new Exception('Error al eliminar area');
            }
            return ['message' => 'Eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}