<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;

class ApplicationController extends BaseController
{
    public function apply()
    {
        $applicationModel = new ApplicationModel();

        $studentId = $this->request->getVar('student_id');
        $driveId = $this->request->getVar('drive_id');

        $alreadyApplied = $applicationModel
            ->where('student_id', $studentId)
            ->where('drive_id', $driveId)
            ->first();

        if ($alreadyApplied) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Already applied'
            ]);
        }

        $applicationModel->insert([
            'student_id' => $studentId,
            'drive_id'   => $driveId,
            'status'     => 'Applied'
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Application submitted successfully'
        ]);
    }
    public function myApplications($studentId)
{
    $db = \Config\Database::connect();

    $applications = $db->table('applications a')
        ->select('
            a.id,
            c.company_name,
            pd.job_role,
            pd.package_lpa,
            a.status,
            a.applied_at
        ')
        ->join('placement_drives pd', 'pd.id = a.drive_id')
        ->join('companies c', 'c.id = pd.company_id')
        ->where('a.student_id', $studentId)
        ->get()
        ->getResultArray();

    return $this->response->setJSON([
        'status' => true,
        'data' => $applications
    ]);
}
}