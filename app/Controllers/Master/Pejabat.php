<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\JabatanModel;

class Pejabat extends BaseController
{
    protected $jabatanModel;
    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function sync()
    {
        $api_response = $this->get_all_jabatan();
        // siapkan array untuk simpan dan update dosen
        $arr_simpan = [];
        $arr_update = [];
        $jml_hapus = 0;
        $jml_simpan = 0;
        if (!empty($api_response["rows"])) {

            // cek data yang sudah tersimpan
            $data_tersimpan = $this->jabatanModel->where("is_delegasi", 0)->findAll();
            $arr_tersimpan = [];
            foreach ($data_tersimpan as $key => $lbg) {
                $arr_tersimpan[$lbg["kode_jabatan"]] = $lbg["idjabatan"];
            }

            $rows = $api_response["rows"];
            $arr_dari_api = [];
            foreach ($rows as $key => $v) {
                if ($v["uniid_penjabat"] != "" || $v["uniid_penjabat"] != null) {
                    $kode_jabatan = $v["kode_lembaga"] . "-" . $v["uniid_penjabat"];
                    $arr_dari_api[$kode_jabatan] = $kode_jabatan;
                    if (!array_key_exists($kode_jabatan, $arr_tersimpan)) {
                        $arr_simpan[$kode_jabatan] = [
                            'kode_jabatan' => $kode_jabatan,
                            'nama_jabatan' => $v["nama"],
                            'idlembaga' => $v["kode_lembaga"],
                            'uniid_penjabat' => $v["uniid_penjabat"],
                            'nama_penjabat' => $v["penjabat"],
                            'is_delegasi' => 0
                        ];
                        $jml_simpan += 1;
                    }
                }
            }

            // Hapus jabatan yang tidak ada dari API
            foreach ($arr_tersimpan as $kode_tabel => $idtabel) {
                if (in_array($kode_tabel, $arr_dari_api)) {
                    continue;
                } else {
                    $this->jabatanModel->delete($idtabel);
                    $jml_hapus += 1;
                }
            }
        }
        // insert batch
        if (!empty($arr_simpan)) {
            $this->jabatanModel->insertBatch($arr_simpan);
        }

        dd("Jumlah simpan " . $jml_simpan . " | " . "Jumlah hapus " . $jml_hapus);
    }

    public function get_all_jabatan()
    {
        $token = get_token_hrd();
        $url = 'v2/jabatan';
        return akses($url, "umar", $token['access']);
    }
}
