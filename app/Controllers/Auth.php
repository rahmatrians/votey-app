<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PesertaModel;

class Auth extends BaseController
{
    protected $adminModel;
    protected $pesertaModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->pesertaModel = new PesertaModel();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function validates()
    {
        $session = session();
        $getUser = $this->adminModel->where('username', $this->request->getVar('username'))->first();
        // $getUser2 = $this->pesertaModel->where('nim', $this->request->getVar('username'))->first();
        // dd($getUser);
        if ($getUser != NULL) {

            if (md5($this->request->getVar('password')) == $getUser['password']) {
                $ses_data = [
                    'id_admin'       => $getUser['id_admin'],
                    'nama_lengkap'     => $getUser['nama_lengkap'],
                    'username'     => $getUser['username'],
                    'role' => 'admin',
                    'login_status'     => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to(base_url() . '/');
            } else {
                $session->setFlashdata('fail', 'nama pengguna atau katasandi kamu salah!');
                return redirect()->to(base_url() . '/' . 'auth');
            }
        } elseif ($this->pesertaModel->where('nim', $this->request->getVar('username'))->first() != NULL) {
            $getUser = $this->pesertaModel->where('nim', $this->request->getVar('username'))->first();
            if (md5($this->request->getVar('password')) == $getUser['password']) {
                $ses_data = [
                    'nim'       => $getUser['nim'],
                    'nama_lengkap'     => $getUser['nama_lengkap'],
                    'id_prodi'     => $getUser['id_prodi'],
                    'role' => 'peserta',
                    'login_status'     => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to(base_url() . '/polling');
            } else {
                $session->setFlashdata('fail', 'nama pengguna atau katasandi kamu salah!');
                return redirect()->to(base_url() . '/' . 'auth');
            }
        } else {
            $session->setFlashdata('fail', 'nama pengguna atau katasandi kamu salah!');
            return redirect()->to(base_url() . '/' . 'auth');
        }
    }

    public function logout($id)
    {
        $this->adminModel->update($id, [
            "last_login" =>  date("Y-m-d h:i:s")
        ]);

        $session = session();
        unset($_SESSION);
        $session->destroy();
        return redirect()->to('/auth');
    }
}
