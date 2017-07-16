<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template;

class AbstractController
{

    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_template;
    protected $_language;

    protected $_data = [];

    public function notFoundAction()
    {
        $this->_view();
    }

    public function setController ($controllerName)
    {
        $this->_controller = $controllerName;
    }

    public function setAction ($actionName)
    {
        $this->_action = $actionName;
    }

    public function setTemplate($template)
    {
        $this->_template = $template;
    }

    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    public function setParams ($params)
    {
        $this->_params = $params;
    }

    protected function _view()
    {
        $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
        if($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)) {
            $view = VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
        }
        $this->_data = array_merge($this->_data, $this->_language->getDictionary());
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();
    }
}