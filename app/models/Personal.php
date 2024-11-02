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
}