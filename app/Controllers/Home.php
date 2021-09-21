<?php

namespace App\Controllers;

use App\Models\EventModel;

class Home extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }
    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to(base_url() . '/polling');
        }

        $data = [
            'event' => $this->eventModel->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}
