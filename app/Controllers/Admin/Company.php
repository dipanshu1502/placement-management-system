<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class Company extends BaseController
{
    protected $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    public function index()
    {
        $data['companies'] = $this->companyModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('admin/companies/index', $data);
    }

    public function create()
    {
        return view('admin/companies/create');
    }

    public function store()
    {
        $this->companyModel->save([
            'company_name' => $this->request->getPost('company_name'),
            'website'      => $this->request->getPost('website'),
            'package'      => $this->request->getPost('package'),
            'location'     => $this->request->getPost('location')
        ]);

        return redirect()
            ->to('/admin/companies')
            ->with('success', 'Company Added Successfully');
    }

    public function edit($id)
    {
        $data['company'] = $this->companyModel->find($id);

        return view('admin/companies/edit', $data);
    }

    public function update($id)
    {
        $this->companyModel->update($id, [
            'company_name' => $this->request->getPost('company_name'),
            'website'      => $this->request->getPost('website'),
            'package'      => $this->request->getPost('package'),
            'location'     => $this->request->getPost('location')
        ]);

        return redirect()
            ->to('/admin/companies')
            ->with('success', 'Company Updated Successfully');
    }

    public function delete($id)
    {
        $this->companyModel->delete($id);

        return redirect()
            ->to('/admin/companies')
            ->with('success', 'Company Deleted Successfully');
    }
}