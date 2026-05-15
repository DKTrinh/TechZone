<?php
require_once __DIR__ . '/../core/BaseModel.php';

class CommentModel extends BaseModel {
    protected $table = 'comments';

    public function getCommentsByNews($news_id) {
        $sql = "SELECT c.*, u.fullname, u.avatar FROM comments c JOIN users u ON c.user_id = u.id WHERE c.news_id = ? ORDER BY c.created_at DESC";
        return $this->fetchAll($sql, [$news_id]);
    }

    public function addComment($news_id, $user_id, $content) {
        $sql = "INSERT INTO comments (news_id, user_id, content, created_at) VALUES (?, ?, ?, NOW())";
        return $this->execute($sql, [$news_id, $user_id, $content]);
    }

    public function getAllAdmin() {
        $sql = "SELECT c.*, u.fullname as user_name, n.title as news_title FROM comments c JOIN users u ON c.user_id = u.id JOIN news n ON c.news_id = n.id ORDER BY c.created_at DESC";
        return $this->fetchAll($sql);
    }

    public function search($keyword) {
        $sql = "SELECT c.*, u.fullname as user_name, n.title as news_title FROM comments c JOIN users u ON c.user_id = u.id JOIN news n ON c.news_id = n.id WHERE c.content LIKE ? ORDER BY c.created_at DESC";
        return $this->fetchAll($sql, ["%$keyword%"]);
    }

    public function delete($id) {
        $sql = "DELETE FROM comments WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}