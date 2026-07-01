<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 */
abstract class BaseController extends Controller
{
    /**
     * @return void
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
    }

    /**
     * Log Activity
     */
    protected function logActivity($action, $module, $description)
    {
        // Sirf logged in Admin / Super Admin ki activity save hogi
        if (!session()->get('logged_in')) {
            return;
        }

        if (!in_array(session()->get('role'), ['admin', 'super_admin'])) {
            return;
        }

        $logModel = new ActivityLogModel();

        $logModel->insert([
            'user_id'     => session()->get('id'),
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => $this->request->getIPAddress()
        ]);
    }
}