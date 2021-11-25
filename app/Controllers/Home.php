<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\KandidatModel;
use App\Models\DataVotingModel;
use App\Models\DataSuaraModel;
use App\Models\PesertaModel;

class Home extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->kandidatModel = new KandidatModel();
        $this->dataSuaraModel = new DataSuaraModel();
        $this->pesertaModel = new PesertaModel();
        $this->dataVotingModel = new DataVotingModel();
    }
    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url() . '/polling');
        }

        $eventData = $this->eventModel->where('status', 1)->first();
        $dataSuara = $this->dataSuaraModel->where('id_poll', $eventData['id_poll'])->findAll();
        $kandidatData = $this->kandidatModel->where('id_poll', $eventData['id_poll'])->findAll();
        $totalSuara = $this->dataSuaraModel->selectSum('total_suara')->where('id_poll', $eventData['id_poll'])->first();
        $totalPeserta = $this->pesertaModel->countAllResults();
        $totalPemilihByProdi = $this->dataVotingModel->select('prodi.nama_prodi, COUNT(id_voting) as total')->join('peserta', 'peserta.nim = data_voting.nim')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->groupBy('prodi.id_prodi')->findAll();

        // dd($totalPemilihByProdi);

        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
        ];
        // dd($data);
        return view('dashboard/index', $data);
    }

    public function events()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url() . '/polling');
        }

        $data = [
            'event' => $this->eventModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('dashboard/events', $data);
    }
}
