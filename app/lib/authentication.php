<?php
namespace PHPMVC\lib;


class Authentication
{
    private static $_instance;
    private $_session;

    private $_execludedRoutes = [
        '/index/default',
        '/auth/logout',
        '/users/profile',
        '/users/changepassword',
        '/users/settings',
        '/language/default',
        '/accessdenied/default',
        '/notfound/notfound',
        '/test/default'
    ];

    private function __construct($session)
    {
        $this->_session = $session;
    }

    private function __clone()
    {

    }

    public static function getInstance(SessionManager $session)
    {
        if(self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function isAuthorized()
    {
        return isset($this->_session->u);
    }

    public function hasAccess($controller, $action)
    {
        $url = strtolower('/' . $controller . '/' . $action);
        if(in_array($url, $this->_execludedRoutes) || in_array($url, $this->_session->u->privileges)) {
            return true;
        }
    }
}