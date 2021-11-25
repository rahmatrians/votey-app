<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\ProdiModel;

class Peserta extends BaseController
{
    protected $pesertaModel;
    protected $prodiModel;

    public function __construct()
    {
        $this->pesertaModel = new PesertaModel();
        $this->prodiModel = new ProdiModel();
    }
    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $peserta = $this->pesertaModel->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->findAll();
        $prodi = $this->prodiModel->findAll();
        $data = [
            'peserta' => $peserta,
            'prodi' => $prodi,
            'activeStat' => 'active',
            'validation' => \Config\Services::validation()
        ];

        return view('peserta/index', $data);
    }

    public function save()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        if (!$this->validate([
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'id_prodi' => 'required',
            'tgl_lahir' => 'required',
            'password' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $explode = explode("-", $this->request->getVar('tgl_lahir'));
        $newPass = implode($explode);

        $this->pesertaModel->save([
            'nim' => $this->request->getVar('nim'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_prodi' => $this->request->getVar('prodi'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'password' => $newPass
        ]);

        session()->setFlashdata('pesan', 'Data success added');
        return redirect()->back();
    }
}
