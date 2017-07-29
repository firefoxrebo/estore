<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
use PHPMVC\Models\UserModel;

class AuthController extends AbstractController
{
    use Helper;
    public function loginAction()
    {
        $this->language->load('auth.login');

        $this->_template->swapTemplate(
        [
            ':view' => ':action_view'
        ]);

        if(isset($_POST['login'])) {
            $isAuthorized = UserModel::authenticate($_POST['ucname'], $_POST['ucpwd'], $this->session);
            if($isAuthorized == 2) {
                $this->messenger->add($this->language->get('text_user_disabled'), Messenger::APP_MESSAGE_ERROR);
            } elseif ($isAuthorized == 1) {
                $this->redirect('/');
            } elseif ($isAuthorized === false) {
                $this->messenger->add($this->language->get('text_user_not_found'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function logoutAction()
    {
        // TODO: check the cookie deletion
        $this->session->kill();
        $this->redirect('/auth/login');
    }
}