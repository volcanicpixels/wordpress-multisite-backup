<?php
// Provides various helper functions

/**
 * Loads a php file relative to the plugin root.
 * @param  string $path The path relative to the current directory.
 *                      Should start with a forward slash.
 */
function vp_load_file($path) {
    require_once(dirname(__file__) . $path);
}

function vp_load_module($path) {
    return vp_load_file('/' . $path . '/index.php');
}


/**
 * Helper to render a template
 * @param  [type] $template the template e.g. pages/gettingstarted
 * @param  array  $vars     vars to pass to the template
 * @return string           the rendered template
 */
function vp_render_template($template, $vars = array()) {
    return VPBackup::getTwig()->render($template, $vars);
}
