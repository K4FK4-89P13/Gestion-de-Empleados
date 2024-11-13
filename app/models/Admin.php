<?php
class Admin extends Model {

    public function getAllAdmin() {
        $sql = "SELECT id_admin, nombres, dni FROM admin WHERE estado = 1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Error $e) {
            return json_encode(['error' => "".$e->getMessage()]);
        }
    }
    
    public function validacion($dataArray) {
        $sql = "SELECT dni, nombres, contrasenia FROM admin WHERE dni = ? AND contrasenia = ? AND estado = 1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([$dataArray['dni'], $dataArray['contrasenia']]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(Error $e) {
            return json_encode(['error' => "".$e->getMessage()]);
        }
    }
}