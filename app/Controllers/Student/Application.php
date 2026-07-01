<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\StudentModel;

class Application extends BaseController
{
    protected $applicationModel;
    protected $studentModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $userId = session()->get('id');

        $student = $this->studentModel
            ->where('user_id', $userId)
            ->first();

        if (!$student) {

            return redirect()
                ->to('/student/profile')
                ->with(
                    'error',
                    'Please complete your profile first.'
                );
        }

        $status = $this->request->getGet('status');

        $query = $this->applicationModel
            ->select('
                applications.*,
                placement_drives.job_role,
                companies.company_name
            ')
            ->join(
                'placement_drives',
                'placement_drives.id = applications.drive_id'
            )
            ->join(
                'companies',
                'companies.id = placement_drives.company_id'
            )
            ->where(
                'applications.student_id',
                $student['id']
            );

        // Only apply filter when status is passed
        if ($status && in_array($status, ['Applied', 'Selected', 'Rejected'])) {

            $query->where(
                'applications.status',
                $status
            );
        }

        $applications = $query
            ->orderBy(
                'applications.id',
                'DESC'
            )
            ->findAll();

        return view(
            'student/applications/index',
            [
                'applications' => $applications,
                'currentStatus' => $status
            ]
        );
    }
}