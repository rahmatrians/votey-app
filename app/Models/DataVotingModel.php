<?php

namespace App\Models;

use CodeIgniter\Model;

class DataVotingModel extends Model
{
    protected $table = 'data_voting';
    protected $primaryKey = 'id_voting';
    protected $allowedFields = ['id_poll', 'nim', 'date'];
}
