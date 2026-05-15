<?php
require_once '../app/models/ContactModel.php';

class AdminContactController {
    private $db;
    private $contactModel;

    public function __construct($db) {
        $this->db = $db;
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') { header('Location: public_entry.php?url=login'); exit(); }
        $this->contactModel = new ContactModel($this->db);
    }

    public function index() {
        $contacts = $this->contactModel->getAllAdmin();
        include '../app/views/admin/contacts/index.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->contactModel->updateStatus($_POST['id'], $_POST['status']);
            header('Location: public_entry.php?url=admin/contacts'); exit;
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $this->contactModel->delete($_GET['id']);
        }
        header('Location: public_entry.php?url=admin/contacts'); exit;
    }
}