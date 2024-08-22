<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table      = 'my_jenis_event';
    protected $primaryKey = 'idjenis';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idjenis', 'ket_jenis'];
}
