<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\DepartmentModel;
use App\Models\CompanyModel;
use App\Models\PlacementDriveModel;
use App\Models\UserModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $studentModel = new StudentModel();
        $departmentModel = new DepartmentModel();
        $companyModel = new CompanyModel();
        $driveModel = new PlacementDriveModel();
        $userModel = new UserModel();

        $data['students'] = $studentModel->countAll();
        $data['departments'] = $departmentModel->countAll();
        $data['companies'] = $companyModel->countAll();
        $data['drives'] = $driveModel->countAll();
        $data['students'] = $userModel
            ->where('role', 'student')
            ->countAllResults();


        return view('admin/dashboard', $data);
    }
}
