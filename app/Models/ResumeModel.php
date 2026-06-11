<?php

namespace App\Models;

use CodeIgniter\Model;

class ResumeModel extends Model
{
    protected $table = 'resumes';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'resume_file',
        'uploaded_at'
    ];
}