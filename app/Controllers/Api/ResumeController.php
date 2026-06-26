<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ResumeModel;

class ResumeController extends BaseController
{
    public function upload()
    {
        $studentId = $this->request->getPost('student_id');

        if (!$studentId) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Student ID is required'
            ]);
        }

        $file = $this->request->getFile('resume');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Please select a resume file'
            ]);
        }

        $resumeModel = new ResumeModel();

        $existingResume = $resumeModel
            ->where('student_id', $studentId)
            ->first();

        $newFileName =
            time() . '_' . $file->getRandomName();

        $uploadPath =
            FCPATH . 'uploads/resumes';

        if (!is_dir($uploadPath)) {
            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        $file->move(
            $uploadPath,
            $newFileName
        );

        if ($existingResume) {

            $oldFile =
                $uploadPath . '/' .
                $existingResume['resume_file'];

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            $resumeModel->update(
                $existingResume['id'],
                [
                    'resume_file' =>
                        $newFileName
                ]
            );
        } else {

            $resumeModel->insert([
                'student_id' =>
                    $studentId,
                'resume_file' =>
                    $newFileName
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' =>
                'Resume uploaded successfully',
            'file' => $newFileName
        ]);
    }

    public function getResume($studentId)
    {
        $resumeModel = new ResumeModel();

        $resume = $resumeModel
            ->where('student_id', $studentId)
            ->first();

        if (!$resume) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Resume not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'file' =>
                $resume['resume_file'],
            'url' =>
                base_url(
                    'uploads/resumes/' .
                    $resume['resume_file']
                )
        ]);

    }
}