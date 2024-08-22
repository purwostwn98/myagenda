<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\UnitModel;

class Unit extends BaseController
{
    protected $unitModel;
    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function sync()
    {
        $lembagaapi = $this->get_all_lembaga();
        // siapkan array untuk simpan dan update dosen
        $arr_simpan = [];
        $arr_update = [];
        $jml_update = 0;
        $jml_simpan = 0;
        if (!empty($lembagaapi["rows"])) {

            // cek data yang sudah tersimpan
            $data_lembaga_tersimpan = $this->unitModel->findAll();
            $arr_lembaga_tersimpan = [];
            foreach ($data_lembaga_tersimpan as $key => $lbg) {
                $arr_lembaga_tersimpan[$lbg["idlembaga"]] = array(
                    "nama" =>  $lbg["nama_lembaga"],
                    "kepentingan" => $lbg["kepentingan"]
                );
            }

            $lembaga = $lembagaapi["rows"];
            foreach ($lembaga as $key => $v) {
                if (array_key_exists($v["uniid"], $arr_lembaga_tersimpan)) {
                    if ($arr_lembaga_tersimpan[$v["uniid"]]["nama"] != $v["nama"]) {
                        $arr_update[$v["uniid"]] = [
                            'idlembaga' => $v["uniid"],
                            'nama_lembaga' => $v["nama"],
                            'type' => $v["jenis_id"],
                            'nama_singkat' => $v["namasingkat"],
                            'kepentingan' => $arr_lembaga_tersimpan[$v["uniid"]]["kepentingan"]
                        ];
                        $jml_update += 1;
                    } else {
                        continue;
                    }
                } else {
                    // buat variable kepentingan dulu
                    $type = $v["jenis_id"];
                    if ($type == 5) {
                        $kepentingan = 1;
                    } elseif ($type == 4) {
                        $kepentingan = 2;
                    } elseif ($type == 3) {
                        $kepentingan = 3;
                    } elseif ($type == 2) {
                        $kepentingan = 4;
                    } elseif ($type == 1) {
                        $kepentingan = 5;
                    } else {
                        $kepentingan = 10;
                    }

                    $arr_simpan[$v["uniid"]] = [
                        'idlembaga' => $v["uniid"],
                        'nama_lembaga' => $v["nama"],
                        'type' => $v["jenis_id"],
                        'nama_singkat' => $v["namasingkat"],
                        'kepentingan' => $kepentingan
                    ];
                    $jml_simpan += 1;
                }
            }
        }
        //update batch
        if (!empty($arr_update)) {
            $this->unitModel->updateBatch($arr_update, "idlembaga");
        }
        // insert batch
        if (!empty($arr_simpan)) {
            $this->unitModel->insertBatch($arr_simpan);
        }

        dd("Jumlah simpan " . $jml_simpan . " | " . "Jumlah update " . $jml_update);
    }

    public function get_all_lembaga()
    {
        $token = get_token_hrd();
        $url = 'v1/lembaga';
        return akses($url, "kurikulum_api", $token['access']);
    }
}
