<?php
namespace PHPMVC\Controllers;

use PHPMVC\Lib\Validate;

class TestController extends AbstractController
{
    use Validate;
    public function defaultAction()
    {
        echo password_hash('encryptedkey', CRYPT_BLOWFISH);
    }
}