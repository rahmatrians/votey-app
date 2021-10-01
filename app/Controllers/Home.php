<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\KandidatModel;
use App\Models\DataVotingModel;
use App\Models\DataSuaraModel;

class Home extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->kandidatModel = new KandidatModel();
        $this->dataSuaraModel = new DataSuaraModel();
    }
    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url() . '/polling');
        }

        $eventData = $this->eventModel->where('status', 1)->first();
        $dataSuara = $this->dataSuaraModel->where('id_poll', $eventData['id_poll'])->findAll();
        $kandidatData = $this->kandidatModel->where('id_poll', $eventData['id_poll'])->findAll();

        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
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
        ];

        return view('dashboard/events', $data);
    }
}
