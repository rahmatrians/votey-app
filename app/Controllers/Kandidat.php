<?php

namespace App\Controllers;

use App\Models\KandidatModel;

class Kandidat extends BaseController
{
    protected $kandidatModel;

    public function __construct()
    {
        $this->kandidatModel = new KandidatModel();
    }

    public function list()
    {
        $category = $this->kandidatModel->findAll();

        $data = [
            'titlePage' => 'Category Data List',
            'category' => $category
        ];
        return view('category/list', $data);
    }

    public function getById($id)
    {
        $kandidat = $this->kandidatModel->find($id);
        $data = [
            'kandidat' => $kandidat,
        ];

        echo json_encode($data);
        // return $data;
    }

    public function detail($id)
    {
        $category = $this->kandidatModel->find($id);
        $product = $this->productModel->findAll();
        $data = [
            'category' => $category,
            'product' => $product
        ];

        return view('category/detail', $data);
    }

    public function index()
    {
        $kandidat = $this->kandidatModel->findAll();
        $data = [
            'kandidat' => $kandidat,
            'titlePage' => 'Add New Category',
            'activeStat' => 'active',
            'validation' => \Config\Services::validation()
        ];

        return view('kandidat/index', $data);
    }

    public function save()
    {
        $fotoKandidat = $this->request->getFiles();
        $fileNameKetua = $fotoKandidat['foto_ketua']->getRandomName();
        $fileNameWakil = $fotoKandidat['foto_wakil']->getRandomName();

        $this->kandidatModel->save([
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
        session()->setFlashdata('pesan', 'Data success added');

        return redirect()->to('/');
    }

    public function edit($id)
    {
        $kandidat = $this->kandidatModel->where('id_kandidat', $id)->first();
        $data = [
            'titlePage' => 'Edit Kandidat Data',
            'validation' => \Config\Services::validation(),
            'kandidat' => $kandidat
        ];
        return view('/kandidat/edit', $data);
    }

    public function update($id)
    {
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
        return redirect()->to('kandidat/');
    }

    public function delete($id)
    {
        $this->kandidatModel->delete($id);
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->to('/dataSuara/deleteByKandidat/' . $id);
    }
}
