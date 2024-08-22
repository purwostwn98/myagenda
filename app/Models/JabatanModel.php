<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table      = 'my_jabatan';
    protected $primaryKey = 'idjabatan';
    protected $allowedFields = ['kode_jabatan', 'nama_jabatan', 'idlembaga', 'uniid_penjabat', 'nama_penjabat', 'is_delegasi'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
