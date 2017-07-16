<?php
namespace PHPMVC;

use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Template\Template;

if(!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';

$session = new SessionManager();
$session->start();

if(!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = APP_DEFAULT_LANGUAGE;
}

$template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php';

$template = new Template($template_parts);
$language = new Language();

$frontController = new FrontController($template, $language);
$frontController->dispatch();
