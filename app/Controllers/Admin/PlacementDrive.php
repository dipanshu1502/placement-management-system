<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PlacementDriveModel;
use App\Models\CompanyModel;
use App\Models\NotificationModel;
use App\Models\StudentModel;

class PlacementDrive extends BaseController
{
    protected $driveModel;
    protected $companyModel;

    public function __construct()
    {
        $this->driveModel = new PlacementDriveModel();
        $this->companyModel = new CompanyModel();
    }

    public function index()
    {
        $drives = $this->driveModel
            ->select('placement_drives.*, companies.company_name')
            ->join('companies', 'companies.id = placement_drives.company_id')
            ->orderBy('placement_drives.id', 'DESC')
            ->findAll();

        return view('admin/drives/index', [
            'drives' => $drives
        ]);
    }

    public function create()
    {
        return view('admin/drives/create', [
            'companies' => $this->companyModel->findAll()
        ]);
    }

    public function store()
    {
        $companyId = $this->request->getPost('company_id');
        $jobRole   = $this->request->getPost('job_role');

        $this->driveModel->insert([
            'company_id'  => $companyId,
            'job_role'    => $jobRole,
            'min_cgpa'    => $this->request->getPost('min_cgpa'),
            'package_lpa' => $this->request->getPost('package_lpa'),
            'last_date'   => $this->request->getPost('last_date')
        ]);

        // Company Details
        $company = $this->companyModel->find($companyId);

        // Models
        $studentModel = new StudentModel();
        $notificationModel = new NotificationModel();

        // All Students
        $students = $studentModel->findAll();

        // Notification to All Students
        foreach ($students as $student) {

            $notificationModel->insert([
                'student_id' => $student['id'],
                'title'      => 'New Placement Drive',
                'message'    => $company['company_name'] .
                    ' has opened applications for ' .
                    $jobRole . '.',
                'is_read'    => 0
            ]);
        }

        return redirect()
            ->to('/admin/drives')
            ->with(
                'success',
                'Placement Drive Created Successfully'
            );
    }

    public function exportApplicants($driveId)
    {
        $applications = (new \App\Models\ApplicationModel())
            ->select('
    users.name,
    users.email,
    students.roll_no,
    students.phone,
    students.cgpa,
    students.passing_year,
    departments.department_name,
    applications.status,
    placement_drives.job_role,
    companies.company_name,
    resumes.resume_file
')
            ->join('students', 'students.id = applications.student_id')
            ->join('users', 'users.id = students.user_id')
            ->join('departments', 'departments.id = students.department_id', 'left')
            ->join('placement_drives', 'placement_drives.id = applications.drive_id')
            ->join('companies', 'companies.id = placement_drives.company_id')
            ->join(
                'resumes',
                'resumes.student_id = students.id',
                'left'
            )
            ->where('applications.drive_id', $driveId)
            ->findAll();

        if (empty($applications)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'No applicants found for this drive.'
                );
        }

        $companyName = preg_replace(
            '/[^A-Za-z0-9]/',
            '_',
            $applications[0]['company_name']
        );

        $filename = $companyName . '_Applicants.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Name',
            'Email',
            'Roll No',
            'Department',
            'Phone',
            'CGPA',
            'Passing Year',
            'Company',
            'Job Role',
            'Status',
            'Resume Link'
        ]);

        foreach ($applications as $row) {

            fputcsv($file, [
                $row['name'],
                $row['email'],
                $row['roll_no'],
                $row['department_name'],
                $row['phone'],
                $row['cgpa'],
                $row['passing_year'],
                $row['company_name'],
                $row['job_role'],
                $row['status'],
                !empty($row['resume_file'])
                    ? base_url('uploads/resumes/' . $row['resume_file'])
                    : 'No Resume'
            ]);
        }

        fclose($file);
        exit;
    }

    public function delete($id)
    {
        $this->driveModel->delete($id);

        return redirect()
            ->to('/admin/drives')
            ->with(
                'success',
                'Placement Drive Deleted Successfully'
            );
    }
}
