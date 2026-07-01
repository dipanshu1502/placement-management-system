<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;

class Department extends BaseController
{
    protected $departmentModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
    }

    // Department List
    public function index()
    {
        $data['departments'] = $this->departmentModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('admin/departments/index', $data);
    }

    // Add Department Form
    public function create()
    {
        return view('admin/departments/create');
    }

    // Save Department
    public function store()
    {
        $rules = [

            'department_name' => [
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Department Name is required'
                ]
            ],

            'department_code' => [
                'rules' => 'required|min_length[2]|max_length[20]|is_unique[departments.department_code]',
                'errors' => [
                    'required' => 'Department Code is required',
                    'is_unique' => 'Department Code already exists'
                ]
            ]
        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentName = $this->request->getPost('department_name');

        $this->departmentModel->save([

            'department_name' => $departmentName,

            'department_code' => strtoupper(
                $this->request->getPost('department_code')
            )

        ]);

        // Activity Log
        $this->logActivity(
            'Created',
            'Department',
            'Added Department "' . $departmentName . '"'
        );

        return redirect()->to('/admin/departments')
            ->with('success', 'Department Added Successfully');
    }

    // Edit Department Form
    public function edit($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['department'] = $department;

        return view('admin/departments/edit', $data);
    }

    // Update Department
    public function update($id)
    {
        $department = $this->departmentModel->find($id);

        if (!$department) {

            return redirect()->to('/admin/departments');
        }

        $rules = [

            'department_name' => 'required|min_length[2]|max_length[100]',

            'department_code' => 'required|min_length[2]|max_length[20]'

        ];

        if (!$this->validate($rules)) {

            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentName = $this->request->getPost('department_name');

        $this->departmentModel->update($id, [

            'department_name' => $departmentName,

            'department_code' => strtoupper(
                $this->request->getPost('department_code')
            )

        ]);

        // Activity Log
        $this->logActivity(
            'Updated',
            'Department',
            'Updated Department "' . $departmentName . '"'
        );

        return redirect()->to('/admin/departments')
            ->with('success', 'Department Updated Successfully');
    }

    // Delete Department
    public function delete($id)
    {
        $department = $this->departmentModel->find($id);

        if ($department) {

            // Activity Log
            $this->logActivity(
                'Deleted',
                'Department',
                'Deleted Department "' . $department['department_name'] . '"'
            );

            $this->departmentModel->delete($id);
        }

        return redirect()->to('/admin/departments')
            ->with('success', 'Department Deleted Successfully');
    }
}