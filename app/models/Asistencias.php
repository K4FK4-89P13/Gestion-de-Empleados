<?php

class Asistencias extends Model {

    public function allAsistencias() {
        $sql = "SELECT id_asistencia, personal.nombres AS personal, fecha, hora_entrada, hora_salida, justificacion
            FROM asistencias
            JOIN personal ON fk_personal = personal.id_personal
            WHERE personal.habilitado = 1
            ORDER BY id_asistencia";
        
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

    public function insertAsistencia($data) {
        $sql = "INSERT INTO asistencias (fk_personal, fecha, hora_entrada, hora_salida, justificacion)
                VALUES (:fk_personal, :fecha, :hora_entrada, :hora_salida, :justificacion)";
        
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                'fk_personal' => $data['id-personal'],
                'fecha' => $data['fecha'],
                'hora_entrada' => $data['hora-entrada'],
                'hora_salida' => $data['hora-salida'],
                'justificacion' => $data['justificacion']
            ]);

            if( $stmt->rowCount() == 0 ) {
                throw new Exception('Error al insertar Asistencia');
            }
            return ['message' => 'Asistencia insertada correctamente'];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateAsistencia($data) {
        $sql = "UPDATE asistencias
                SET fk_personal = :fk_personal, fecha = :fecha, hora_entrada = :hora_entrada, hora_salida = :hora_salida, justificacion = :justificacion
                WHERE id_asistencia = :id_asistencia";
        
        $stmt = $this->db->prepare($sql);

        try {
            $stmt->execute([
                'fk_personal' => $data['id-personal'],
                'fecha' => $data['fecha'],
                'hora_entrada' => $data['hora-entrada'],
                'hora_salida' => $data['hora-salida'],
                'justificacion' => $data['justificacion'],
                'id_asistencia' => $data['id-asistencia']
            ]);

            if( $stmt->rowCount() == 0 ) {
                throw new Exception('Error al actualizar Asistencia');
            }
            return ['message' => 'Asistencia actualizada correctamente'];

        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function registrarEntrada($data) {
        try {
            $sql = "INSERT INTO asistencias (fk_personal, fecha, hora_entrada) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $resultado = $stmt->execute([
                            $data['id_personal'],
                            $data['fecha_asistencia'],
                            $data['hora_entrada']
                        ]);

            if( !$resultado ) {
                throw new Exception('Error al insertar la asistencia', 1);
            }
            //$message = "Asistencia registrada" .  "\n" . $data['nombre'] . " " . $data['fecha'] .  $data['hora-entrada'];
            return ['message' => 'Asistencia registrada'];
        } catch (\Throwable $th) {
            return ['error' => $th->getMessage()];
        }
    }

    /* METODO PARA BUSCAR ASISTENCIA POR DNI */
    public function asistenciaPorDni($filtros) {
        try {
            $sql = "SELECT id_asistencia, p.nombres AS personal, fecha, hora_entrada, hora_salida, justificacion
                    FROM asistencias a
                    JOIN personal p ON p.id_personal = a.fk_personal
                    WHERE p.habilitado = 1";
            $datos = [];
            if( !empty($filtros['dni-personal']) ) {
                $sql .= " AND p.dni = ?";
                $datos[] = $filtros['dni-personal'];
            }
            if( !empty($filtros['fecha']) ) {
                $sql .= " AND a.fecha = ?";
                $datos[] = $filtros['fecha'];
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($datos);
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

            if( !($resultados) ){
                throw new Exception('No se encontraron resultados', 1);
            }
            return ['datos' => $resultados];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /* METODO PARA EDITAR LA JUSTIFICACION DE UNA ASISTENCIA */
    public function setJustificacion($data) {
        try {
            $sql = "UPDATE asistencias SET justificacion = ? WHERE id_asistencia = ?";
            $stmt = $this->db->prepare($sql);
            $resultado = $stmt->execute([
                            $data['justificacion'],
                            $data['id_asistencia']
                        ]);

            if( !$resultado ) throw new Exception('Error al actualizar la justificación', 1);
            return ['message' => 'Justificación actualizada'];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    
    public function registrarSalida($data) {
        try {
            $sql = "UPDATE asistencias a
                    JOIN personal p ON p.id_personal = a.fk_personal
                    SET a.hora_salida = ?
                    WHERE p.id_personal = ? AND a.fecha = ? AND p.contrasenia = ?";
            $stmt = $this->db->prepare($sql);
            if(!$stmt->execute([
                $data['hora_salida'],
                $data['id_personal'],
                $data['fecha_asistencia'],
                $data['contrasenia']
            ])){
                throw new Exception('Error al registrar la salida', 1);
            }
            return ['message' => 'Salida registrada'];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /* Faltas por mes clasificado por areas */
    public function faltasXmes($area) {
        try {
            $sql = "SELECT
                        month(fecha) AS mes, COUNT(*) AS total_faltas
                        FROM asistencias a
                        JOIN personal p ON p.id_personal = a.fk_personal
                        JOIN areas ar ON ar.id_area = p.fk_area
                        WHERE asistencia = 0";
            $data = [];
            if( !empty($area['area-faltas']) ){
                $sql .= " AND ar.id_area = ?";
                $data[] = $area['area-faltas'];
            }
            $sql .= " GROUP BY mes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if( !($resultados) ){
                throw new Exception('No se encontraron faltas para el área especificada', 1);
            }
            return ['datos' => $resultados];
        } catch (\Throwable $e) {
            return ['error' => $e->getMessage()];
        }
    }
}