<?php
if( !class_exists('VPBackup') ) {
    final class VPBackup
    {
        private static $instance = null;
        private static $twig = null;
        private $admin = null;


        private function __construct()
        {
            if( is_admin() )
                $this->getAdmin();
        }


        /**
         * Singleton method for returning the plugin instance
         * @return VolcanicPixels_Backup the plugin instance
         */
        public static function getPlugin() {
            if (self::$instance === null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public static function getTwig() {
            if (self::$twig === null) {
                $loader = new Twig_Loader_Filesystem(dirname(__file__));
                self::$twig = new Twig_Environment($loader, array(
                    'debug' => true,
                    'cache' => dirname(dirname(__file__)) . '_cache'
                ));
                $function = new Twig_SimpleFunction('screen_icon', screen_icon);
                self::$twig->addFunction($function);
            }
            return self::$twig;
        } 

        public function getAdmin() {
            if($this->admin === null) {
                require_once(dirname(__file__) . '\admin.php');
                $this->admin = new VPBackupAdmin();
            }
        }
    }
}
