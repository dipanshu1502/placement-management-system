<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'department_id',
        'roll_no',
        'phone',
        'cgpa',
        'backlogs',
        'passing_year'
    ];

    protected $returnType = 'array';
}