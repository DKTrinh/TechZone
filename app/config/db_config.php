<?php
class Database {
    public static function connect() {
        try {
            return new PDO("mysql:host=localhost;dbname=cleantech;charset=utf8mb4", "root", "");
        } catch (PDOException $e) {
            die("Lỗi kết nối DB: " . $e->getMessage());
        }
    }
}