<?php
class SettingModel {
    private $settingsFile;
    private $settings;
    
    public function __construct() {
        $this->settingsFile = __DIR__ . '/../../data/settings.json';
        $this->load();
    }
    
    private function load() {
        if(file_exists($this->settingsFile)) {
            $content = file_get_contents($this->settingsFile);
            $this->settings = json_decode($content, true);
        } else {
            $this->settings = [];
        }
    }
    
    public function getAll() {
        return $this->settings;
    }
    
    public function get($key, $default = '') {
        return isset($this->settings[$key]) ? $this->settings[$key] : $default;
    }
}
?>