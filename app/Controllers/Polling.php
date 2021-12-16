<?php

namespace App\Controllers;

use App\Models\PollingModel;
use App\Models\KandidatModel;
use App\Models\DataVotingModel;
use App\Models\DataSuaraModel;
use App\Models\EventModel;

class Polling extends BaseController
{
    protected $pollingModel;
    protected $kandidatModel;
    protected $dataSuaraModel;
    protected $eventModel;


    public function __construct()
    {
        $this->pollingModel = new PollingModel();
        $this->kandidatModel = new KandidatModel();
        $this->dataVotingModel = new DataVotingModel();
        $this->dataSuaraModel = new DataSuaraModel();
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        if (session()->get('role') != 'peserta') {
            return redirect()->to('/');
        }

        $getEvent = $this->eventModel->where('status', 1)->first();
        if ($getEvent != NULL) {

            if ($this->dataVotingModel->where('nim', session()->get('nim'))->where('id_poll', $getEvent['id_poll'])->countAllResults() == 0) {
                $eventData = $this->eventModel->where('status', 1)->first();
                $data = [
                    'event' => $eventData,
                    'kandidat' => $this->kandidatModel->where('id_poll', $getEvent['id_poll'])->findAll(),
                ];
                return view('polling/index', $data);
            } else {
                $eventData = $this->eventModel->where('status', 1)->first();
                $kandidatData = $this->kandidatModel->where('id_poll', $eventData['id_poll'])->findAll();
                $dataSuara = $this->dataSuaraModel->where('id_poll', $eventData['id_poll'])->findAll();
                $data = [
                    'event' => $eventData,
                    'kandidat' => $kandidatData,
                    'dataSuara' => $dataSuara,
                    'message' => "Kamu Sudah memilih!"
                ];
                return view('polling/voted', $data);
            }
        } else {
            $eventData = $this->eventModel->where('status', 1)->first();
            $kandidatData = $this->kandidatModel->where('id_poll', $eventData['id_poll'])->findAll();
            $dataSuara = $this->dataSuaraModel->where('id_poll', $eventData['id_poll'])->findAll();
            $data = [
                'event' => $eventData,
                'kandidat' => $kandidatData,
                'dataSuara' => $dataSuara,
                'message' => "Kamu Sudah memilih!"
            ];
            return view('polling/voted', $data);
        }
    }

    public function getKandidatById($id)
    {
        if (session()->get('role') != 'peserta') {
            return redirect()->to('/polling');
        }

        $kandidat = $this->kandidatModel->find($id);
        $data = [
            'kandidat' => $kandidat,
        ];

        echo json_encode($data);
    }

    public function voted()
    {
        if (session()->get('role') != 'peserta') {
            return redirect()->to('/');
        }

        // $data = $this->dataSuaraModel->where('id_kandidat', $this->request->getVar('id_kandidat'), 'id_poll', $this->request->getVar('id_poll'))->first();
        // dd($data);


        $getEvent = $this->eventModel->where('status', 1)->first();
        if ($this->dataVotingModel->where('nim', session()->get('nim'))->where('id_poll', $getEvent['id_poll'])->countAllResults() == 0) {
            $this->dataVotingModel->save([
                'id_poll' => $this->request->getVar('id_poll'),
                'nim' => $this->request->getVar('nim'),
                'date' => date('Y-m-d')
            ]);


            $data = $this->dataSuaraModel->where('id_kandidat', $this->request->getVar('id_kandidat'), 'id_poll', $this->request->getVar('id_poll'))->first();
            if ($data) {
                $this->dataSuaraModel->save([
                    'id_suara' => $data['id_suara'],
                    'id_kandidat' => $this->request->getVar('id_kandidat'),
                    'id_poll' => $this->request->getVar('id_poll'),
                    'total_suara' => $data['total_suara'] + 1
                ]);
            }
        }


        session()->setFlashdata('pesan', 'Data success added');

        return redirect()->to('/');
    }
}
