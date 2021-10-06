<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'nim';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['nim', 'nama_lengkap', 'id_prodi', 'tgl_lahir', 'password'];
}
