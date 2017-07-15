<?php
namespace PHPMVC\Controllers;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('index.default');
        $this->_view();
    }
}