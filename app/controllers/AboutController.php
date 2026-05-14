<?php
require_once '../app/models/PageModel.php';
class AboutController {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function index() {
        $model = new PageModel($this->db);
        $rawContents = $model->getAboutContent(); 
        
        $contents = [];
        foreach ($rawContents as $row) {
            $contents[$row['page_key']] = [
                'section_name' => $row['section_name'],
                'content_value' => $row['content_value']
            ];
        }
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/about.php';
        require_once '../app/views/layouts/footer.php';
    }
}