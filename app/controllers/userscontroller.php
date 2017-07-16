<?php
namespace PHPMVC\Controllers;

class UsersController extends AbstractController
{
    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('users.default');
        $this->_view();
    }
}