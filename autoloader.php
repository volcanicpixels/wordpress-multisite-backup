<?php
class VPBackup_Autoloader {
    public static function register() {
        spl_autoload_register(array(new self, 'autoload'));
    }

    public static function autoload($class) {
        if(0 !== strpos($class, 'VPBackup')) {
            return;
        }

        $class = str_replace('VPBackup', '', $class);
        $class = str_replace('_', '/', $class);
        $class = strtolower($class);

        $file = dirname(__FILE__) . $class . '/index.php';

        if (is_file($file)) {
            require($file);
        }
    }
}
