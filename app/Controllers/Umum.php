<?php

namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\I18n\Time;

class Umum extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index(): string
    {
        $data = [
            "menu" => "Dashboard"
        ];

        return view('umum/index', $data);
    }

    public function dinamis_load_events()
    {

        //get parameter filter
        $type = $this->request->getPost("type");
        $unit = $this->request->getPost("unit"); // atau lembaga
        $jenis_agenda = $this->request->getPost("jenis_agenda");
        $prioritas_agenda = $this->request->getPost("prioritas_agenda");
        $bentuk_agenda = $this->request->getPost("bentuk_agenda");

        $where = [];
        if ($type != "all") {
            $where["type"] = $type;
        }
        if ($unit != "all") {
            $where["my_event.idlembaga"] = $unit;
        }
        if ($jenis_agenda != "all") {
            $where["idjenis"] = $jenis_agenda;
        }
        if ($prioritas_agenda != "all") {
            $where["prioritas_event"] = $prioritas_agenda;
        }
        if ($bentuk_agenda != "all") {
            $where["bentuk_kegiatan"] = $bentuk_agenda;
        }

        // print_r($where);
        // exit;

        $warna = [
            "#FF0000",
            "#00FF00",
            "#808000",
            "#800080",
            "#008080",
            "#C0C0C0",
            "#808080",
            "#FF6347",
            "#0000FF",
            "#F0E68C",
            "#DEB887",
            "#FFFFE0",
            "#FFFF00",
            "#2f3184",
            "#FF00FF",
            "#00FFFF",
            "#800000",
            "#008000",
            "#000080",
            "#FF4500",
            "#FFD700",
            "#ADFF2F",
            "#FF69B4",
            "#4B0082",
            "#800000",
            "#FFA500",
            "#FF1493",
            "#7FFF00",
            "#D2691E",
            "#FF7F50",
            "#6495ED",
            "#FFF5EE",
            "#FFDAB9",
            "#F0E68C",
            "#E6E6FA",
            "#D3D3D3",
            "#FFF0F5",
            "#FFB6C1",
            "#FFC0CB",
            "#DDA0DD",
            "#EE82EE",
            "#FF00FF",
            "#BA55D3",
            "#9370DB",
            "#8A2BE2",
            "#A52A2A",
            "#B22222",
            "#FF0000",
            "#DC143C",
            "#FF4500",
            "#D2691E",
            "#CD5C5C",
            "#F08080",
            "#E9967A",
            "#FA8072",
            "#F4A460",
            "#D2B48C",
            "#FFFF00",
            "#F5DEB3",
            "#FFE4C4",
            "#FFDAB9",
            "#FFE4E1",
            "#FFEBCD",
            "#F5F5DC",
            "#F5F5F5",
            "#DCDCDC",
            "#C0C0C0",
            "#A9A9A9",
            "#808080",
            "#696969",
            "#2F4F4F",
            "#228B22",
            "#008080",
            "#00CED1",
            "#20B2AA",
            "#48D1CC",
            "#00FA9A",
            "#00FF7F",
            "#3CB371",
            "#2E8B57",
            "#228B22",
            "#6B8E23",
            "#9ACD32",
            "#BDB76B",
            "#F0E68C",
            "#FFFF00",
            "#FFFFE0",
            "#YELLOW",
            "#YELLOWGREEN",
            "#7CFC00",
            "#7FFF00",
            "#ADFF2F",
            "#32CD32",
            "#228B22",
            "#00FF00",
            "#008000",
            "#006400",
            "#2E8B57",
            "#3CB371",
            "#20B2AA",
            "#00FA9A",
            "#00FF7F",
            "#2E8B57",
            "#3CB371",
            "#9ACD32",
            "#6B8E23",
            "#BDB76B",
            "#C0C0C0",
            "#FF0000",
            "#00FF00",
            "#808000",
            "#800080",
            "#008080",
            "#C0C0C0",
            "#808080",
            "#FF6347",
            "#0000FF",
            "#F0E68C",
            "#DEB887",
            "#FFFFE0",
            "#2f3184",
            "#FFFF00",
            "#FF00FF",
            "#00FFFF",
            "#800000",
        ];

        $saved_event = $this->eventModel->join("my_unit as unit", "my_event.idlembaga = unit.idlembaga")
            ->where($where)
            ->orderBy("unit.kepentingan, prioritas_event", "ASC")
            ->findAll();

        $events = [];
        foreach ($saved_event as $key => $v) {
            $events[]  = array(
                'id' => $v["idevent"],
                'title' => $v["nama_singkat"] . " | " . $v["title"],
                'start' => $v["start"],
                'end' => $v["end"],
                'backgroundColor' => $warna[$v["idunit"]], // Warna latar belakang
                'borderColor' => $warna[$v["idunit"]], // Warna border
                'textColor' => '#ffffff' // Warna teks
            );
        }

        $data = [
            'events' => $events
        ];

        echo json_encode($data);
    }

    public function dashboard_jenis_unit_change()
    {
        if ($this->request->isAJAX()) {
            $type = $this->request->getPost("type");
            if ($type != "all") {
                $lembaga_type = $this->unitModel->where("type", $type)->findAll();
            } else {
                $lembaga_type = $this->unitModel->findAll();
            }

            $opt = '<option value="all">Semua Unit</option>';
            foreach ($lembaga_type as $key => $v) {
                $opt .= '<option value="' . $v["idlembaga"] . '">' . $v["nama_lembaga"] . '</option>';
            }
            $msg = [
                "opt" => $opt
            ];
            echo json_encode($msg);
        } else {
            exit("Salah alamat");
        }
    }

    public function v_daftar_agenda()
    {
        $timeNow = Time::now();
        $next30Days = Time::now()->addDays(30);

        // $event = $this->eventModel->where("my_event.idlembaga", $this->session->get("userdata")["idlembaga"])
        //     // ->where(["start >=" => $timeNow->toDateString(), "start <=" => $next30Days->toDateString()])
        //     ->where(["end >=" => $timeNow->toDateString(), "end <=" => $next30Days->toDateString()])
        //     ->join("my_unit", "my_event.idlembaga = my_unit.idlembaga")
        //     ->join("my_jenis_event as jenis", "my_event.idjenis = jenis.idjenis", "LEFT")
        //     ->join("my_bentuk_kegiatan as bentuk", "my_event.bentuk_kegiatan = bentuk.id_bentuk_kegiatan", "LEFT")
        //     ->select("idevent, title, start, end, ket_jenis, ket_bentuk, tempat_event, my_event.idlembaga")
        //     ->orderBy("start", "ASC")
        //     ->findAll();

        // $arr_agenda = [];
        // foreach ($event as $k => $e) {
        //     $arr_agenda[] = [
        //         "title" => $e["title"],
        //         "tempat_event" => $e["tempat_event"],
        //         "start" => datetimeToBahasa($e["start"]),
        //         "end" => datetimeToBahasa($e["end"]),
        //         "ket_jenis" => $e["ket_jenis"],
        //         "ket_bentuk" => $e["ket_bentuk"],
        //     ];
        // }

        $idlembaga_user = $this->session->get("userdata")["idlembaga"];
        $lembaga = $this->unitModel->where("idlembaga", $idlembaga_user)->first();
        // $peserta = json_decode($event["peserta"]);
        // $jenis_peserta = $this->jenisPesertaModel->whereIn("id_jnspeserta", $peserta)->select("ket_peserta")->findAll();

        $datatampil = [
            "menu" => "Daftar-Agenda",
            // "event" => $arr_agenda,
            "lembaga_user" => $lembaga,
            "jabatan" => $this->session->get("userdata")["jabatan"]
        ];

        return view('umum/daftar_agenda', $datatampil);
    }

    public function tr_agenda_unit()
    {
        $range = $this->request->getPost("range");
        $timeNow = Time::now();
        $nextDays = Time::now()->addDays($range);

        $event = $this->eventModel->where("my_event.idlembaga", $this->session->get("userdata")["idlembaga"])
            // ->where(["start >=" => $timeNow->toDateString(), "start <=" => $next30Days->toDateString()])
            ->where(["end >=" => $timeNow->toDateString(), "end <=" => $nextDays->toDateString()])
            ->join("my_unit", "my_event.idlembaga = my_unit.idlembaga")
            ->join("my_jenis_event as jenis", "my_event.idjenis = jenis.idjenis", "LEFT")
            ->join("my_bentuk_kegiatan as bentuk", "my_event.bentuk_kegiatan = bentuk.id_bentuk_kegiatan", "LEFT")
            ->select("idevent, title, start, end, ket_jenis, ket_bentuk, tempat_event, my_event.idlembaga")
            ->orderBy("start", "ASC")
            ->findAll();

        if (empty($event)) {
            $tr = '<tr><td colspan="7">Agenda ' . $range . ' hari yang akan datang tidak ditemukan</td></tr>';
        } else {
            $tr = "";
            foreach ($event as $k => $e) {
                $tr .=  '<tr>
                        <td>' . $k + 1 . '</td>
                        <td>' . datetimeToBahasa($e["start"]) . '</td>
                        <td>' . datetimeToBahasa($e["end"]) . '</td>
                        <td>' . $e["title"] . '</td>
                        <td>' . $e["tempat_event"] . '</td>
                        <td>' . $e["ket_jenis"] . '</td>
                        <td>' . $e["ket_bentuk"] . '</td>
                    </tr>';
            }
        }

        $datatampil = [
            "tr" => $tr
        ];
        echo json_encode($datatampil);
    }

    public function v_cari_agenda_ums()
    {
        $timeNow = Time::now();
        $next30Days = Time::now()->addDays(30);

        $idlembaga_user = $this->session->get("userdata")["idlembaga"];
        $lembaga = $this->unitModel->where("idlembaga", $idlembaga_user)->first();

        $datatampil = [
            "menu" => "cari-agenda",
            "lembaga_user" => $lembaga,
            "jabatan" => $this->session->get("userdata")["jabatan"]
        ];

        return view('umum/cari_agenda_ums', $datatampil);
    }

    //dinamis
    public function load_hasil_cari_agendaums()
    {
        $title = $this->request->getPost("key");
        $waktu = $this->request->getPost("waktu");
        $timeNow = Time::now();

        if ($title == "") {
            $where = [];
            $data["status"] = false;
        } else {
            if ($waktu == 1) {
                $where = ["start >=" => $timeNow->toDateString()];
            } else {
                $where = ["start <=" => $timeNow->toDateString()];
            }
        }

        $results = $this->eventModel
            ->like('title', strval($title))
            ->where($where)
            ->join("my_unit", "my_event.idlembaga = my_unit.idlembaga")
            ->join("my_jenis_event as jenis", "my_event.idjenis = jenis.idjenis", "LEFT")
            ->join("my_bentuk_kegiatan as bentuk", "my_event.bentuk_kegiatan = bentuk.id_bentuk_kegiatan", "LEFT")
            ->select("idevent, title, start, end, ket_jenis, ket_bentuk, tempat_event, my_event.idlembaga, nama_lembaga, nama_singkat")
            ->orderBy("start", "ASC")
            ->findAll();

        $arr_agenda = [];
        foreach ($results as $k => $e) {
            $arr_agenda[] = [
                "title" => $e["title"],
                "tempat_event" => $e["tempat_event"],
                "start" => datetimeToBahasa($e["start"]),
                "end" => datetimeToBahasa($e["end"]),
                "ket_jenis" => $e["ket_jenis"],
                "ket_bentuk" => $e["ket_bentuk"],
                "idevent" => $e["idevent"],
                "nama_lembaga" => $e["nama_lembaga"],
                "nama_singkat" => $e["nama_singkat"]
            ];
        }

        $datatampil = [
            "results" => $arr_agenda
        ];
        $data = [
            'view' => view("umum/dinamis/hasil_pencarian_agenda", $datatampil)
        ];
        echo json_encode($data);
    }
}
