<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SuperAdminFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        // User logged in?
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Only Super Admin allowed
        if (session()->get('role') !== 'super_admin') {

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Access denied.'
                );
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        //
    }
}