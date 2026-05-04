<?php
class Database {
    public static function getConnection() {
        try {
            $conn = new PDO(
                "mysql:host=localhost;dbname=cleantech;charset=utf8mb4",
                "root",
                ""
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }
}