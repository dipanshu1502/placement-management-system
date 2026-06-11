<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use App\Models\ResumeModel;
use App\Models\StudentModel;

class Resume extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');

        $studentModel = new StudentModel();
        $resumeModel  = new ResumeModel();

        $student = $studentModel
            ->where('user_id', $userId)
            ->first();

        if (!$student) {
            return redirect()->to('/student/profile')
                ->with('error', 'Please complete your profile first.');
        }

        $resume = $resumeModel
            ->where('student_id', $student['id'])
            ->first();

        return view('student/resume/index', [
            'resume' => $resume
        ]);
    }
    public function upload()
{
    $userId = session()->get('id');

    $studentModel = new StudentModel();
    $resumeModel  = new ResumeModel();

    $student = $studentModel
        ->where('user_id', $userId)
        ->first();

    if (!$student) {
        return redirect()->back()
            ->with('error', 'Please complete your profile first.');
    }

    $file = $this->request->getFile('resume');

    if (!$file->isValid()) {
        return redirect()->back()
            ->with('error', 'Please select a valid file.');
    }

    $allowed = ['pdf', 'doc', 'docx'];

    if (!in_array(strtolower($file->getExtension()), $allowed)) {
        return redirect()->back()
            ->with('error', 'Only PDF, DOC and DOCX files are allowed.');
    }

    $newName = time() . '_' . $file->getRandomName();

    $file->move(FCPATH . 'uploads/resumes', $newName);

    $existingResume = $resumeModel
        ->where('student_id', $student['id'])
        ->first();

    if ($existingResume) {

        $oldFile = FCPATH . 'uploads/resumes/' . $existingResume['resume_file'];

        if (file_exists($oldFile)) {
            unlink($oldFile);
        }

        $resumeModel->update($existingResume['id'], [
            'resume_file' => $newName
        ]);

    } else {

        $resumeModel->insert([
            'student_id' => $student['id'],
            'resume_file' => $newName
        ]);
    }

    return redirect()->to('/student/resume')
        ->with('success', 'Resume uploaded successfully.');
}
}