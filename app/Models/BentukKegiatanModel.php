<?php

namespace App\Models;

use CodeIgniter\Model;

class BentukKegiatanModel extends Model
{
    protected $table      = 'my_bentuk_kegiatan';
    protected $primaryKey = 'id_bentuk_kegiatan';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['ket_bentuk', 'bentuk_active'];
}
