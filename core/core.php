<?php

/** Helpers **/
function app_base_url($path = null) {
    static $baseUrl = null;
    if (null === $baseUrl) {
        $baseUrl = app_request_get_base_url();
    }
    if (null !== $path) {
        $path = '/' . ltrim($path, '/\\');
    }
    return htmlentities($baseUrl.$path);
}

/** APP Core **/
if (!defined('APP_ROOT_PATH')) define('APP_ROOT_PATH', isset($rootPath) ? $rootPath : dirname(__FILE__));
if (!defined('APP_APP_PATH')) define('APP_APP_PATH', APP_ROOT_PATH . DIRECTORY_SEPARATOR . trim(isset($applicationDir) ? $applicationDir : 'app', '/\\'));
if (!defined('APP_ACTION_DEFAULT')) define('APP_ACTION_DEFAULT', isset($defaultAction) ? $defaultAction : 'index');
if (!defined('APP_LAYOUT_SCRIPT')) define('APP_LAYOUT_SCRIPT', isset($layoutScript) ? $layoutScript : 'layout');
function app_core_get_action($path) {
    $path = APP_APP_PATH . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR . trim($path, '/\\');
    $action = $path.'.php';
    if (file_exists($action)) {
        return $action;
    }
    // try using default action
    $default = $path . DIRECTORY_SEPARATOR . APP_ACTION_DEFAULT.'.php';
    if (file_exists($default)) {
        return $default;
    }
    // no possible action found
    return false;
}
function app_core_execute_in_scope($____filename, array $____vars = array()) {
    extract($____vars);
    ob_start();
    include_once $____filename;
    $____content = ob_get_clean();
    $_vars = array();
    // retreives "public" variables (variables prefixed with an underscore will be ignored)
    foreach (get_defined_vars() as $_name => $_value) {
        if ('_' != substr($_name, 0, 1)) {
            $_vars[$_name] = $_value;
        }
    }
    return array($____content, $_vars);
}
function app_core_render($____filename, array $____vars = array()) {
    extract($____vars);
    ob_start();
    include_once $____filename;
    return ob_get_clean();
}
function app_core_decorate_content($script, $content, array $vars = array()) {
    $script = APP_APP_PATH . DIRECTORY_SEPARATOR . ltrim($script, '/\\') . '.php';
    // only decorate content if layout script exists
    if (file_exists($script)) {
        $vars['_content'] = $content;
        list($content,$vars) = app_core_execute_in_scope($script, $vars);
    }
    return $content;
}
function app_core_run() {
    $path = app_request_get_path_info();
    if (false === ($action = app_core_get_action($path))) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    list($content, $vars) = app_core_execute_in_scope($action);
    echo app_core_decorate_content(APP_LAYOUT_SCRIPT, $content, $vars);
}
