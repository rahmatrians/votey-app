<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event_poll';
    protected $primaryKey = 'id_poll';
    protected $allowedFields = ['nama_poll', 'waktu', 'status'];
}
