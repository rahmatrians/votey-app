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
}
