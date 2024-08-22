<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table      = 'my_unit';
    protected $primaryKey = 'idunit';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idlembaga', 'nama_lembaga', 'type', 'nama_singkat', 'kepentingan'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

class JenisUnitModel extends Model
{
    protected $table      = 'my_jenis_unit';
    protected $primaryKey = 'id_jenis_unit';
    protected $useAutoIncrement = true;
}
