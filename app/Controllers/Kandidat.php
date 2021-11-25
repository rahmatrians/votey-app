<?php

namespace App\Controllers;

use App\Models\KandidatModel;
use App\Models\EventModel;

class Kandidat extends BaseController
{
    protected $kandidatModel;
    protected $eventModel;

    public function __construct()
    {
        $this->kandidatModel = new KandidatModel();
        $this->eventModel = new EventModel();
    }

    public function getById($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $kandidat = $this->kandidatModel->find($id);
        $data = [
            'kandidat' => $kandidat,
        ];

        echo json_encode($data);
    }

    public function index($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $kandidat = $this->kandidatModel->where('id_poll', $id)->findAll();
        $event = $this->eventModel->where('id_poll', $id)->first();
        $data = [
            'kandidat' => $kandidat,
            'event' => $event,
            'activeStat' => 'active',
            'validation' => \Config\Services::validation()
        ];

        return view('kandidat/index', $data);
    }

    public function save()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        if (!$this->validate([
            'nama_ketua' => 'required',
            'nama_wakil' => 'required',
            'foto_ketua' => 'required',
            'foto_wakil' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'program_kerja' => 'required',
            'slogan' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $fotoKandidat = $this->request->getFiles();
        $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();
        $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

        $this->kandidatModel->save([
            'id_poll' => $this->request->getVar('id_poll'),
            'nama_ketua' => $this->request->getVar('nama_ketua'),
            'nama_wakil' => $this->request->getVar('nama_wakil'),
            'visi' => $this->request->getVar('visi'),
            'misi' => $this->request->getVar('misi'),
            'program_kerja' => $this->request->getVar('program_kerja'),
            'slogan' => $this->request->getVar('slogan'),
            'foto_ketua' => $fileNameKetua,
            'foto_wakil' => $fileNameWakil
        ]);

        $fotoKandidat['foto_ketua']->move('images/kandidat/', $fileNameKetua);
        $fotoKandidat['foto_wakil']->move('images/kandidat/', $fileNameWakil);
        // session()->setFlashdata('pesan', 'Data success added');

        $LastRowKandidat = $this->kandidatModel->orderBy('id_kandidat', 'DESC')->first();

        return redirect()->to('/dataSuara/save/' . $this->request->getVar('id_poll') . '/' . $LastRowKandidat['id_kandidat']);
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $kandidat = $this->kandidatModel->where('id_kandidat', $id)->first();
        $event = $this->eventModel->where('id_poll', $kandidat['id_poll'])->first();
        $data = [
            'eventId' => $event['id_poll'],
            'titlePage' => 'Edit Kandidat Data',
            'validation' => \Config\Services::validation(),
            'kandidat' => $kandidat
        ];
        return view('/kandidat/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $fotoKandidat = $this->request->getFiles();

        if (empty($fotoKandidat['foto_ketua']->getName()) && empty($fotoKandidat['foto_wakil']->getName())) {
            $this->kandidatModel->save([
                'id_kandidat' => $id,
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_wakil' => $this->request->getVar('nama_wakil'),
                'visi' => $this->request->getVar('visi'),
                'misi' => $this->request->getVar('misi'),
                'program_kerja' => $this->request->getVar('program_kerja'),
                'slogan' => $this->request->getVar('slogan'),
            ]);
        } elseif (empty($fotoKandidat['foto_ketua']->getName())) {
            $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

            $this->kandidatModel->save([
                'id_kandidat' => $id,
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_wakil' => $this->request->getVar('nama_wakil'),
                'visi' => $this->request->getVar('visi'),
                'misi' => $this->request->getVar('misi'),
                'program_kerja' => $this->request->getVar('program_kerja'),
                'slogan' => $this->request->getVar('slogan'),
                'foto_wakil' => $fileNameWakil
            ]);

            $fotoKandidat['foto_wakil']->move('images/kandidat/', $fileNameWakil);
        } elseif (empty($fotoKandidat['foto_wakil']->getName())) {
            $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();

            $this->kandidatModel->save([
                'id_kandidat' => $id,
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_wakil' => $this->request->getVar('nama_wakil'),
                'visi' => $this->request->getVar('visi'),
                'misi' => $this->request->getVar('misi'),
                'program_kerja' => $this->request->getVar('program_kerja'),
                'slogan' => $this->request->getVar('slogan'),
                'foto_ketua' => $fileNameKetua
            ]);

            $fotoKandidat['foto_ketua']->move('images/kandidat/', $fileNameKetua);
        } else {
            $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();
            $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

            $this->kandidatModel->save([
                'id_kandidat' => $id,
                'nama_ketua' => $this->request->getVar('nama_ketua'),
                'nama_wakil' => $this->request->getVar('nama_wakil'),
                'visi' => $this->request->getVar('visi'),
                'misi' => $this->request->getVar('misi'),
                'program_kerja' => $this->request->getVar('program_kerja'),
                'slogan' => $this->request->getVar('slogan'),
                'foto_ketua' => $fileNameKetua,
                'foto_wakil' => $fileNameWakil
            ]);
            $fotoKandidat['foto_ketua']->move('images/kandidat/', $fileNameKetua);
            $fotoKandidat['foto_wakil']->move('images/kandidat/', $fileNameWakil);
        }

        session()->setFlashdata('pesan', 'Data success changed');
        return redirect()->to('kandidat/event/' . $this->request->getVar('id_poll'));
    }

    public function delete($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $this->kandidatModel->delete($id);
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->to('/dataSuara/deleteByKandidat/' . $id);
    }
}
