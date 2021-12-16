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

    public function register()
    {
        return view('auth/register');
    }

    public function verification()
    {
        return view('auth/verification');
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
                    'email_active_status'     => $getUser['email_active_status'],
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

    public function registerValidates()
    {
        // dd($this->request->getVar());
        $session = session();
        $where = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username')
        ];
        $getUser = $this->adminModel->where($where)->first();

        if ($getUser == NULL) {
            $activateCode = random_int(100000, 999999);
            if ($this->adminModel->save([
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'password' => md5($this->request->getVar('password')),
                'activate_code' => $activateCode,
                'email_active_status' => 0,
            ])) {

                $dataNewAdmin = $this->adminModel->where('email', $this->request->getVar('email'))->first();
                $ses_data = [
                    'id_admin'       => $dataNewAdmin['id_admin'],
                    'nama_lengkap'     => $dataNewAdmin['nama_lengkap'],
                    'username'     => $dataNewAdmin['username'],
                    'role' => 'admin',
                    'email_active_status'     => $dataNewAdmin['email_active_status'],
                    'login_status'     => TRUE
                ];
                $session->set($ses_data);

                $email = \Config\Services::email();
                $email->setFrom('voteyapp@gmail.com', 'Votey Activation Generator');
                $email->setTo($this->request->getVar('email'));
                $email->setSubject('Votey (E-Voting)');

                $email->setMessage('Kode Aktivasi mu: <b>' . $activateCode . '</b>');

                if ($email->send()) {
                    return redirect()->to(base_url() . '/' . 'auth/verification');
                }
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

    public function verificationCode()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url() . '/polling');
        } else if (session()->get('email_active_status') == 1) {
            return redirect()->back();
        }


        $data = $this->adminModel->where('id_admin', session()->get('id_admin'))->first();
        if ($data['activate_code'] == $this->request->getVar('activate_code')) {
            $this->adminModel->update(session()->get('id_admin'), [
                "activate_code" =>  0,
                "email_active_status" =>  1
            ]);

            $ses_data = [
                'email_active_status'       => 1
            ];
            $session->set($ses_data);

            return redirect()->to(base_url());
        } else {
            return redirect()->to(base_url() . '/' . 'auth/verificationx');
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
