<?php
class FaqModel {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function getAll() {
        return $this->db->query("SELECT * FROM faqs ORDER BY f_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getForUser($limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE status = 'answered' ORDER BY f_id DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM faqs WHERE f_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($title, $question, $answer = null, $status = 'pending') {
        $sql = "INSERT INTO faqs (title, question, answer, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$title, $question, $answer, $status]);
    }

    public function update($id, $title, $question, $answer, $status) {
        $sql = "UPDATE faqs SET title = ?, question = ?, answer = ?, status = ? WHERE f_id = ?";
        return $this->db->prepare($sql)->execute([$title, $question, $answer, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM faqs WHERE f_id = ?");
        return $stmt->execute([$id]);
    }
}
