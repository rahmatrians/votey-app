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
        $category = $this->kandidatModel->where('id_category', $id)->first();
        $data = [
            'titlePage' => 'Edit Category Data',
            'validation' => \Config\Services::validation(),
            'category' => $category
        ];
        return view('/category/edit', $data);
    }

    public function update($id)
    {
        // dd($this->request->getFile('image'));

        if (empty($this->request->getFile('image')->getName())) {
            $this->kandidatModel->save([
                'id_category' => $id,
                'name_category' => $this->request->getVar('name'),
                'desc_category' => $this->request->getVar('desc')
            ]);
        } else {
            $dataimage = $this->request->getFile('image');
            $fileName = $dataimage->getRandomName();

            $this->kandidatModel->save([
                'id_category' => $id,
                'name_category' => $this->request->getVar('name'),
                'desc_category' => $this->request->getVar('desc'),
                'image_category' => $fileName
            ]);

            $dataimage->move('images/', $fileName);
        }

        session()->setFlashdata('pesan', 'Data success changed');
        return redirect()->to('/category/list');
    }

    public function delete($id)
    {
        $this->kandidatModel->delete($id);
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->to('/dataSuara/deleteByKandidat/' . $id);
    }
}
