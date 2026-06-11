<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\DepartmentModel;

class Profile extends BaseController
{
    protected $studentModel;
    protected $departmentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->departmentModel = new DepartmentModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        $data['student'] = $this->studentModel
            ->where('user_id', $userId)
            ->first();

        $data['departments'] = $this->departmentModel->findAll();

        return view('student/profile', $data);
    }

    public function save()
    {
        $userId = session()->get('id');

        $data = [
            'department_id' => $this->request->getPost('department_id'),
            'roll_no'       => $this->request->getPost('roll_no'),
            'phone'         => $this->request->getPost('phone'),
            'cgpa'          => $this->request->getPost('cgpa'),
            'backlogs'      => $this->request->getPost('backlogs'),
            'passing_year'  => $this->request->getPost('passing_year')
        ];

        $existing = $this->studentModel
            ->where('user_id', $userId)
            ->first();

        if ($existing) {

            $this->studentModel->update(
                $existing['id'],
                $data
            );

        } else {

            $data['user_id'] = $userId;

            $this->studentModel->insert($data);
        }

        return redirect()
            ->to('/student/profile')
            ->with('success', 'Profile Updated Successfully');
    }
}