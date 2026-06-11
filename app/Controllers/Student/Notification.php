<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\NotificationModel;
use App\Models\StudentModel;

class Notification extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');

        $studentModel = new StudentModel();
        $notificationModel = new NotificationModel();

        $student = $studentModel
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

        // Mark All Notifications as Read
        $notificationModel
            ->where('student_id', $student['id'])
            ->set([
                'is_read' => 1
            ])
            ->update();

        $notifications = $notificationModel
            ->where('student_id', $student['id'])
            ->orderBy('id', 'DESC')
            ->findAll();

        return view(
            'student/notifications/index',
            [
                'notifications' => $notifications
            ]
        );
    }
}