<?php
require_once __DIR__ . '/../core/BaseModel.php';

class NewsModel extends BaseModel {
    protected $table = 'news';

    public function getAllNews() {
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        return $this->fetchAll($sql);
    }

    public function getLatestNews($limit = 3) {
        $sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT " . (int)$limit;
        return $this->fetchAll($sql);
    }

    public function getPublished($keyword = '', $page = 1, $limit = 6) {
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM news WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        return $this->fetchAll($sql, ["%$keyword%", "%$keyword%"]);
    }

    public function countNews($keyword = '') {
        $sql = "SELECT COUNT(*) as total FROM news WHERE title LIKE ? OR content LIKE ?";
        $result = $this->fetchOne($sql, ["%$keyword%", "%$keyword%"]);
        return $result['total'] ?? 0;
    }

    public function getById($id) {
        $sql = "SELECT * FROM news WHERE id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    public function search($keyword) {
        $sql = "SELECT * FROM news WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC";
        return $this->fetchAll($sql, ["%$keyword%", "%$keyword%"]);
    }

    public function create($data) {
        $sql = "INSERT INTO news (title, content, image, category, badge, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
        return $this->execute($sql, [$data['title'], $data['content'], $data['image'], $data['category'], $data['badge']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE news SET title = ?, content = ?, image = ?, category = ?, badge = ? WHERE id = ?";
        return $this->execute($sql, [$data['title'], $data['content'], $data['image'], $data['category'], $data['badge'], $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM news WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}