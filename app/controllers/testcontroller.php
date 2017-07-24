<?php
namespace PHPMVC\Controllers;

use PHPMVC\Lib\Validate;

class TestController extends AbstractController
{
    use Validate;
    public function defaultAction()
    {
        $str = 'الحقل %s يجب ان يحتوي على قيمة';
        $newString = sprintf($str, 'اسم المستخدم');
        echo $newString;
    }
}