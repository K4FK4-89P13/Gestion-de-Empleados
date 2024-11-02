<?php

class Areas extends Model{
    public function getAllAreas() {
        $sql = "SELECT * FROM areas";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "No se pudo obtener las Areas";
        }
    }
}