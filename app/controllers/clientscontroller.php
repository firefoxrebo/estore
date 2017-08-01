<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\lib\Messenger;
use PHPMVC\Models\ClientModel;

class ClientsController extends AbstractController
{

    use InputFilter;
    use Helper;

    private $_createActionRoles =
    [
        'Name'          => 'req|alpha|between(3,40)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'Address'       => 'req|alphanum|max(50)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('clients.default');

        $this->_data['clients'] = ClientModel::getAll();

        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('clients.create');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client = new ClientModel();

            $client->Name = $this->filterString($_POST['Name']);
            $client->Email = $this->filterString($_POST['Email']);
            $client->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $client->Address = $this->filterString($_POST['Address']);

            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->_data['client'] = $client;

        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client->Name = $this->filterString($_POST['Name']);
            $client->Email = $this->filterString($_POST['Email']);
            $client->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $client->Address = $this->filterString($_POST['Address']);

            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->language->load('clients.messages');

        if($client->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/clients');
    }
}