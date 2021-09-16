<?php

namespace App\Controllers;

use App\Models\dataSuaraModel;
use App\Models\kandidatModel;

class DataSuara extends BaseController
{
    protected $dataSuaraModel;
    protected $kandidatModel;

    public function __construct()
    {
        $this->dataSuaraModel = new dataSuaraModel();
        $this->kandidatModel = new kandidatModel();
    }

    public function list()
    {
        $product = $this->dataSuaraModel->findAll();

        $data = [
            'titlePage' => 'Category Product Data List',
            'product' => $product
        ];
        return view('product/list', $data);
    }

    public function create()
    {
        $kandidat = $this->kandidatModel->findAll();
        $data = [
            'category' => $kandidat,
            'validation' => \Config\Services::validation()
        ];

        return view('product/create', $data);
    }

    public function deleteByKandidat($id)
    {
        $this->dataSuaraModel->where('id_suara', $id)->delete();
        return redirect()->to('kandidat/');
    }

    public function save()
    {
        $dataimage = $this->request->getFile('image');
        $fileName = $dataimage->getRandomName();

        $this->dataSuaraModel->save([
            'name_product' => $this->request->getVar('name'),
            'image_product' => $fileName,
            'id_category' => $this->request->getVar('id_cat')
        ]);

        $dataimage->move('images/', $fileName);
        session()->setFlashdata('pesan', 'Data success added');

        return redirect()->to('/product/list');
    }

    public function edit($id)
    {
        $getData = $this->dataSuaraModel->where('id_product', $id)->first();
        $kandidat = $this->kandidatModel->findAll();
        $getCategory = $this->kandidatModel->where('id_category', $getData['id_category'])->first();

        $data = [
            'titlePage' => 'Edit Product Data',
            'product' => $getData,
            'category' => $kandidat,
            'categorySelected' => $getCategory,
            'validation' => \Config\Services::validation()
        ];

        return view('product/edit', $data);
    }

    public function update($id)
    {
        if (empty($this->request->getFile('image')->getName())) {
            $this->dataSuaraModel->save([
                'id_product' => $id,
                'name_product' => $this->request->getVar('name_product'),
                'id_category' => $this->request->getVar('id_category')
            ]);
        } else {

            $dataimage = $this->request->getFile('image');
            $fileName = $dataimage->getRandomName();

            $this->dataSuaraModel->save([
                'id_product' => $id,
                'name_product' => $this->request->getVar('name_product'),
                'id_category' => $this->request->getVar('id_category'),
                'image_product' => $fileName
            ]);

            $dataimage->move('images/', $fileName);
        }

        session()->setFlashdata('pesan', 'Data success changed');
        return redirect()->to('/product/list');
    }

    public function delete($id)
    {
        $this->dataSuaraModel->delete($id);
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->to('kandidat/');
    }
}
