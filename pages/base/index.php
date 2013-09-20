<?php
/**
 * Base class for pages.
 */
class VPBackup_Pages_Base {
    /**
     * Returns the page name e.g.
     *
     * VPBackup_Pages_Base would have a name of Base
     * @return [type] [description]
     */
    public function pageName() {
        $class = get_class($this);
        return str_replace('VPBackup_Pages_', '', $class);
    }
    /**
     * Renders the page template
     */
    public function render() {
        $template = 'pages/' . strtolower($this->pageName()) . '/index.html';
        echo vp_render_template($template);
    }
}
