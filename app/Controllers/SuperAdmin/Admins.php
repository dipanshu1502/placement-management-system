<?php

namespace App\Controllers\SuperAdmin;

use App\Models\UserModel;

class Admins extends BaseSuperAdminController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /*
    |--------------------------------------------------------------------------
    | Admin List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $search = trim($this->request->getGet('search'));

        $builder = $this->userModel
            ->where('role', 'admin');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $data = [
            'title' => 'Admin Management',
            'search' => $search,
            'admins' => $builder
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'pager' => $this->userModel->pager
        ];

        return view(
            'super_admin/admins/index',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create Admin
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data['title'] = 'Add Admin';

        return view(
            'super_admin/admins/create',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store Admin
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[100]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]'
            ]
        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([

            'name' => trim($this->request->getPost('name')),

            'email' => trim($this->request->getPost('email')),

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),

            'role' => 'admin',

            'status' => $this->request->getPost('status')
        ]);

        return redirect()
            ->to('/super-admin/admins')
            ->with(
                'success',
                'Admin created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Admin
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['title'] = 'Edit Admin';

        $data['admin'] = $this->userModel
            ->getAdminById($id);

        if (!$data['admin']) {

            return redirect()
                ->to('/super-admin/admins')
                ->with(
                    'error',
                    'Admin not found.'
                );
        }

        return view(
            'super_admin/admins/edit',
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Admin
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $admin = $this->userModel->getAdminById($id);

        if (!$admin) {
            return redirect()
                ->to('/super-admin/admins')
                ->with('error', 'Admin not found.');
        }

        $email = trim($this->request->getPost('email'));

        // Check Duplicate Email
        $existingEmail = $this->userModel
            ->where('email', $email)
            ->where('id !=', $id)
            ->first();

        if ($existingEmail) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email already exists.');
        }

        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[100]'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ]
        ];

        // Password Validation (Only if entered)
        if (!empty($this->request->getPost('password'))) {

            $rules['password'] = [
                'label' => 'Password',
                'rules' => 'min_length[6]'
            ];

            $rules['confirm_password'] = [
                'label' => 'Confirm Password',
                'rules' => 'matches[password]'
            ];
        }

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => trim($this->request->getPost('name')),
            'email' => $email,
            'status' => $this->request->getPost('status')
        ];

        // Update Password If Provided
        if (!empty($this->request->getPost('password'))) {

            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        return redirect()
            ->to('/super-admin/admins')
            ->with('success', 'Admin updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Activate / Deactivate
    |--------------------------------------------------------------------------
    */

    public function toggleStatus($id)
{
    $admin = $this->userModel->getAdminById($id);

    if (!$admin) {

        return redirect()
            ->to('/super-admin/admins')
            ->with(
                'error',
                'Admin not found.'
            );
    }

    // Prevent changing Super Admin
    if ($admin['role'] !== 'admin') {

        return redirect()
            ->to('/super-admin/admins')
            ->with(
                'error',
                'Invalid operation.'
            );
    }

    $newStatus = $admin['status'] === 'active'
        ? 'inactive'
        : 'active';

    $this->userModel->update($id, [
        'status' => $newStatus
    ]);

    return redirect()
        ->to('/super-admin/admins')
        ->with(
            'success',
            'Admin status updated successfully.'
        );
}
}