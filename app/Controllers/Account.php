<?php

namespace App\Controllers;

use App\Models\AdminModel;


class Account extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function index($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }


        $admin = $this->adminModel->where('id_admin', $id)->first();
        $data = [
            'admin' => $admin,
            'validation' => \Config\Services::validation(),
        ];

        return view('account/index', $data);
    }

    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        if (empty($this->request->getVar())) {
            return redirect()->back();
        } else {
            if ($this->request->getVar('nama_lengkap')) {
                $data = [
                    'nama_lengkap' => $this->request->getVar('nama_lengkap')
                ];
            } else if ($this->request->getVar('username')) {
                $data = [
                    'username' => $this->request->getVar('username')
                ];
            } else if ($this->request->getVar('password')) {
                $data = [
                    'password' => $this->request->getVar('password')
                ];
            } else {
                return redirect()->back();
            }
        }

        $this->adminModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data success changed');
        return redirect()->back();
    }
}
