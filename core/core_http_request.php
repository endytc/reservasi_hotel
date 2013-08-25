<?php
/** Http Request **/
if (!defined('APP_SCHEME_HTTP')) define('APP_SCHEME_HTTP', 'http');
if (!defined('APP_SCHEME_HTTPS')) define('APP_SCHEME_HTTPS', 'https');
function app_request_get_request_uri() {
    static $requestUri = null;
    if (null !== $requestUri) return $requestUri;
    // check this first so IIS will catch
    if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
        $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
    } // IIS7 with URL Rewrite: make sure we get the unencoded url (double slash problem)
    elseif (isset($_SERVER['IIS_WasUrlRewritten']) && $_SERVER['IIS_WasUrlRewritten'] == '1' && isset($_SERVER['UNENCODED_URL']) && $_SERVER['UNENCODED_URL'] != '') {
        $requestUri = $_SERVER['UNENCODED_URL'];
    }
    elseif (isset($_SERVER['REQUEST_URI'])) {
        $requestUri = $_SERVER['REQUEST_URI'];
        // Http proxy reqs setup request uri with scheme and host [and port] + the url path, only use url path
        $schemeAndHttpHost = app_request_get_scheme() . '://' . app_request_get_http_host();
        if (0 === strpos($requestUri, $schemeAndHttpHost)) {
            $requestUri = substr($requestUri, strlen($schemeAndHttpHost));
        }
    } // IIS 5.0, PHP as CGI
    elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
        $requestUri = $_SERVER['ORIG_PATH_INFO'];
        if (!empty($_SERVER['QUERY_STRING'])) {
            $requestUri .= '?' . $_SERVER['QUERY_STRING'];
        }
    }
    return $requestUri;
}
function app_request_get_scheme() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? APP_SCHEME_HTTPS : APP_SCHEME_HTTP;
}
function app_request_get_http_host() {
    $host = $_SERVER['HTTP_HOST'];
    if (!empty($host)) {
        return $host;
    }
    $scheme = app_request_get_scheme();
    $name   = $_SERVER['SERVER_NAME'];
    $port   = $_SERVER['SERVER_PORT'];
    if(null === $name) {
        return '';
    } elseif ((APP_SCHEME_HTTP == $scheme && 80 == $port) || (APP_SCHEME_HTTPS == $scheme && 443 == $port)) {
        return $name;
    } else {
        return $name . ':' . $port;
    }
}
function app_request_get_base_url() {
    static $_baseUrl = null;
    if (null !== $_baseUrl) return $_baseUrl;
    $filename = (isset($_SERVER['SCRIPT_FILENAME'])) ? basename($_SERVER['SCRIPT_FILENAME']) : '';
    if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $filename) {
        $baseUrl = $_SERVER['SCRIPT_NAME'];
    } elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $filename) {
        $baseUrl = $_SERVER['PHP_SELF'];
    } elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename) {
        $baseUrl = $_SERVER['ORIG_SCRIPT_NAME']; // 1and1 shared hosting compatibility
    } else {
        // Backtrack up the script_filename to find the portion matching php_self
        $path    = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
        $file    = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
        $segs    = explode('/', trim($file, '/'));
        $segs    = array_reverse($segs);
        $index   = 0;
        $last    = count($segs);
        $baseUrl = '';
        do {
            $seg     = $segs[$index];
            $baseUrl = '/' . $seg . $baseUrl;
            ++$index;
        } while (($last > $index) && (false !== ($pos = strpos($path, $baseUrl))) && (0 != $pos));
    }
    // Does the baseUrl have anything in common with the request_uri?
    $requestUri = app_request_get_request_uri();
    if (0 === strpos($requestUri, $baseUrl)) {
        // full $baseUrl matches
        return $_baseUrl = urldecode($baseUrl);
    }
    if (0 === strpos($requestUri, dirname($baseUrl))) {
        // directory portion of $baseUrl matches
        return $_baseUrl = urldecode(rtrim(dirname($baseUrl), '/'));
    }
    $truncatedRequestUri = $requestUri;
    if (false !== ($pos = strpos($requestUri, '?'))) {
        $truncatedRequestUri = substr($requestUri, 0, $pos);
    }
    $basename = basename($baseUrl);
    if (empty($basename) || !strpos($truncatedRequestUri, $basename)) {
        // no match whatsoever; set it blank
        return $_baseUrl = '';
    }
    // If using mod_rewrite or ISAPI_Rewrite strip the script filename out of baseUrl.
    // $pos !== 0 makes sure it is not matching a value from PATH_INFO or QUERY_STRING
    if ((strlen($requestUri) >= strlen($baseUrl))
            && ((false !== ($pos = strpos($requestUri, $baseUrl))) && (0 !== $pos))) {
        $baseUrl = substr($requestUri, 0, $pos + strlen($baseUrl));
    }
    return $_baseUrl = urldecode(rtrim($baseUrl, '/'));
}
function app_request_get_base_path() {
    static $_basePath = null;
    if (null !== $_basePath) return $_basePath;
    $filename = (isset($_SERVER['SCRIPT_FILENAME'])) ? basename($_SERVER['SCRIPT_FILENAME']) : '';
    $baseUrl = app_request_get_base_url();
    if (empty($baseUrl)) {
        return $_basePath = '';
    }
    if (basename($baseUrl) === $filename) {
        $basePath = dirname($baseUrl);
    } else {
        $basePath = $baseUrl;
    }
    if ('WIN' === substr(PHP_OS, 0, 3)) {
        $basePath = str_replace('\\', '/', $basePath);
    }
    return $_basePath = rtrim($basePath, '/');
}
function app_request_get_path_info() {
    static $_pathInfo = null;
    if (null !== $_pathInfo) return $_pathInfo;
    $baseUrl = app_request_get_base_url();
    if (null === ($requestUri = app_request_get_request_uri())) {
        return $_pathInfo = '';
    }
    // Remove the query string from REQUEST_URI
    if (false !== ($pos = strpos($requestUri, '?'))) {
        $requestUri = substr($requestUri, 0, $pos);
    }
    $requestUri = urldecode($requestUri);
    if (null !== $baseUrl && ((!empty($baseUrl) && 0 === strpos($requestUri, $baseUrl)) || empty($baseUrl)) && false === ($pathInfo = substr($requestUri, strlen($baseUrl)))){
        // If substr() returns false then PATH_INFO is set to an empty string
        $pathInfo = '';
    } elseif (null === $baseUrl || (!empty($baseUrl) && false === strpos($requestUri, $baseUrl))) {
        $pathInfo = $requestUri;
    }
    return $_pathInfo = (string) $pathInfo;
}
function app_request_get_method() {
    return strtoupper($_SERVER['REQUEST_METHOD']);
}
function app_request_method_is($method) {
    return strtoupper($method) === app_request_get_method();
}
function app_request_is_xml_http_request() {
    return ('XMLHttpRequest' == $_SERVER['HTTP_X_REQUESTED_WITH']);
}
function app_request_is_flash_request() {
    return (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), ' flash')) ? true : false;
}
function app_request_get_raw_body() {
    static $_rawRequest = null;
    if (null !== $_rawRequest) {
        return $_rawRequest;
    }
    $body = file_get_contents('php://input');
    return $_rawRequest = (strlen(trim($body)) > 0) ? $body : false;
}
?>
