<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'my_pegawai';
    protected $primaryKey = 'uniid';
    protected $allowedFields = ['uniid', 'iddsn_akademik', 'nidn', 'nama', 'email', 'is_dosen', 'from_api'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
