<?php

use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $employees = $this->getEmployees();
        $allEmployees = $this->getAllEmployees();

        $currentPage = $this->request->getQuery('page', 'int', 1);
        
        $paginator   = new PaginatorArray(
            array(
                "data"  => $employees,
                "limit" => 10,
                "page"  => $currentPage
            )
        );

        $page = $paginator->getPaginate();

       //$this->view->setVar('employees', $employees);
        $this->view->setVar('allEmployees', $allEmployees);
        $this->view->setVar('employees', $page);
    }

    public function getEmployees($parent = 0)
    {
        $level = 1;
        $employeesTree = array();
        $employees = Employees::find("parent = {$parent}");

        foreach ($employees as $employee) {
            $employeesTree[] = array(
                'id' => $employee->id,
                'firstname' => $employee->firstname,
                'lastname' => $employee->lastname,
                'childs' => $this->getChilds($employee->id, $level),
            );
        }

        return $employeesTree;
    }

    public function getChilds($parent, $level)
    {
        $employeesTree = array();
        $employees = Employees::find("parent = {$parent}");

        foreach ($employees as $employee) {
            $employeesTree[] = array(
                'id' => $employee->id,
                'firstname' => $employee->firstname,
                'lastname' => $employee->lastname,
                'childs' => $this->getChilds($employee->id, $level++),
            );
        }

        return $employeesTree;
    }

    public function getAllEmployees($id = null)
    {
        $employeesTree = array();
        $level = 0;
        $childs = $id.$this->getChildsString($id, $level);
        $employees = Employees::find(
            array(
                "conditions" => ( ($id !== null) ? "id NOT IN({$childs})" : '' ),
                "order" => "id",
            )
        );

        foreach ($employees as $employee) {
            $employeesTree[] = array(
                'id' => $employee->id,
                'firstname' => $employee->firstname,
                'lastname' => $employee->lastname,
                'position' => $employee->position,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'notes' => $employee->notes,
                'parent' => $employee->parent,
            );
        }

        return $employeesTree;
    }

    public function addAction()
    {
        if (!$this->request->isPost()) {
            return $this->response->redirect('/');
        }

        $employee = new Employees();

  /*
        $employee->firstname = $this->request->getPost("firstname");
        $employee->lastname = $this->request->getPost("lastname");
        $employee->position = $this->request->getPost("position");
        $employee->email = $this->request->getPost("email");
        $employee->phone = $this->request->getPost("phone");
        $employee->notes = $this->request->getPost("notes");

        $data = $this->request->getPost();*/

        $success = $employee->save(
            $this->request->getPost(), array(
                'firstname',
                'lastname',
                'position',
                'phone',
                'notes',
                'email',
                'parent',
            )
        );

        if ($success) {
            return $this->response->redirect('/');
        } else {
            $this->view->pick("index/error");
            return $this->view->setVar('error', $employee->getMessages());
        }

        //$employee->save();
        //return $this->response->redirect('/');
    }

    public function editFormAction($id)
    {
        $this->view->pick("index/editForm");

        $allEmployees = $this->getAllEmployees($id);
        $employee = Employees::findFirst($id);
        
        $this->view->setVar('parent', $allEmployees);
        $this->view->setVar('employee', $employee);
        
    }

    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            return $this->response->redirect('/');
        }

        $employee = new Employees();

        $success = $employee->save(
            $this->request->getPost(), array(
                'id',
                'firstname',
                'lastname',
                'position',
                'phone',
                'notes',
                'email',
                'parent',
            )
        );

        if ($success) {
            return $this->response->redirect('/');
        } else {
            $this->view->pick("index/error");
            return $this->view->setVar('error', $employee->getMessages());
        }
    }

    public function deleteAction($id)
    {
        foreach ($this->getEmployeeForDelete($id) as $employeeId) {
            $employee = Employees::findFirst($employeeId);
            $employee->delete();
        }
        //$employee = Employees::findFirst($id);
        //$employee->delete();

        return $this->response->redirect('/');
    }

    public function getEmployeeForDelete($id)
    {
        $level = 1;
        $employeesTree = null;
        $employees = Employees::find("id = {$id}");

        foreach ($employees as $employee) {
            $employeesTree .= $employee->id;
            $employeesTree .= $this->getChildsString($id, $level);
        }

        return explode(',', $employeesTree);
    }

    public function getChildsString($parent, $level)
    {
        if ($parent === null) return false;

        $employeesTree = null;
        $employees = Employees::find("parent = {$parent}");

        foreach ($employees as $employee) {
            $employeesTree .= ','.$employee->id;
            $employeesTree .= $this->getChildsString($employee->id, $level++);
        }

        return $employeesTree;
    }

}

