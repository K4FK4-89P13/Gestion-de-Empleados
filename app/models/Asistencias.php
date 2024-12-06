<?php

class Asistencias extends Model {

    public function getAsistencias() {
        $sql = "SELECT id_asistencia, personal.nombres AS personal, fecha, hora_entrada, hora_salida, justificacion
            FROM asistencias
            JOIN personal ON fk_personal = personal.id_personal";
        
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if( !$resultados ) {
                throw new Exception('Error al obtener Asistencias');
            }
            return ['datos' => $resultados];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}