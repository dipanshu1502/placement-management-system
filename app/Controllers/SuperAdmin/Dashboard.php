<?php

namespace App\Controllers\SuperAdmin;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\CompanyModel;
use App\Models\PlacementDriveModel;
use App\Models\ActivityLogModel;

class Dashboard extends BaseSuperAdminController
{
    public function index()
    {
        $userModel = new UserModel();
        $departmentModel = new DepartmentModel();
        $companyModel = new CompanyModel();
        $driveModel = new PlacementDriveModel();
        $activityModel = new ActivityLogModel();

        $data = [];

        // Students
        $data['students'] = $userModel
            ->where('role', 'student')
            ->countAllResults();

        // Total Admins
        $data['admins'] = $userModel
            ->where('role', 'admin')
            ->countAllResults();

        // Active Admins
        $data['activeAdmins'] = $userModel
            ->where('role', 'admin')
            ->where('status', 'active')
            ->countAllResults();

        // Inactive Admins
        $data['inactiveAdmins'] = $userModel
            ->where('role', 'admin')
            ->where('status', 'inactive')
            ->countAllResults();

        // Departments
        $data['departments'] = $departmentModel->countAll();

        // Companies
        $data['companies'] = $companyModel->countAll();

        // Placement Drives
        $data['drives'] = $driveModel->countAll();

        // Recent Admins
        $data['recentAdmins'] = $userModel
            ->where('role', 'admin')
            ->orderBy('id', 'DESC')
            ->findAll(5);

        // Recent Activities
        $data['recentActivities'] = $activityModel
            ->select('
                activity_logs.*,
                users.name
            ')
            ->join(
                'users',
                'users.id = activity_logs.user_id'
            )
            ->orderBy('activity_logs.id', 'DESC')
            ->findAll(5);

        // Total Activity Logs
        $data['totalLogs'] = $activityModel->countAll();

        // Today's Activities
        $data['todayLogs'] = $activityModel
            ->where('DATE(created_at)', date('Y-m-d'))
            ->countAllResults();

        return view('super_admin/dashboard/index', $data);
    }
}