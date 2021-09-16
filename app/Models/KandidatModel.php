<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
    protected $table = 'kandidat';
    protected $primaryKey = 'id_kandidat';
    protected $allowedFields = ['nama_ketua', 'nama_wakil', 'foto_ketua', 'foto_wakil', 'visi', 'misi', 'program_kerja', 'slogan'];
}
