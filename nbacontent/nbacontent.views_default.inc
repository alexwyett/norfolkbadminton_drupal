<?php
       
/**
 * Implements hook_views_default_views().
 */
function nbacontent_views_default_views() {
    $files = file_scan_directory(drupal_get_path('module', 'nbacontent'). '/views', '/.view/');
    $views = false;
    foreach ($files as $filepath => $file) {
        require $filepath;
        if (isset($view)) {
            $views[$view->name] = $view;
        }
    }

    if ($views) {
        return $views;
    }
}
