<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\EmployeeModel;

class EmployeeController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('employee.default');
        $this->_data['employees'] = EmployeeModel::getAll();
        $this->_view();
    }

    public function addAction()
    {
        $this->_language->load('template.common');
        $this->_language->load('employee.labels');
        $this->_language->load('employee.add');

        if(isset($_POST['submit'])) {
            $emp = new EmployeeModel;
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterFloat($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            $emp->gender = $this->filterInt($_POST['gender']);
            $emp->theType = $this->filterInt($_POST['type']);
            $emp->os = serialize($_POST['os']);
            $emp->notes = $this->filterString($_POST['notes']);
            if($emp->save()) {
                $_SESSION['message'] = 'تم حفظ الموظف بنجاح';
                $this->redirect('/employee');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);

        $emp = EmployeeModel::getByPK($id);
        if($emp === false) {
            $this->redirect('/employee');
        }

        $this->_language->load('template.common');
        $this->_language->load('employee.labels');
        $this->_language->load('employee.edit');

        $emp->os = unserialize($emp->os);
        $this->_data['employee'] = $emp;

        if(isset($_POST['submit'])) {
            $emp->name = $this->filterString($_POST['name']);
            $emp->age = $this->filterInt($_POST['age']);
            $emp->address = $this->filterString($_POST['address']);
            $emp->salary = $this->filterFloat($_POST['salary']);
            $emp->tax = $this->filterFloat($_POST['tax']);
            $emp->gender = $this->filterInt($_POST['gender']);
            $emp->type = $this->filterInt($_POST['type']);
            $emp->os = serialize($_POST['os']);
            $emp->notes = $this->filterString($_POST['notes']);
            if($emp->save()) {
                $_SESSION['message'] = 'تم حفظ الموظف بنجاح';
                $this->redirect('/employee');
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);

        $emp = EmployeeModel::getByPK($id);
        if($emp === false) {
            $this->redirect('/employee');
        }

        if($emp->delete()) {
            $_SESSION['message'] = 'Employee, deleted successfully';
            $this->redirect('/employee');
        }
    }
}