<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        $userModel = new UserModel();

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Email and password are required'
            ]);
        }

        $user = $userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid password'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login successful',
            'user' => [
                'id'    => $user['id'],
                'name'  => $user['name'],
                'email' => $user['email'],
                'role'  => $user['role']
            ]
        ]);
    }
}