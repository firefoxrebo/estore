<?php
namespace PHPMVC\LIB;

class SessionManager extends \SessionHandler
{

    private $sessionName = SESSION_NAME;
    private $sessionMaxLifetime = SESSION_LIFE_TIME;
    private $sessionSSL = false;
    private $sessionHTTPOnly = true;
    private $sessionPath = '/';
    private $sessionDomain = '.mvcapp.com';
    private $sessionSavePath = SESSION_SAVE_PATH;

    private $sessionCipherAlgo = 'AES-128-ECB';
    private $sessionCipherKey = 'WYCRYPT0K3Y@2016';

    private $ttl = 30;

    public function __construct()
    {

        $this->sessionSSL = isset($_SERVER['HTTPS']) ? true : false;
        $this->sessionDomain = str_replace('www.', '', $_SERVER['SERVER_NAME']);

        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_trans_sid', 0);
        ini_set('session.save_handler', 'files');

        session_name($this->sessionName);

        session_save_path($this->sessionSavePath);

        session_set_cookie_params(
            $this->sessionMaxLifetime, $this->sessionPath,
            $this->sessionDomain, $this->sessionSSL,
            $this->sessionHTTPOnly
        );

//        session_set_save_handler($this, true);
    }

    public function __get($key) {
        if(isset($_SESSION[$key])) {
            $data = @unserialize($_SESSION[$key]);
            if($data === false) {
                return $_SESSION[$key];
            } else {
                return $data;
            }
        } else {
            trigger_error('No session key ' . $key . ' exists', E_USER_NOTICE);
        }
    }

    public function __set($key, $value) {
        if(is_object($value)) {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    public function __unset($key)
    {
        unset($_SESSION[$key]);
    }

    public function read($id)
    {
        return openssl_decrypt(parent::read($id), $this->sessionCipherAlgo, $this->sessionCipherKey);
    }

    public function write($id, $data)
    {
        return parent::write($id, openssl_encrypt($data, $this->sessionCipherAlgo, $this->sessionCipherKey));
    }

    public function start()
    {
        if('' === session_id()) {
            if(session_start()) {
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }

    private function setSessionStartTime()
    {
        if(!isset($this->sessionStartTime)) {
            $this->sessionStartTime = time();
        }
        return true;
    }

    private function checkSessionValidity()
    {
        if((time() - $this->sessionStartTime) > ($this->ttl * 60)) {
            $this->renewSession();
            $this->generateFingerPrint();
        }
        return true;
    }

    private function renewSession()
    {
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }

    public function kill()
    {
        session_unset();

        setcookie(
            $this->sessionName, '', time() - 1000,
            $this->sessionPath, $this->sessionDomain,
            $this->sessionSSL, $this->sessionHTTPOnly
        );

        session_destroy();
    }

    private function generateFingerPrint()
    {
        $userAgentId = $_SERVER['HTTP_USER_AGENT'];
        $this->cipherKey = openssl_random_pseudo_bytes(16);
        $sessionId = session_id();
        $this->fingerPrint = md5($userAgentId . $this->cipherKey . $sessionId);
    }

    public function isValidFingerPrint()
    {
        if(!isset($this->fingerPrint)) {
            $this->generateFingerPrint();
        }

        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());

        if($fingerPrint === $this->fingerPrint) {
            return true;
        }

        return false;
    }

    public function dumpSessionVariables()
    {
        var_dump($_SESSION);
    }

    public function gc($maxLifetime)
    {
        parent::gc($maxLifetime);
    }
}