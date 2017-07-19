<?php
namespace PHPMVC\lib;


class Messenger
{

    const APP_MESSAGE_SUCCESS       = 1;
    const APP_MESSAGE_ERROR         = 2;
    const APP_MESSAGE_WARNING       = 3;
    const APP_MESSAGE_INFO          = 4;

    private static $_instance;

    private $_session;

    private $_messages = [];

    private function __construct($session) {
        $this->_session = $session;
    }

    private function __clone() {}

    public static function getInstance(SessionManager $session)
    {
        if(self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function add($message, $type = self::APP_MESSAGE_SUCCESS)
    {
        if(!$this->messagesExists()) {
            $this->_session->messages = [];
        }
        $msgs = $this->_session->messages;
        $msgs[] = [$message, $type];
        $this->_session->messages = $msgs;
    }

    private function messagesExists()
    {
        return isset($this->_session->messages);
    }

    public function getMessages()
    {
        if($this->messagesExists()) {
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];
    }
}