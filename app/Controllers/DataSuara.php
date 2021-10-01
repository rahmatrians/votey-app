<?php

namespace App\Controllers;

use App\Models\dataSuaraModel;
use App\Models\kandidatModel;

class DataSuara extends BaseController
{
    protected $dataSuaraModel;
    // protected $kandidatModel;

    public function __construct()
    {
        $this->dataSuaraModel = new dataSuaraModel();
        // $this->kandidatModel = new kandidatModel();
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

    public function save($id_kandidat, $id_poll)
    {
        $this->dataSuaraModel->save([
            'id_kandidat' => $id_kandidat,
            'id_poll' => $id_poll,
            'total_suara' => 0
        ]);

        return redirect()->back();
    }

    public function deleteByKandidat($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        }

        $this->dataSuaraModel->where('id_kandidat', $id)->delete();
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->back();
    }
}
