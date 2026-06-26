<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function stats($studentId)
    {
        $db = \Config\Database::connect();

        $today = date('Y-m-d');

        // Sirf Open Drives Count
        $totalDrives = $db->table('placement_drives')
            ->where('last_date >=', $today)
            ->countAllResults();

        $appliedDrives = $db->table('applications')
            ->where('student_id', $studentId)
            ->countAllResults();

        $selectedDrives = $db->table('applications')
            ->where('student_id', $studentId)
            ->where('status', 'Selected')
            ->countAllResults();

        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'total_drives' => $totalDrives,
                'applied_drives' => $appliedDrives,
                'selected_drives' => $selectedDrives
            ]
        ]);
    }
}