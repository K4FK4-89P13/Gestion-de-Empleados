<?php

class Personal extends Model{
    public function allPersonal() {
        $sql = "SELECT id_personal, nombres, dni, telefono, email, cargo, departamento, fecha_ingreso, sueldo, areas.nombre AS area
                FROM personal
                JOIN areas ON fk_area = areas.id_area
                WHERE personal.habilitado = 1";

        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if( empty($resultados) ){
                throw new Exception('No se pudo obtener');
            }
            return ['datos' => $resultados];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function insertPersonal($dataArray) {
        $sql = "INSERT INTO personal (nombres, dni, telefono, email, cargo, departamento, fk_area) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $dataArray;
        //if( $stmt->execute() )
    }

    public function disablePersonal($id) {
        $sql = "UPDATE personal SET habilitado = 0 WHERE id_personal = ?";
        $stmt = $this->db->prepare($sql);
        try {
            if(!$stmt->execute([$id])) {
                throw new Exception('Error al eliminar el personal');
            }
            return ['message' => 'Personal eliminado correctamente'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function buscarPersonal($filtros) {
        $sql = "SELECT id_personal, nombres, dni, telefono, email, cargo, departamento, fecha_ingreso, sueldo, areas.nombre AS area
                FROM personal
                JOIN areas ON fk_area = areas.id_area
                WHERE 1 = 1";
        $data = [];

        if (!empty($filtros['dni'])) {
            $sql .= " AND dni LIKE ?";
            $data[] = $filtros['dni']."%";
        }
        if (!empty($filtros['nombres'])) {
            $sql .= " AND nombres LIKE ?";
            $data[] = "%" . $filtros['nombres'] . "%";
        }
        if (!empty($filtros['areas'])) {
            $sql .= " AND fk_area = ?";
            $data[] = $filtros['areas'];
        }
        if (!empty($filtros['fecha-ingreso'])) {
            $sql .= " AND DATE_FORMAT(fecha_ingreso, '%Y-%m') = ?";
            $data[] = $filtros['fecha-ingreso'];
        }
        if (!empty($filtros['sueldo'])) {
            $sql .= " AND sueldo < ?";
            $data[] = $filtros['sueldo'];
        }
        if (!empty($filtros['puesto-trabajo'])) {
            $sql .= " AND puesto = ?";
            $data[] = $filtros['puesto-trabajo'];
        }

        $stmt = $this->db->prepare($sql);
        //return $data;

        try {
            $stmt->execute($data);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(empty($resultados)) {
                return ['error' => 'No se encontraron coincindencias'];
            }

            return ['datos' => $resultados];
        } catch (Exception $e) {
            return ['errorsql' => $e->getMessage()];
        }
    }

    public function validacion($data) {
        $sql = "SELECT id_personal, nombres, dni, telefono, email  FROM personal WHERE dni = ? AND contrasenia = ? AND habilitado = 1";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                $data['dni'],
                $data['contrasenia']
            ]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if( !$admin ){
                throw new Exception("Personal no registrado");
            }
            $admin['rol'] = 'Personal';
            return ['personal' => $admin];

        }catch(Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

}