<?php

namespace App\Controllers;

use App\Models\PesertaModel;
use App\Models\ProdiModel;
use App\Models\DataVotingModel;
use App\Models\EventModel;

class Peserta extends BaseController
{
    protected $pesertaModel;
    protected $prodiModel;
    protected $dataVotingModel;
    protected $eventModel;

    public function __construct()
    {
        $this->pesertaModel = new PesertaModel();
        $this->prodiModel = new ProdiModel();
        $this->dataVotingModel = new dataVotingModel();
        $this->eventModel = new EventModel();
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

        // dd($this->request->getVar());

        if (!$this->validate([
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'id_prodi' => 'required',
            'tgl_lahir' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $explode = explode("-", $this->request->getVar('tgl_lahir'));
        $newPass = md5(implode($explode));

        $this->pesertaModel->save([
            'nim' => $this->request->getVar('nim'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_prodi' => $this->request->getVar('id_prodi'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
            'password' => $newPass
        ]);

        session()->setFlashdata('pesan', 'Peserta Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $peserta = $this->pesertaModel->where('nim', $id)->first();
        $oneProdi = $this->prodiModel->where('id_prodi', $peserta['id_prodi'])->first();
        $allProdi = $this->prodiModel->findAll();
        $data = [
            // 'eventId' => $event['id_poll'],
            'titlePage' => 'Edit Data Peserta',
            'prodi' => $allProdi,
            'validation' => \Config\Services::validation(),
            'peserta' => $peserta,
            'oneProdi' => $oneProdi
        ];
        // dd($data);
        return view('/peserta/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $data = [
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'id_prodi' => $this->request->getVar('id_prodi'),
            'tgl_lahir' => $this->request->getVar('tgl_lahir'),
        ];
        $this->pesertaModel->update($id, $data);

        session()->setFlashdata('pesan', 'Data success changed');
        return redirect()->to('peserta/');
    }

    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }
        $this->dataVotingModel->where('nim', $id)->delete();
        $this->pesertaModel->where('nim', $id)->delete();
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->back();
    }
}
