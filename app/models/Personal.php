<?php

class Personal extends Model{
    public function getAllPersonal() {
        $sql = "SELECT personal.*, areas.nombre AS area FROM personal JOIN areas ON fk_area = areas.id_area";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute() ){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "No se pudo obtener el personal";
        }
    }

    public function insertPersonal($dataArray) {
        $sql = "INSERT INTO personal (nombres, dni, telefono, email, cargo, departamento, fk_area) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $dataArray;
        //if( $stmt->execute() )
    }
}