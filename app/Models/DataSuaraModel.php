<?php

namespace App\Models;

use CodeIgniter\Model;

class DataSuaraModel extends Model
{
    protected $table = 'data_suara';
    protected $primaryKey = 'id_suara';
    protected $allowedFields = ['id_kandidat'];
}
