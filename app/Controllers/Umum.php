<?php

namespace App\Controllers;

use App\Models\EventModel;

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
            "#C0C0C0"
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
        // $events = [
        //     [
        //         'title' => 'Evaluasi Semester',
        //         'start' => '2024-07-22',
        //         'end' => '2024-07-24',
        //         'backgroundColor' => '#ff9f00', // Warna latar belakang
        //         'borderColor' => '#ff9f00', // Warna border
        //         'textColor' => '#ffffff' // Warna teks
        //     ],
        //     [
        //         'title' => 'Sosialisasi Akreditasi',
        //         'start' => '2024-07-25',
        //         'end' => '2024-07-26',
        //         'backgroundColor' => '#007bff',
        //         'borderColor' => '#007bff',
        //         'textColor' => '#ffffff'
        //     ]
        // ];

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
}
