<?php

class Model {

    protected $db;

    public function __construct() {

        $dsn = "mysql:host=localhost;dbname=asistenciapersonal"; // Set DSN
        $this->db = new PDO($dsn, 'root', 'admin');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método genérico para ejecutar consultas
    protected function query($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}