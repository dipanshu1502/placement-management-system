<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company_name',
        'website',
        'package',
        'location'
    ];

    protected $returnType = 'array';
}