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

    // Sirf Active Students
    $builder->where('users.role', 'student');
    $builder->where('users.status', 'active');

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
    // public function delete($id)
    // {
    //     $userModel         = new UserModel();
    //     $applicationModel  = new ApplicationModel();
    //     $resumeModel       = new ResumeModel();
    //     $notificationModel = new NotificationModel();

    //     $db = \Config\Database::connect();

    //     // Check if ID belongs to a student profile
    //     $student = $this->studentModel
    //         ->where('id', $id)
    //         ->first();

    //     $db->transStart();

    //     if ($student) {

    //         // Resume Delete
    //         $resume = $resumeModel
    //             ->where('student_id', $student['id'])
    //             ->first();

    //         if ($resume) {

    //             $filePath = FCPATH . 'uploads/resumes/' . $resume['resume_file'];

    //             if (!empty($resume['resume_file']) && file_exists($filePath)) {
    //                 unlink($filePath);
    //             }

    //             $resumeModel
    //                 ->where('student_id', $student['id'])
    //                 ->delete();
    //         }

    //         // Applications Delete
    //         $applicationModel
    //             ->where('student_id', $student['id'])
    //             ->delete();

    //         // Notifications Delete
    //         $notificationModel
    //             ->where('student_id', $student['id'])
    //             ->delete();

    //         // Student Delete
    //         $this->studentModel->delete($student['id']);

    //         // User Delete
    //         $userModel->delete($student['user_id']);
    //     } else {

    //         // Incomplete Profile User
    //         $user = $userModel->find($id);

    //         if (!$user) {
    //             return redirect()->to('/admin/students')
    //                 ->with('error', 'User not found.');
    //         }

    //         $userModel->delete($id);
    //     }

    //     $db->transComplete();

    //     if ($db->transStatus() === false) {
    //         return redirect()->to('/admin/students')
    //             ->with('error', 'Failed to delete account.');
    //     }

    //     return redirect()->to('/admin/students')
    //         ->with('success', 'Account deleted successfully.');
    // }

    // Remove Student
public function delete($id)
{
    $userModel = new UserModel();

    $db = \Config\Database::connect();

    // Check if ID belongs to complete profile
    $student = $this->studentModel
        ->where('id', $id)
        ->first();

    $db->transStart();

    if ($student) {

        // User Inactive
        $userModel->update($student['user_id'], [
            'status' => 'inactive'
        ]);

        // Save Remove History
        $this->removedStudentModel->insert([
            'user_id'    => $student['user_id'],
            'removed_by' => session()->get('id'),
            'status'     => 'removed'
        ]);

    } else {

        // Incomplete Profile User
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

    return redirect()->to('/admin/removed-students')
        ->with('success', 'Student restored successfully.');
}

}
