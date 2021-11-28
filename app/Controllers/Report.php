<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\KandidatModel;
use App\Models\DataVotingModel;
use App\Models\DataSuaraModel;
use App\Models\PesertaModel;
use Dompdf\Dompdf;

class Report extends BaseController
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
        $pesertaGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->findAll();
        $totalGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->countAllResults();

        // dd($pesertaGolput);

        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
            'pesertaGolput' => $pesertaGolput,
            'totalGolput' => $totalGolput,
        ];
        // dd($data);
        return view('report/index', $data);
    }

    public function totalVotingKandidat()
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


        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
        ];

        return view('report/kandidat', $data);
    }


    public function totalVotingKandidatExcel()
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


        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
        ];

        return view('report/kandidatExcel', $data);
    }

    public function totalVotingProdi()
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
        $pesertaPemilih = $this->pesertaModel->select('*, prodi.id_prodi, prodi.nama_prodi')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('prodi.nama_prodi', 'ASC')->findAll();


        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
            'pesertaPemilih' => $pesertaPemilih,
        ];

        return view('report/prodi', $data);
    }

    public function totalVotingProdiExcel()
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
        $pesertaPemilih = $this->pesertaModel->select('*, prodi.id_prodi, prodi.nama_prodi')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('prodi.nama_prodi', 'ASC')->findAll();


        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
            'pesertaPemilih' => $pesertaPemilih,
        ];

        return view('report/prodiExcel', $data);
    }

    public function golput()
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
        $pesertaGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->findAll();
        $totalGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->countAllResults();

        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
            'pesertaGolput' => $pesertaGolput,
            'totalGolput' => $totalGolput,
        ];

        return view('report/pesertaGolput', $data);
    }

    public function golputExcel()
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
        $pesertaGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->findAll();
        $totalGolput = $this->pesertaModel->select('nim, nama_lengkap, peserta.id_prodi, prodi.nama_prodi, tgl_lahir, password')->where('nim NOT IN (SELECT nim FROM data_voting)')->join('prodi', 'prodi.id_prodi = peserta.id_prodi')->orderBy('nama_prodi', 'ASC')->countAllResults();

        // dd($pesertaGolput);

        $data = [
            'event' => $eventData,
            'dataSuara' => $dataSuara,
            'kandidat' => $kandidatData,
            'totalSuara' => $totalSuara,
            'totalPeserta' => $totalPeserta,
            'totalPemilihByProdi' => $totalPemilihByProdi,
            'pesertaGolput' => $pesertaGolput,
            'totalGolput' => $totalGolput,
        ];

        return view('report/pesertaGolputExcel', $data);
    }
}
