<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\PlacementDriveModel;
use App\Models\ApplicationModel;
use App\Models\StudentModel;
use App\Models\ResumeModel;
use App\Models\NotificationModel;

class Drive extends BaseController
{
    protected $driveModel;
    protected $applicationModel;
    protected $studentModel;

    public function __construct()
    {
        $this->driveModel = new PlacementDriveModel();
        $this->applicationModel = new ApplicationModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        $student = $this->studentModel
            ->where('user_id', $userId)
            ->first();

        $drives = $this->driveModel
            ->select('placement_drives.*, companies.company_name')
            ->join('companies', 'companies.id = placement_drives.company_id')
            ->orderBy('placement_drives.id', 'DESC')
            ->findAll();

        $appliedDrives = [];

        if ($student) {

            $applications = $this->applicationModel
                ->where('student_id', $student['id'])
                ->findAll();

            $appliedDrives = array_column(
                $applications,
                'drive_id'
            );
        }

        return view('student/drives/index', [

            'drives' => $drives,

            'studentCgpa' => $student['cgpa'] ?? 0,

            'appliedDrives' => $appliedDrives

        ]);
    }

    public function apply($driveId)
    {
        $userId = session()->get('id');

        $student = $this->studentModel
            ->where('user_id', $userId)
            ->first();

        // Profile Check
        if (!$student) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Please complete your profile first.'
                );
        }

        // Resume Check
        $resumeModel = new ResumeModel();

        $resume = $resumeModel
            ->where('student_id', $student['id'])
            ->first();

        if (!$resume) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Please upload your resume before applying.'
                );
        }

        // Drive Fetch
        $drive = $this->driveModel->find($driveId);

        if (!$drive) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Drive not found.'
                );
        }

        // Last Date Check
        if (strtotime(date('Y-m-d')) > strtotime($drive['last_date'])) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'This drive is closed.'
                );
        }

        // CGPA Eligibility Check
        if ($student['cgpa'] < $drive['min_cgpa']) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Not Eligible. Minimum CGPA Required: ' .
                    $drive['min_cgpa']
                );
        }

        // Already Applied Check
        $alreadyApplied = $this->applicationModel
            ->where('student_id', $student['id'])
            ->where('drive_id', $driveId)
            ->first();

        if ($alreadyApplied) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'You have already applied.'
                );
        }

        // Apply
        $this->applicationModel->insert([
            'student_id' => $student['id'],
            'drive_id'   => $driveId,
            'status'     => 'Applied'
        ]);

        // Notification Create
        $notificationModel = new NotificationModel();

        $company = $this->driveModel
            ->select('placement_drives.job_role, companies.company_name')
            ->join(
                'companies',
                'companies.id = placement_drives.company_id'
            )
            ->find($driveId);

        $notificationModel->insert([
            'student_id' => $student['id'],
            'title'      => 'Application Submitted',
            'message'    => 'You have successfully applied for ' .
                $company['job_role'] .
                ' at ' .
                $company['company_name'] . '.',
            'is_read'    => 0
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Applied Successfully'
            );
    }
}