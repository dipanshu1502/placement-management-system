<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id',
        'drive_id',
        'status'
    ];

    protected $returnType = 'array';
}