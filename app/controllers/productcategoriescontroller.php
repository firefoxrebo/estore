<?php
namespace PHPMVC\Controllers;
use PHPMVC\lib\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class ProductCategoriesController extends AbstractController
{

    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.default');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');

        // TODO:: explain a better solution to check against file type
        // TODO:: explain a better soution to secure the upload folder
        if(isset($_POST['submit'])) {
            $category = new ProductCategoryModel();
            $category->Name = $this->filterString($_POST['Name']);
            $category->Image = (new FileUpload($_FILES['image']))->upload()->getFileName();
            if($category->save())
            {
                $this->redirect('/productcategories');
            }
        }

        $this->_view();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = UserGroupModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');

        $this->_data['group'] = $category;
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $extractedPrivilegesIds = $this->_data['groupPrivileges'] = UserGroupPrivilegeModel::getGroupPrivileges($category);

        if(isset($_POST['submit'])) {
            $category->GroupName = $this->filterString($_POST['GroupName']);
            if($category->save())
            {
                if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {

                    $privilegesIdsToBeDeleted = array_diff($extractedPrivilegesIds, $_POST['privileges']);
                    $privilegesIdsToBeAdded = array_diff($_POST['privileges'], $extractedPrivilegesIds);
                    
                    // Delete the unwanted privileges
                    foreach ($privilegesIdsToBeDeleted as $deletedPrivilege) {
                        $unwantedPrivilege = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $deletedPrivilege, 'GroupId' => $category->GroupId]);
                        $unwantedPrivilege->current()->delete();
                    }

                    // Add the new privileges
                    foreach ($privilegesIdsToBeAdded as $privilegeId) {
                        $categoryPrivilege = new UserGroupPrivilegeModel();
                        $categoryPrivilege->GroupId = $category->GroupId;
                        $categoryPrivilege->PrivilegeId = $privilegeId;
                        $categoryPrivilege->save();
                    }
                }
                $this->redirect('/productcategories');
            }
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = UserGroupModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $categoryPrivileges = UserGroupPrivilegeModel::getBy(['GroupId' => $category->GroupId]);

        if(false !== $categoryPrivileges) {
            foreach ($categoryPrivileges as $categoryPrivilege) {
                $categoryPrivilege->delete();
            }
        }

        if($category->delete()) {
            $this->redirect('/productcategories');
        }
    }
}