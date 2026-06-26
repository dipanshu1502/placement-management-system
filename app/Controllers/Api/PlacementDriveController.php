<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class PlacementDriveController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $studentId = $this->request->getGet('student_id');

        $drives = $db->table('placement_drives pd')
            ->select('
                pd.id,
                c.company_name,
                pd.job_role,
                pd.min_cgpa,
                pd.package_lpa,
                pd.drive_date,
                pd.last_date,
                pd.status
            ')
            ->join('companies c', 'c.id = pd.company_id')
            ->get()
            ->getResultArray();

        $today = date('Y-m-d');

        foreach ($drives as &$drive) {

            // Auto Status Calculation
            if (
                !empty($drive['last_date']) &&
                $drive['last_date'] < $today
            ) {
                $drive['status'] = 'Closed';
            } else {
                $drive['status'] = 'Open';
            }

            $drive['is_applied'] = false;

            if (!empty($studentId)) {

                $application = $db->table('applications')
                    ->where('student_id', $studentId)
                    ->where('drive_id', $drive['id'])
                    ->get()
                    ->getRowArray();

                if ($application) {
                    $drive['is_applied'] = true;
                }
            }
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $drives
        ]);
    }

    public function show($id)
    {
        $db = \Config\Database::connect();

        $drive = $db->table('placement_drives pd')
            ->select('
                pd.id,
                c.company_name,
                c.website,
                c.location,
                pd.job_role,
                pd.min_cgpa,
                pd.package_lpa,
                pd.drive_date,
                pd.last_date,
                pd.status
            ')
            ->join('companies c', 'c.id = pd.company_id')
            ->where('pd.id', $id)
            ->get()
            ->getRowArray();

        if (!$drive) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Drive not found'
            ]);
        }

        $today = date('Y-m-d');

        if (
            !empty($drive['last_date']) &&
            $drive['last_date'] < $today
        ) {
            $drive['status'] = 'Closed';
        } else {
            $drive['status'] = 'Open';
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $drive
        ]);
    }
}