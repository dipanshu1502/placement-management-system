<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\UserModel;
use App\Models\ApplicationModel;
use App\Models\ResumeModel;
use App\Models\NotificationModel;
use App\Models\RemovedStudentModel;

class Student extends BaseController
{
    protected $studentModel;
    protected $removedStudentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->removedStudentModel = new RemovedStudentModel();
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
        $builder->where('users.status', 'active');

        if (!empty($search)) {
            $builder->like('users.name', $search);
        }

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

    // Remove Student
    public function delete($id)
    {
        $userModel = new UserModel();

        $db = \Config\Database::connect();

        $student = $this->studentModel
            ->where('id', $id)
            ->first();

        $db->transStart();

        if ($student) {

            $userModel->update($student['user_id'], [
                'status' => 'inactive'
            ]);

            $this->removedStudentModel->insert([
                'user_id'    => $student['user_id'],
                'removed_by' => session()->get('id'),
                'status'     => 'removed'
            ]);

        } else {

            $user = $userModel->find($id);

            if (!$user) {
                return redirect()->to('/admin/students')
                    ->with('error', 'User not found.');
            }

            $userModel->update($id, [
                'status' => 'inactive'
            ]);

            $this->removedStudentModel->insert([
                'user_id'    => $id,
                'removed_by' => session()->get('id'),
                'status'     => 'removed'
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->to('/admin/students')
                ->with('error', 'Failed to remove student.');
        }

        // Activity Log
        $user = $userModel->find($student ? $student['user_id'] : $id);

        if ($user) {
            $this->logActivity(
                'Removed',
                'Student',
                'Removed student "' . $user['name'] . '"'
            );
        }

        return redirect()->to('/admin/students')
            ->with('success', 'Student removed successfully.');
    }
        // Removed Students List
    public function removedStudents()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('removed_students');

        $builder->select('
            removed_students.*,
            users.name,
            users.email,
            students.roll_no,
            departments.department_name,
            admin.name AS removed_by_name
        ');

        $builder->join('users', 'users.id = removed_students.user_id');
        $builder->join('students', 'students.user_id = users.id', 'left');
        $builder->join('departments', 'departments.id = students.department_id', 'left');
        $builder->join('users admin', 'admin.id = removed_students.removed_by', 'left');

        $builder->where('removed_students.status', 'removed');
        $builder->orderBy('removed_students.removed_at', 'DESC');

        $students = $builder->get()->getResultArray();

        return view('admin/students/removed_students', [
            'students' => $students
        ]);
    }

    // Restore Student
    public function restoreStudent($id)
    {
        $userModel = new UserModel();

        $removedStudent = $this->removedStudentModel
            ->where('user_id', $id)
            ->where('status', 'removed')
            ->first();

        if (!$removedStudent) {

            return redirect()->back()
                ->with('error', 'Student not found.');
        }

        $userModel->update($id, [
            'status' => 'active'
        ]);

        $this->removedStudentModel->update($removedStudent['id'], [
            'status'     => 'restored',
            'restore_at' => date('Y-m-d H:i:s')
        ]);

        // Activity Log
        $user = $userModel->find($id);

        if ($user) {

            $this->logActivity(
                'Restored',
                'Student',
                'Restored student "' . $user['name'] . '"'
            );
        }

        return redirect()->to('/admin/removed-students')
            ->with('success', 'Student restored successfully.');
    }
}