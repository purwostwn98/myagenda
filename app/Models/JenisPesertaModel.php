<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPesertaModel extends Model
{
    protected $table      = 'my_jenis_peserta';
    protected $primaryKey = 'id_jnspeserta';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idpeserta', 'ket_peserta', 'is_active'];
}
