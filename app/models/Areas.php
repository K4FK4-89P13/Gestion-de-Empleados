<?php

class Areas extends Model{
    public function getAllAreas() {
        $sql = "SELECT id_area, nombre, descripcion FROM areas";
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
}