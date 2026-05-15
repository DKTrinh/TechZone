<?php
class ContactModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    // Dành cho khách: Lưu liên hệ mới
    public function saveContact($fullname, $email, $phone, $subject, $message) {
        $sql = "INSERT INTO contacts (fullname, email, phone, subject, message, status, created_at) 
                VALUES (?, ?, ?, ?, ?, 'unread', NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$fullname, $email, $phone, $subject, $message]);
    }

    // Dành cho Admin: Lấy tất cả liên hệ
    public function getAllAdmin() {
        return $this->db->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Dành cho Admin: Đổi trạng thái
    public function updateStatus($id, $status) {
        $sql = "UPDATE contacts SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    // Dành cho Admin: Xóa liên hệ
    public function delete($id) {
        $sql = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    
}