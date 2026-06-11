<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\NotificationModel;
use App\Models\CompanyModel;

class Application extends BaseController
{
    protected $applicationModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
    }

    public function index()
    {
        $status      = $this->request->getGet('status');
        $companyId   = $this->request->getGet('company');
        $studentName = $this->request->getGet('student_name');

        $companyModel = new CompanyModel();

        $builder = $this->applicationModel
            ->select('
                applications.*,
                users.name,
                placement_drives.job_role,
                companies.company_name,
                resumes.resume_file
            ')
            ->join(
                'students',
                'students.id = applications.student_id'
            )
            ->join(
                'users',
                'users.id = students.user_id'
            )
            ->join(
                'placement_drives',
                'placement_drives.id = applications.drive_id'
            )
            ->join(
                'companies',
                'companies.id = placement_drives.company_id'
            )
            ->join(
                'resumes',
                'resumes.student_id = students.id',
                'left'
            );

        if (!empty($status)) {
            $builder->where(
                'applications.status',
                $status
            );
        }

        if (!empty($companyId)) {
            $builder->where(
                'companies.id',
                $companyId
            );
        }

        if (!empty($studentName)) {
            $builder->like(
                'users.name',
                $studentName
            );
        }

        $applications = $builder
            ->orderBy('applications.id', 'DESC')
            ->findAll();

        return view(
            'admin/applications/index',
            [
                'applications'    => $applications,
                'currentStatus'   => $status,
                'currentCompany'  => $companyId,
                'currentStudent'  => $studentName,
                'companies'       => $companyModel->findAll()
            ]
        );
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        $this->applicationModel->update($id, [
            'status' => $status
        ]);

        $application = $this->applicationModel
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
            ->where('applications.id', $id)
            ->first();

        if ($application) {

            $notificationModel = new NotificationModel();

            if ($status == 'Selected') {

                $notificationModel->insert([
                    'student_id' => $application['student_id'],
                    'title'      => 'Congratulations!',
                    'message'    => 'You have been selected for ' .
                        $application['job_role'] .
                        ' at ' .
                        $application['company_name'] . '.',
                    'is_read'    => 0
                ]);

            } elseif ($status == 'Rejected') {

                $notificationModel->insert([
                    'student_id' => $application['student_id'],
                    'title'      => 'Application Update',
                    'message'    => 'Your application for ' .
                        $application['job_role'] .
                        ' at ' .
                        $application['company_name'] .
                        ' has been rejected.',
                    'is_read'    => 0
                ]);
            }
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Application Status Updated'
            );
    }
}