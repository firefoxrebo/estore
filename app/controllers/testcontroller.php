<?php
namespace PHPMVC\Controllers;

use PHPMVC\Lib\Validate;

class TestController extends AbstractController
{
    use Validate;
    public function defaultAction()
    {
        var_dump($this->session->u);
    }
}