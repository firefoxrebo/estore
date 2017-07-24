<?php
namespace PHPMVC\Controllers;

use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;

class UsersController extends AbstractController
{

    private $_createActionRoles =
    [
        'Username'      => 'req|alphanum|between(3,12)',
        'Password'      => 'req|min(6)',
        'CPassword'     => 'req|min(6)',
        'Email'         => 'req|email',
        'CEmail'        => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'GroupId'       => 'req|int'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');

        $this->_data['users'] = UserModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');

        $this->_data['groups'] = UserGroupModel::getAll();

        if(isset($_POST['submit'])) {
            $this->isValid($this->_createActionRoles, $_POST);

        }

        $this->_view();
    }
}