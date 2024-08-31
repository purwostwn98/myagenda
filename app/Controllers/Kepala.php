<?php

namespace App\Controllers;

use App\Models\BentukKegiatanModel;
use App\Models\EventModel;
use App\Models\JenisModel;
use App\Models\JenisPesertaModel;
use App\Models\JenisUnitModel;
use App\Models\UnitModel;
use CodeIgniter\I18n\Time;

class Kepala extends BaseController
{
    protected $eventModel;
    protected $jenisPesertaModel;
    protected $unitModel;
    protected $jenisEventModel;
    protected $jenisUnitModel;
    protected $bentukKegiatanModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->jenisPesertaModel = new JenisPesertaModel();
        $this->unitModel = new UnitModel();
        $this->jenisEventModel = new JenisModel();
        $this->jenisUnitModel = new JenisUnitModel();
        $this->bentukKegiatanModel = new BentukKegiatanModel();
    }

    public function index(): string
    {
        $data = [
            "menu" => "Dashboard"
        ];

        return view('umum/index', $data);
    }

    // ini digunakan untuk dashborad secara umum - meskipun di kepala
    public function dashboard(): string
    {
        $idlembaga = $this->session->get("userdata")["idlembaga"];
        $row_lembaga = $this->unitModel->where("idlembaga", $idlembaga)->first();
        $all_lembaga = $this->unitModel->where("type", $row_lembaga["type"])->select("idlembaga, nama_lembaga")->findAll();
        $jenis_unit = $this->jenisUnitModel->findAll();
        $datetimeNow = Time::now("Asia/Jakarta");


        $data = [
            "menu" => "Dashboard",
            "jenis_unit" => $jenis_unit,
            "row_lembaga" => $row_lembaga,
            "all_lembaga" => $all_lembaga,
            "idlembaga_user" => $idlembaga,
            "jenis_agenda" => $this->jenisEventModel->findAll(),
            "hari_tanggal" => datetimeToBahasa($datetimeNow)
        ];

        return view('kepala/dashboard', $data);
    }

    public function do_tambah_agenda()
    {
        if ($this->request->isAJAX()) {
            $title = $this->request->getPost("title");
            $start = $this->request->getPost("start");
            $end = $this->request->getPost("end");
            $idlembaga = $this->request->getPost("idlembaga");
            $idjenisevent = $this->request->getPost("idjenis");
            $deskripsi = $this->request->getPost("deskripsi");
            $link_eksternal = $this->request->getPost("link_eksternal");
            $id_jnspeserta = $this->request->getPost("id_jnspeserta");
            $created_by = $this->session->get("userdata")["uniid"];
            $prioritas_event = $this->request->getPost("prioritas_event");
            $tempat_event = $this->request->getPost("tempat_event");
            $bentuk_kegiatan = $this->request->getPost("bentuk_kegiatan");

            $query = $this->eventModel->simpan($idlembaga, $idjenisevent, $title, $start, $end, $deskripsi, $link_eksternal, $id_jnspeserta, $created_by, $prioritas_event, $tempat_event, $bentuk_kegiatan);
            if ($query != 0) {
                $msg = [
                    "status" => true,
                    "pesan" => "Agenda berhasil disimpan"
                ];
            } else {
                $msg = [
                    "status" => false,
                    "pesan" => "Agenda gagal disimpan"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Mohon maaf, tidak dapat diproses');
        }
    }

    public function do_edit_agenda()
    {
        if ($this->request->isAJAX()) {
            $idevent = $this->request->getPost("idevent");
            $title = $this->request->getPost("title");
            $start = $this->request->getPost("start");
            $end = $this->request->getPost("end");
            $idjenisevent = $this->request->getPost("idjenis");
            $deskripsi = $this->request->getPost("deskripsi");
            $link_eksternal = $this->request->getPost("link_eksternal");
            $id_jnspeserta = $this->request->getPost("id_jnspeserta");
            $created_by = $this->session->get("userdata")["uniid"];
            $prioritas_event = $this->request->getPost("prioritas_event");
            $tempat_event = $this->request->getPost("tempat_event");
            $bentuk_kegiatan = $this->request->getPost("bentuk_kegiatan");

            $query = $this->eventModel->edit($idevent, $idjenisevent, $title, $start, $end, $deskripsi, $link_eksternal, $id_jnspeserta, $created_by, $prioritas_event, $tempat_event, $bentuk_kegiatan);
            if ($query != 0) {
                $msg = [
                    "status" => true,
                    "pesan" => "Agenda berhasil disimpan"
                ];
            } else {
                $msg = [
                    "status" => false,
                    "pesan" => "Agenda gagal disimpan"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Mohon maaf, tidak dapat diproses');
        }
    }
    //dinamis
    public function modal_tambah_agenda()
    {
        $datatampil = [
            "units" => $this->unitModel->findAll(),
            "lembaga_user" => $this->unitModel->where("idlembaga", $_SESSION["userdata"]["idlembaga"])->first(),
            "jenis_event" => $this->jenisEventModel->findAll(),
            "jenis_peserta" => $this->jenisPesertaModel->findAll(),
            "bentuk_kegiatan" => $this->bentukKegiatanModel->where("bentuk_active", 1)->findAll()
        ];
        $data = [
            'modal' => view("kepala/modal/tambah_agenda", $datatampil)
        ];
        echo json_encode($data);
    }

    public function modal_edit_agenda()
    {
        $idevent = $this->request->getPost();
        $event = $this->eventModel->where("idevent", $idevent)->first();
        $datatampil = [
            "units" => $this->unitModel->findAll(),
            "jenis_event" => $this->jenisEventModel->findAll(),
            "jenis_peserta" => $this->jenisPesertaModel->findAll(),
            "bentuk_kegiatan" => $this->bentukKegiatanModel->where("bentuk_active", 1)->findAll(),
            "event" => $event,
            "peserta" => json_decode($event["peserta"])
        ];
        $data = [
            'modal' => view("kepala/modal/edit_agenda", $datatampil)
        ];
        echo json_encode($data);
    }

    public function modal_view_agenda()
    {
        $id = $this->request->getPost("id");
        $event = $this->eventModel->where("idevent", $id)
            ->join("my_unit", "my_event.idlembaga = my_unit.idlembaga")
            ->join("my_jenis_event as jenis", "my_event.idjenis = jenis.idjenis", "LEFT")
            ->join("my_bentuk_kegiatan as bentuk", "my_event.bentuk_kegiatan = bentuk.id_bentuk_kegiatan", "LEFT")
            ->join("my_user as user", "my_event.created_by = user.username", "LEFT")
            ->select("idevent, title, start, end, created_by, nama_lembaga, ket_jenis, deskripsi, link_eksternal, nama_gelar, prioritas_event, peserta, ket_bentuk, tempat_event, my_event.idlembaga")
            ->first();

        $peserta = json_decode($event["peserta"]);
        if (empty($peserta)) {
            $peserta = ["0"];
        }
        $jenis_peserta = $this->jenisPesertaModel->whereIn("id_jnspeserta", $peserta)->select("ket_peserta")->findAll();

        $datatampil = [
            "event" => $event,
            "tgl_mulai" => convertToIndonesianTime($event["start"]),
            "tgl_selesai" => convertToIndonesianTime($event["end"]),
            "peserta" => json_decode($event["peserta"]),
            "jenis_peserta" => $jenis_peserta,
            "idlembaga_user" => $this->session->get("userdata")["idlembaga"],
            "jabatan" => $this->session->get("userdata")["jabatan"]
        ];
        $data = [
            'modal' => view("kepala/modal/view_agenda", $datatampil)
        ];
        echo json_encode($data);
    }

    function do_hapus_agenda()
    {
        if ($this->request->isAJAX()) {
            $idevent = $this->request->getPost("id");
            $hapus = $this->eventModel->hapus($idevent);
            if ($hapus == 1) {
                $data = [
                    "success" => true,
                    "pesan" => "Agenda terhapus... "
                ];
            } else {
                $data = [
                    "success" => true,
                    "pesan" => "Gagal menghapus ..."
                ];
            }
            echo json_encode($data);
        } else {
            exit("Ovovyepjed");
        }
    }
}
