<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\StudentModel;
use App\Models\PlacementDriveModel;
use App\Models\ApplicationModel;
use App\Models\ResumeModel;
use App\Models\NotificationModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');

        $userModel = new UserModel();
        $studentModel = new StudentModel();
        $driveModel = new PlacementDriveModel();
        $applicationModel = new ApplicationModel();
        $resumeModel = new ResumeModel();
        $notificationModel = new NotificationModel();

        $user = $userModel->find($userId);

        $student = $studentModel
            ->where('user_id', $userId)
            ->first();

        $availableDrives = $driveModel
            ->where('last_date >=', date('Y-m-d'))
            ->countAllResults();

        $appliedDrives = 0;
        $selectedApplications = 0;
        $profileCompletion = 0;
        $notifications = [];

        if ($student) {

            $appliedDrives = $applicationModel
                ->where('student_id', $student['id'])
                ->countAllResults();

            $selectedApplications = $applicationModel
                ->where('student_id', $student['id'])
                ->where('status', 'Selected')
                ->countAllResults();

            // Profile Completion
            $completedFields = 0;
            $totalFields = 7;

            if (!empty($student['department_id'])) $completedFields++;
            if (!empty($student['roll_no'])) $completedFields++;
            if (!empty($student['phone'])) $completedFields++;
            if (!empty($student['cgpa'])) $completedFields++;
            if ($student['backlogs'] !== null && $student['backlogs'] !== '') $completedFields++;
            if (!empty($student['passing_year'])) $completedFields++;

            $resume = $resumeModel
                ->where('student_id', $student['id'])
                ->first();

            if ($resume) {
                $completedFields++;
            }

            $profileCompletion = round(
                ($completedFields / $totalFields) * 100
            );

            // Latest 5 Notifications
            $notifications = $notificationModel
                ->where('student_id', $student['id'])
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->findAll();
        }

        $data = [
            'user' => $user,
            'availableDrives' => $availableDrives,
            'appliedDrives' => $appliedDrives,
            'interviews' => $selectedApplications,
            'profileCompletion' => $profileCompletion,
            'notifications' => $notifications
        ];

        return view('student/dashboard', $data);
    }
}