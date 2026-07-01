<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class BaseSuperAdminController extends BaseController
{
    protected $session;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();

        // Login Check
        if (!$this->session->get('logged_in')) {
            redirect()->to('/login')->send();
            exit;
        }

        // Super Admin Role Check
        if ($this->session->get('role') !== 'super_admin') {

            redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Access denied.'
                )
                ->send();

            exit;
        }
    }
}