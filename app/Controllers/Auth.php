<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasswordResetModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $userModel = new UserModel();

        $name = trim($this->request->getPost('name'));
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        // Check Existing Email
        $existingUser = $userModel
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email already registered. Please login.');
        }

        // Save User
        $userData = [
            'name'     => $name,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'student',
            'status'   => 'active'
        ];

        $userModel->insert($userData);

        $userId = $userModel->getInsertID();

        // Auto Login
        session()->set([
            'id'        => $userId,
            'name'      => $name,
            'email'     => $email,
            'role'      => 'student',
            'status'    => 'active',
            'logged_in' => true
        ]);

        return redirect()->to('/student/dashboard');
    }

    public function checkLogin()
    {
        $userModel = new UserModel();

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $user = $userModel
            ->where('email', $email)
            ->first();

        if ($user && password_verify($password, $user['password'])) {

            // Block inactive users
            if (
                isset($user['status']) &&
                $user['status'] !== 'active'
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Your account is inactive. Please contact the administrator.'
                    );
            }

            // Create Session
            session()->set([
                'id'        => $user['id'],
                'name'      => $user['name'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'status'    => $user['status'],
                'logged_in' => true
            ]);

            switch ($user['role']) {

                case 'student':
                    return redirect()->to('/student/dashboard');

                case 'admin':
                    return redirect()->to('/admin/dashboard');

                case 'super_admin':
                    return redirect()->to('/super-admin/dashboard');

                default:

                    session()->destroy();

                    return redirect()
                        ->to('/login')
                        ->with(
                            'error',
                            'Invalid user role.'
                        );
            }
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Invalid email or password.');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $email = trim($this->request->getPost('email'));

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'No account found with this email address.'
                );
        }

        $token = bin2hex(random_bytes(32));

        $passwordResetModel = new PasswordResetModel();

        $passwordResetModel
            ->where('email', $email)
            ->delete();

        $passwordResetModel->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $resetLink = base_url('reset-password/' . $token);

        session()->setFlashdata('reset_link', $resetLink);

        return redirect()
            ->back()
            ->with(
                'success',
                'Reset link generated successfully.'
            );
    }

    public function resetPassword($token)
    {
        $passwordResetModel = new PasswordResetModel();

        $resetRequest = $passwordResetModel
            ->where('token', $token)
            ->first();

        if (!$resetRequest) {
            return redirect()
                ->to('/forgot-password')
                ->with(
                    'error',
                    'Invalid or expired reset link.'
                );
        }

        return view(
            'auth/reset_password',
            [
                'token' => $token
            ]
        );
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $passwordResetModel = new PasswordResetModel();

        $resetRequest = $passwordResetModel
            ->where('token', $token)
            ->first();

        if (!$resetRequest) {
            return redirect()
                ->to('/forgot-password')
                ->with(
                    'error',
                    'Invalid or expired reset link.'
                );
        }

        $userModel = new UserModel();

        $userModel
            ->where('email', $resetRequest['email'])
            ->set([
                'password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                )
            ])
            ->update();

        $passwordResetModel
            ->where('token', $token)
            ->delete();

        session()->remove('reset_link');

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Password updated successfully. Please login.'
            );
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}