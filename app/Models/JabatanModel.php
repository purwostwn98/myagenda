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

    public function simpan($kode_jabatan, $nama_jabatan, $idlembaga, $uniid_penjabat, $nama_penjabat, $is_delegasi)
    {
        $data = [
            "kode_jabatan" => $kode_jabatan,
            "nama_jabatan" => $nama_jabatan,
            "idlembaga" => $idlembaga,
            "uniid_penjabat" => $uniid_penjabat,
            "nama_penjabat" => $nama_penjabat,
            "is_delegasi" => $is_delegasi
        ];

        $this->transBegin();
        $this->insert($data);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = 0;
        } else {
            $this->transCommit();
            $msg = $this->insertID;
        }
        return $msg;
    }

    public function hapus($idjabatan)
    {
        $this->transBegin();
        $this->delete($idjabatan);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = 0;
        } else {
            $this->transCommit();
            $msg = $idjabatan;
        }
        return $msg;
    }
}
