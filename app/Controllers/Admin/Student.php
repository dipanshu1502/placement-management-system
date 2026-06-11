<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class Student extends BaseController
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    // Student List
    public function index()
    {
        $students = $this->studentModel
            ->select('
                students.*,
                users.name,
                users.email,
                departments.department_name
            ')
            ->join('users', 'users.id = students.user_id')
            ->join('departments', 'departments.id = students.department_id')
            ->orderBy('students.id', 'DESC')
            ->findAll();

        return view('admin/students/index', [
            'students' => $students
        ]);
    }

    // View Student Profile
   public function view($id)
{
    $student = $this->studentModel
        ->select('
            students.*,
            users.name,
            users.email,
            departments.department_name
        ')
        ->join('users', 'users.id = students.user_id')
        ->join('departments', 'departments.id = students.department_id')
        ->where('students.id', $id)
        ->first();

    if (!$student) {
        return redirect()->to('/admin/students');
    }

    return view('admin/students/view', [
        'student' => $student
    ]);
}
}