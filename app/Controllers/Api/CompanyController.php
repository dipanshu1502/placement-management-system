<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class CompanyController extends BaseController
{
    public function index()
    {
        $companyModel = new CompanyModel();

        $companies = $companyModel->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data'   => $companies
        ]);
    }

    public function show($id)
    {
        $companyModel = new CompanyModel();

        $company = $companyModel->find($id);

        if (!$company) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Company not found'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data'   => $company
        ]);
    }
}