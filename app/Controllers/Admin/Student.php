<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\UserModel;
use App\Models\ApplicationModel;
use App\Models\ResumeModel;
use App\Models\NotificationModel;

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
        $status = $this->request->getGet('status') ?? 'all';
        $search = trim($this->request->getGet('search') ?? '');

        $db = \Config\Database::connect();

        $builder = $db->table('users');

        $builder->select('
        users.id as user_id,
        users.name,
        users.email,

        students.id as student_id,
        students.roll_no,
        students.cgpa,
        students.passing_year,

        departments.department_name
    ');

        $builder->join(
            'students',
            'students.user_id = users.id',
            'left'
        );

        $builder->join(
            'departments',
            'departments.id = students.department_id',
            'left'
        );

        $builder->where('users.role', 'student');

        // Name Search
        if (!empty($search)) {
            $builder->like('users.name', $search);
        }

        // Status Filter
        if ($status === 'complete') {
            $builder->where('students.id IS NOT NULL', null, false);
        }

        if ($status === 'incomplete') {
            $builder->where('students.id IS NULL', null, false);
        }

        $builder->orderBy('users.id', 'DESC');

        $students = $builder->get()->getResultArray();

        return view('admin/students/index', [
            'students' => $students,
            'status'   => $status,
            'search'   => $search
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

    // Delete Student
    public function delete($id)
    {
        $userModel         = new UserModel();
        $applicationModel  = new ApplicationModel();
        $resumeModel       = new ResumeModel();
        $notificationModel = new NotificationModel();

        $db = \Config\Database::connect();

        // Check if ID belongs to a student profile
        $student = $this->studentModel
            ->where('id', $id)
            ->first();

        $db->transStart();

        if ($student) {

            // Resume Delete
            $resume = $resumeModel
                ->where('student_id', $student['id'])
                ->first();

            if ($resume) {

                $filePath = FCPATH . 'uploads/resumes/' . $resume['resume_file'];

                if (!empty($resume['resume_file']) && file_exists($filePath)) {
                    unlink($filePath);
                }

                $resumeModel
                    ->where('student_id', $student['id'])
                    ->delete();
            }

            // Applications Delete
            $applicationModel
                ->where('student_id', $student['id'])
                ->delete();

            // Notifications Delete
            $notificationModel
                ->where('student_id', $student['id'])
                ->delete();

            // Student Delete
            $this->studentModel->delete($student['id']);

            // User Delete
            $userModel->delete($student['user_id']);
        } else {

            // Incomplete Profile User
            $user = $userModel->find($id);

            if (!$user) {
                return redirect()->to('/admin/students')
                    ->with('error', 'User not found.');
            }

            $userModel->delete($id);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/admin/students')
                ->with('error', 'Failed to delete account.');
        }

        return redirect()->to('/admin/students')
            ->with('success', 'Account deleted successfully.');
    }
}
