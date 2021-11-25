<?php

namespace App\Controllers;

use App\Models\EventModel;

class Event extends BaseController
{
    protected $eventModel;


    public function __construct()
    {
        $this->eventModel = new EventModel();
    }


    // public function index($id)
    // {
    //     if (session()->get('role') != 'admin') {
    //         return redirect()->to('/polling');
    //     }

    //     $event = $this->eventModel->where('id_poll', $id)->first();
    //     $data = [
    //         'kandidat' => $kandidat,
    //         'eventId' => $id,
    //         'eventName' => $event['nama_poll'],
    //         'activeStat' => 'active',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('kandidat/index', $data);
    // }

    public function save()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        if (!$this->validate([
            'nama_poll' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->eventModel->save([
            'nama_poll' => $this->request->getVar('nama_poll'),
            'waktu' => date('Y-m-d'),
            'status' => 0,
        ]);

        session()->setFlashdata('pesan', 'Data success added');
        return redirect()->to('/');
    }

    // public function edit($id)
    // {
    //     if (session()->get('role') != 'admin') {
    //         return redirect()->to('/polling');
    //     }

    //     $kandidat = $this->kandidatModel->where('id_kandidat', $id)->first();
    //     $event = $this->eventModel->where('id_poll', $kandidat['id_poll'])->first();
    //     $data = [
    //         'eventId' => $event['id_poll'],
    //         'titlePage' => 'Edit Kandidat Data',
    //         'validation' => \Config\Services::validation(),
    //         'kandidat' => $kandidat
    //     ];
    //     return view('/kandidat/edit', $data);
    // }

    // public function update($id)
    // {
    //     if (session()->get('role') != 'admin') {
    //         return redirect()->to('/polling');
    //     }

    //     $fotoKandidat = $this->request->getFiles();

    //     if (empty($fotoKandidat['foto_ketua']->getName()) && empty($fotoKandidat['foto_wakil']->getName())) {
    //         $this->kandidatModel->save([
    //             'id_kandidat' => $id,
    //             'nama_ketua' => $this->request->getVar('nama_ketua'),
    //             'nama_wakil' => $this->request->getVar('nama_wakil'),
    //             'visi' => $this->request->getVar('visi'),
    //             'misi' => $this->request->getVar('misi'),
    //             'program_kerja' => $this->request->getVar('program_kerja'),
    //             'slogan' => $this->request->getVar('slogan'),
    //         ]);
    //     } elseif (empty($fotoKandidat['foto_ketua']->getName())) {
    //         $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

    //         $this->kandidatModel->save([
    //             'id_kandidat' => $id,
    //             'nama_ketua' => $this->request->getVar('nama_ketua'),
    //             'nama_wakil' => $this->request->getVar('nama_wakil'),
    //             'visi' => $this->request->getVar('visi'),
    //             'misi' => $this->request->getVar('misi'),
    //             'program_kerja' => $this->request->getVar('program_kerja'),
    //             'slogan' => $this->request->getVar('slogan'),
    //             'foto_wakil' => $fileNameWakil
    //         ]);

    //         $fotoKandidat['foto_wakil']->move('images/kandidat/', $fileNameWakil);
    //     } elseif (empty($fotoKandidat['foto_wakil']->getName())) {
    //         $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();

    //         $this->kandidatModel->save([
    //             'id_kandidat' => $id,
    //             'nama_ketua' => $this->request->getVar('nama_ketua'),
    //             'nama_wakil' => $this->request->getVar('nama_wakil'),
    //             'visi' => $this->request->getVar('visi'),
    //             'misi' => $this->request->getVar('misi'),
    //             'program_kerja' => $this->request->getVar('program_kerja'),
    //             'slogan' => $this->request->getVar('slogan'),
    //             'foto_ketua' => $fileNameKetua
    //         ]);

    //         $fotoKandidat['foto_ketua']->move('images/kandidat/', $fileNameKetua);
    //     } else {
    //         $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();
    //         $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

    //         $this->kandidatModel->save([
    //             'id_kandidat' => $id,
    //             'nama_ketua' => $this->request->getVar('nama_ketua'),
    //             'nama_wakil' => $this->request->getVar('nama_wakil'),
    //             'visi' => $this->request->getVar('visi'),
    //             'misi' => $this->request->getVar('misi'),
    //             'program_kerja' => $this->request->getVar('program_kerja'),
    //             'slogan' => $this->request->getVar('slogan'),
    //             'foto_ketua' => $fileNameKetua,
    //             'foto_wakil' => $fileNameWakil
    //         ]);
    //         $fotoKandidat['foto_ketua']->move('images/kandidat/', $fileNameKetua);
    //         $fotoKandidat['foto_wakil']->move('images/kandidat/', $fileNameWakil);
    //     }

    //     session()->setFlashdata('pesan', 'Data success changed');
    //     return redirect()->to('kandidat/event/' . $this->request->getVar('id_poll'));
    // }

    public function updateStatus($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $multipleWhere = ['status' => 1, 'id_poll' => $id];
        if ($this->eventModel->where('status', 1)->countAllResults() == 0 || $this->eventModel->where($multipleWhere)->countAllResults() == 1) {
            $this->eventModel->update($id, [
                "status" => $this->request->getVar('status'),
            ]);
        } else {
            dd("masih ada yg belum selesai nih mat di update status ini");
        }

        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->to(base_url() . '/kandidat/event/' . $id);
    }

    // public function delete($id)
    // {
    //     if (session()->get('role') != 'admin') {
    //         return redirect()->to('/polling');
    //     }

    //     $this->kandidatModel->delete($id);
    //     session()->setFlashdata('pesan', 'Data success deleted');
    //     return redirect()->to('/dataSuara/deleteByKandidat/' . $id);
    // }
}
