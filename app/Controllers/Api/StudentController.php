<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function profile($userId)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students s')
            ->select('
                u.name,
                u.email,
                u.role,
                d.department_name,
                d.department_code,
                s.roll_no,
                s.phone,
                s.cgpa,
                s.backlogs,
                s.passing_year
            ')
            ->join('users u', 'u.id = s.user_id')
            ->join('departments d', 'd.id = s.department_id')
            ->where('s.user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$student) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Student not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $student
        ]);
    }

    public function updateProfile()
    {
        $studentModel = new StudentModel();

        $userId = $this->request->getPost('user_id');

        if (empty($userId)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User ID is required'
            ]);
        }

        $data = [
            'phone'        => $this->request->getPost('phone'),
            'cgpa'         => $this->request->getPost('cgpa'),
            'backlogs'     => $this->request->getPost('backlogs'),
            'passing_year' => $this->request->getPost('passing_year')
        ];

        $studentModel
            ->where('user_id', $userId)
            ->set($data)
            ->update();

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Profile updated successfully'
        ]);
    }
}