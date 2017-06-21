<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;

class LanguageController extends AbstractController
{

    use Helper;

    public function defaultAction()
    {
        if($_SESSION['lang'] == 'ar') {
            $_SESSION['lang'] = 'en';
        } else {
            $_SESSION['lang'] = 'ar';
        }
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}