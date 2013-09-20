<?php
if( !class_exists('VPBackupAdmin') ) {

    final class VPBackupAdmin {
        private $namespace;

        public function __construct() {
            $this->namespace = 'vpbackup';
            add_action('admin_menu', array($this, 'addMenuPages'), 0);
            // Make sure the helper functions have been included.
            require_once(dirname(__file__) . '/helpers.php');
        }

        public function addMenuPages() {
            // Register the main page (that appears in the sidebar)
            $page_title = __('Volcanic Pixels Backup', 'vpbackup');
            $menu_title = __('VP Backup', 'vpbackup');
            $capability = 'manage_options';
            $menu_slug = $this->namespace;
            $function = array($this, 'mainPage');
            add_menu_page(
                $page_title,
                $menu_title,
                $capability,
                $menu_slug,
                $function
            );
        }

        // Dispatches to relevant page depending on whether the plugin is
        // configured or not.
        // ?plugin_installed - shows the helpful getting started guide
        public function mainPage() {
            $getting_started = true;

            if (array_key_exists('plugin_installed', $_GET)) {
                $getting_started = true;
            }

            if ($getting_started) {
                return $this->gettingStartedPage();
            }
        }


        /**
         * Displays the "Getting started" page that asks the user whether
         * they want to "setup backup", "restore from a backup" or "try the plugin".
         */
        public function gettingStartedPage() {
            $page = new VPBackup_Pages_GettingStarted();
            $page->render();
        }
    }
}
