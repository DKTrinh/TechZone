<?php
class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        $viewFile = "../app/views/" . $view . ".php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View $view not found.");
        }
    }
}