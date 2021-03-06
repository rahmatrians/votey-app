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

    public function save($id_poll, $id_kandidat)
    {
        $this->dataSuaraModel->save([
            'id_kandidat' => $id_kandidat,
            'id_poll' => $id_poll,
            'total_suara' => 0
        ]);

        session()->setFlashdata('pesan', 'Kandidat Berhasil Ditambahkan!');
        return redirect()->to(base_url() . '/kandidat/event/' . $id_poll);
    }

    public function deleteByKandidat($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/polling');
        } else if (session()->get('email_active_status') != 1) {
            return redirect()->to(base_url() . '/auth/verification');
        }

        $this->dataSuaraModel->where('id_kandidat', $id)->delete();
        session()->setFlashdata('pesan', 'Data success deleted');
        return redirect()->back();
    }
}
