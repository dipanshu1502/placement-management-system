<?php

namespace App\Models;

use CodeIgniter\Model;

class PlacementDriveModel extends Model
{
    protected $table = 'placement_drives';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company_id',
        'job_role',
        'min_cgpa',
        'package_lpa',
        'last_date',
        'status'
    ];

    protected $returnType = 'array';
}