<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ResumeModel;

class Resume extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $resumes = $db->table('resumes r')
            ->select('r.*, u.name, s.roll_number, d.department_name')
            ->join('students s', 's.id = r.student_id')
            ->join('users u', 'u.id = s.user_id')
            ->join('departments d', 'd.id = s.department_id', 'left')
            ->get()
            ->getResultArray();

        return view('admin/resumes/index', [
            'resumes' => $resumes
        ]);
    }
}