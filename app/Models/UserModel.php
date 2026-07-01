<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

    protected $useTimestamps = false;

    /*
    |--------------------------------------------------------------------------
    | Admin Management
    |--------------------------------------------------------------------------
    */

    public function getAdmins()
    {
        return $this
            ->where('role', 'admin')
            ->orderBy('id', 'DESC');
    }

    public function getAdminById($id)
    {
        return $this
            ->where('role', 'admin')
            ->find($id);
    }

    public function getActiveAdmins()
    {
        return $this
            ->where('role', 'admin')
            ->where('status', 'active')
            ->findAll();
    }

    public function getInactiveAdmins()
    {
        return $this
            ->where('role', 'admin')
            ->where('status', 'inactive')
            ->findAll();
    }

    public function isEmailExists($email, $ignoreId = null)
    {
        $builder = $this->builder();

        $builder->where('email', $email);

        if ($ignoreId !== null) {
            $builder->where('id !=', $ignoreId);
        }

        return $builder->get()->getRowArray();
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Counts
    |--------------------------------------------------------------------------
    */

    public function countStudents()
    {
        return $this
            ->where('role', 'student')
            ->countAllResults();
    }

    public function countAdmins()
    {
        return $this
            ->where('role', 'admin')
            ->countAllResults();
    }

    public function countSuperAdmins()
    {
        return $this
            ->where('role', 'super_admin')
            ->countAllResults();
    }
}