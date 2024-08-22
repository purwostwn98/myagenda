<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table      = 'my_event';
    protected $primaryKey = 'idevent';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idlembaga', 'idjenis', 'title', 'start', 'end', 'deskripsi', 'link_eksternal', 'peserta', 'created_by', 'prioritas_event', 'tempat_event', 'bentuk_kegiatan'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan($idlembaga, $idjenis, $title, $start, $end, $deskripsi, $link_eksternal, $id_jnspeserta, $created_by, $prioritas_event, $tempat_event, $bentuk_kegiatan)
    {

        $data = [
            "idlembaga" => $idlembaga,
            "idjenis" => $idjenis,
            "title" => $title,
            "start" => $start,
            "end" => $end,
            "deskripsi" => $deskripsi,
            "link_eksternal" => $link_eksternal,
            "peserta" => json_encode($id_jnspeserta),
            "created_by" => $created_by,
            "prioritas_event" => $prioritas_event,
            "tempat_event" => $tempat_event,
            "bentuk_kegiatan" => $bentuk_kegiatan

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

    public function edit($idevent, $idjenis, $title, $start, $end, $deskripsi, $link_eksternal, $id_jnspeserta, $created_by, $prioritas_event, $tempat_event, $bentuk_kegiatan)
    {
        $data = [
            "idjenis" => $idjenis,
            "title" => $title,
            "start" => $start,
            "end" => $end,
            "deskripsi" => $deskripsi,
            "link_eksternal" => $link_eksternal,
            "peserta" => json_encode($id_jnspeserta),
            "created_by" => $created_by,
            "prioritas_event" => $prioritas_event,
            "tempat_event" => $tempat_event,
            "bentuk_kegiatan" => $bentuk_kegiatan
        ];


        $this->transBegin();
        $this->update($idevent, $data);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = 0;
        } else {
            $this->transCommit();
            $msg = $idevent;
        }
        return $msg;
    }
}
