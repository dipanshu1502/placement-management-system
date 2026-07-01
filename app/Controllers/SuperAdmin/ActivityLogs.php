<?php

namespace App\Controllers\SuperAdmin;

use App\Models\ActivityLogModel;
use App\Models\UserModel;

class ActivityLogs extends BaseSuperAdminController
{
    public function index()
    {
        $logModel  = new ActivityLogModel();
        $userModel = new UserModel();

        // Filters
        $search = trim($this->request->getGet('search'));
        $admin  = $this->request->getGet('admin');
        $module = $this->request->getGet('module');
        $action = $this->request->getGet('action');
        $from   = $this->request->getGet('from');
        $to     = $this->request->getGet('to');

        $builder = $logModel
            ->select('
                activity_logs.*,
                users.name
            ')
            ->join(
                'users',
                'users.id = activity_logs.user_id'
            );

        // Search
        if (!empty($search)) {
            $builder->groupStart()
                ->like('users.name', $search)
                ->orLike('activity_logs.description', $search)
                ->orLike('activity_logs.ip_address', $search)
                ->groupEnd();
        }

        // Admin Filter
        if (!empty($admin)) {
            $builder->where('activity_logs.user_id', $admin);
        }

        // Module Filter
        if (!empty($module)) {
            $builder->where('activity_logs.module', $module);
        }

        // Action Filter
        if (!empty($action)) {
            $builder->where('activity_logs.action', $action);
        }

        // From Date
        if (!empty($from)) {
            $builder->where('DATE(activity_logs.created_at) >=', $from);
        }

        // To Date
        if (!empty($to)) {
            $builder->where('DATE(activity_logs.created_at) <=', $to);
        }

        $logs = $builder
            ->orderBy('activity_logs.id', 'DESC')
            ->paginate(15);

        

        // Admin List
        $admins = $userModel
            ->whereIn('role', ['admin', 'super_admin'])
            ->orderBy('name', 'ASC')
            ->findAll();

        // Module List
        $modules = $logModel
            ->select('module')
            ->distinct()
            ->orderBy('module', 'ASC')
            ->findColumn('module');

        // Action List
        $actions = $logModel
            ->select('action')
            ->distinct()
            ->orderBy('action', 'ASC')
            ->findColumn('action');

        return view('super_admin/activity_logs/index', [

            'logs'    => $logs,
            'pager'   => $logModel->pager,

            'admins'  => $admins,
            'modules' => $modules,
            'actions' => $actions,

            'search'  => $search,
            'admin'   => $admin,
            'module'  => $module,
            'action'  => $action,
            'from'    => $from,
            'to'      => $to
        ]);
    }
}