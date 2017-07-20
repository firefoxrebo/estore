<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class UsersGroupsController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.default');

        $this->_data['groups'] = UserGroupModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');

        $this->_data['privileges'] = PrivilegeModel::getAll();

        if(isset($_POST['submit'])) {
            $group = new UserGroupModel();
            $group->GroupName = $this->filterString($_POST['GroupName']);
            if($group->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    foreach ($_POST['privileges'] as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }

        $this->_view();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if($group === false) {
            $this->redirect('/usersgroups');
        }

        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');

        $this->_data['group'] = $group;
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $extractedPrivilegesIds = $this->_data['groupPrivileges'] = UserGroupPrivilegeModel::getGroupPrivileges($group);

        if(isset($_POST['submit'])) {
            $group->GroupName = $this->filterString($_POST['GroupName']);
            if($group->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {

                    $privilegesIdsToBeDeleted = array_diff($extractedPrivilegesIds, $_POST['privileges']);
                    $privilegesIdsToBeAdded = array_diff($_POST['privileges'], $extractedPrivilegesIds);
                    
                    // Delete the unwanted privileges
                    foreach ($privilegesIdsToBeDeleted as $deletedPrivilege) {
                        $unwantedPrivilege = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $deletedPrivilege, 'GroupId' => $group->GroupId]);
                        $unwantedPrivilege->current()->delete();
                    }

                    // Add the new privileges
                    foreach ($privilegesIdsToBeAdded as $privilegeId) {
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if($group === false) {
            $this->redirect('/usersgroups');
        }

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupId' => $group->GroupId]);

        if(false !== $groupPrivileges) {
            foreach ($groupPrivileges as $groupPrivilege) {
                $groupPrivilege->delete();
            }
        }

        if($group->delete()) {
            $this->redirect('/usersgroups');
        }
    }
}