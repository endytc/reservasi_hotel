<?php 
session_start();
 
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

$rootPath = dirname(__FILE__);
$applicationDir = 'app';
$defaultAction = 'index';

//$idforrole=(isset($_SESSION['layout'])?$_SESSION['layout']:null);
//if (isset($idforrole)) {
//	switch($idforrole) {
//		case "1": $layoutScript = 'views/layout'; $layoutbreak=1;break;
//		case "2": $layoutScript = 'views/lite'; $layoutbreak=2; break;
//                
//	}
//} 
require_once $rootPath . '/core/core_http_request.php';
$pageModule=substr(app_request_get_path_info(),0,10);
$pageModuleOperator=substr(app_request_get_path_info(),0,13);
$layoutScript = 'views/layout';
//print_r($_SESSION);
if(isset($_SESSION['layout'])){
    $layoutScript = $_SESSION['layout'];
    unset($_SESSION['layout']);
}else if(empty($_SESSION['id_user']) && ($pageModule=='/pageadmin' || $pageModuleOperator=='/pageoperator')){
    $layoutScript = 'views/login';
}else if(isset($_GET['ajax']) && $_GET['ajax']==1){
    $layoutScript='views/no_layout';
}
else if($pageModule=='/pageadmin' || $pageModuleOperator=='/pageoperator'){
    $layoutScript='views/admin_layout';
}
require_once $rootPath . '/core/core.php';
require_once $rootPath .'/app/lib/function.php';
require_once $rootPath .'/app/lib/mail/class.phpmailer.php';
require_once $rootPath .'/app/lib/mail/class.pop3.php';
require_once $rootPath .'/app/lib/mail/class.smtp.php';
require_once $rootPath .'/app/lib/db.php';
//GO GO GO
app_core_run();
