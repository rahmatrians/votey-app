<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nama_lengkap', 'email', 'username', 'password', 'activate_code', 'last_login', 'email_active_status'];
}
