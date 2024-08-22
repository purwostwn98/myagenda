<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;

class Dosen extends BaseController
{
    protected $pegawaiModel;
    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function sync()
    {
        $dosen_akademik = $this->get_all_dosen();
        // siapkan array untuk simpan dan update dosen
        $arr_simpan_dosen = [];
        $arr_update_dosen = [];
        $jml_update = 0;
        $jml_simpan = 0;
        if (!empty($dosen_akademik["rows"])) {
            // cek dosen tersimpan
            $all_dosen_tersimpan = $this->pegawaiModel->where(["from_api" => 1, "is_dosen" => 1])->findAll();
            $arr_dosen_tersimpan = [];
            foreach ($all_dosen_tersimpan as $d => $dsn) {
                $arr_dosen_tersimpan[$dsn["uniid"]] = $dsn["nama"];
            }

            // data dosen dari akademik
            $all_dosen = $dosen_akademik["rows"];
            foreach ($all_dosen as $key => $api) {
                if (array_key_exists($api["uniid"], $arr_dosen_tersimpan)) {
                    if ($arr_dosen_tersimpan[$api["uniid"]] != $api["nama"]) {
                        $arr_update_dosen[$api["uniid"]] = [
                            "uniid" => $api["uniid"],
                            "iddsn_akademik" => $api["iddsn"],
                            "nidn" => $api["nidn"],
                            "nama" => $api["nama"],
                            "email" => $api["email"],
                            "is_dosen" => 1,
                            "from_api" => 1
                        ];
                        $jml_update += 1;
                    } else {
                        continue;
                    }
                } else {
                    $arr_simpan_dosen[$api["uniid"]] = [
                        "uniid" => $api["uniid"],
                        "iddsn_akademik" => $api["iddsn"],
                        "nidn" => $api["nidn"],
                        "nama" => $api["nama"],
                        "email" => $api["email"],
                        "is_dosen" => 1,
                        "from_api" => 1
                    ];
                    $jml_simpan += 1;
                }
            }
        }

        //update batch
        if (!empty($arr_update_dosen)) {
            $this->pegawaiModel->updateBatch($arr_update_dosen, "uniid");
        }
        // insert batch
        if (!empty($arr_simpan_dosen)) {
            $this->pegawaiModel->insertBatch($arr_simpan_dosen);
        }

        dd("Jumlah simpan " . $jml_simpan . " | " . "Jumlah update " . $jml_update);
    }

    public function get_all_dosen()
    {
        $token = token_star();
        $body = array('act' => 'ListDosen', 'token' => $token);
        return masuk_api($body);
    }
}
