<?php

namespace App\Models;

use CodeIgniter\Model;

class RemovedStudentModel extends Model
{
    protected $table = 'removed_students';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'removed_by',
        'removed_at',
        'restore_at',
        'status',
        'reason'
    ];
}