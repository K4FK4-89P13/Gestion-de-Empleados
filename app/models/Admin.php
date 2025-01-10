<?php
class Admin extends Model {

    public function insertAdmin($datos) {
        $sql  = "INSERT INTO admin (nombres, dni, contrasenia) VALUES (?, ?, 'password')";
        $stmt = $this->db->prepare($sql);
        try {
            if (!$stmt->execute($datos)) {
                throw new Exception('Error en la consulta');
            }
            return ['message' => 'Registrado correctamente'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function allAdmin() {
        $sql = "SELECT id_admin, nombres, dni FROM admin WHERE estado = 1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if( !$resultados ){
                throw new Exception('Error en la consulta Admin');
            }
            return ['datos' => $resultados];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
    public function validacion($dataArray) {
        $sql = "SELECT nombres, dni FROM admin WHERE dni = ? AND contrasenia = ? AND estado = 1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                $dataArray['dni'],
                $dataArray['contrasenia']
            ]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if( !$admin ){
                throw new Exception("Datos incorrectos o incompletos");
            }
            $admin['rol'] = 'Administrador';
            return ['admin' => $admin];

        }catch(Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    function disableAdmin($id) {
        $sql = "UPDATE admin SET estado = 0 WHERE id_admin = ?";
        $stmt = $this->db->prepare($sql);
        try {
            if(!$stmt->execute([$id])){
                throw new Exception('Error al eliminar Admin');
            };
            return ['message' => 'Administrador eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}