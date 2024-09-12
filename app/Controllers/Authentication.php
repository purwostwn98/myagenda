<?php

namespace App\Controllers;

use App\Libraries\Lib_Cas;
use App\Models\JabatanModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Authentication extends BaseController
{
    protected $userModel;
    protected $jabatanModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index(): string
    {
        return view('authentication/login_page');
    }

    public function manual_login()
    {
        if (isset($_POST["ovovuevue"])) {
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("pswd");
            $exad = explode("@", $email);
            $uniid = strtolower($exad[0]);
            # cek username
            $user_intable = $this->userModel->where("username", $uniid)->first();
            if (!empty($user_intable)) {
                #cek password
                if (password_verify($password, $user_intable["password"])) {
                    #update new data from sihrd
                    $data = get_detail_dosen($uniid);
                    if (!empty($data["rows"])) {
                        $data_hrd = $data["rows"];
                        #cek apakah dia punya jabatan
                        $jabatan = $this->jabatanModel->where("uniid_penjabat", $uniid)
                            ->orderBy("idlembaga", "ASC")
                            ->findAll();
                        if (!empty($jabatan)) {
                            $idlembaga = $jabatan[0]["idlembaga"];
                            $nama_jabatan = $jabatan[0]["nama_jabatan"];
                            $jabatan = 1;
                        } else {
                            $idlembaga = $data_hrd['home_id'];
                            $nama_jabatan = "-";
                            $jabatan = 0;
                        }
                        $username = $uniid;
                        $password_simpan = password_hash("bpp@2024", PASSWORD_DEFAULT);
                        $nama_gelar = $data_hrd["nama"];

                        // generate session
                        // $data_session = [
                        //     "login" => true,
                        //     "uniid" => $uniid,
                        //     "nama_gelar" => $nama_gelar,
                        //     "jabatan" => $jabatan,
                        //     "idlembaga" => $idlembaga,
                        //     "nama_jabatan" => $nama_jabatan
                        // ];

                        // $_SESSION['userdata'] =  $data_session;

                        //  redirect()->to('/kepala/dashboard');
                        return $this->generate_session_login($uniid, $nama_gelar, $jabatan, $idlembaga, $nama_jabatan);
                    } elseif ($user_intable["username"] == "ums") {
                        #cek apakah dia punya jabatan
                        $jabatan = $this->jabatanModel->where("uniid_penjabat", $uniid)
                            ->orderBy("idlembaga", "ASC")
                            ->findAll();
                        if (!empty($jabatan)) {
                            $idlembaga = $jabatan[0]["idlembaga"];
                            $nama_jabatan = $jabatan[0]["nama_jabatan"];
                            $jabatan = 1;
                        } else {
                            $idlembaga = "lmbg1001";
                            $nama_jabatan = "-";
                            $jabatan = 0;
                        }
                        $username = $uniid;
                        $password_simpan = password_hash("bpp@2024", PASSWORD_DEFAULT);
                        $nama_gelar = "Universitas Muhammadiyah Surakarta";

                        // generate session
                        // $data_session = [
                        //     "login" => true,
                        //     "uniid" => $uniid,
                        //     "nama_gelar" => $nama_gelar,
                        //     "jabatan" => $jabatan,
                        //     "idlembaga" => $idlembaga,
                        //     "nama_jabatan" => $nama_jabatan
                        // ];

                        // $_SESSION['userdata'] =  $data_session;

                        //  redirect()->to('/kepala/dashboard');
                        return $this->generate_session_login($uniid, $nama_gelar, $jabatan, $idlembaga, $nama_jabatan);
                    } else {
                        exit("Anda tidak terdaftar di sistem UMS");
                    }
                } else {
                    exit("Password Anda salah");
                }
            } else {
                exit("username tidak ditemukan :(");
            }
        }
    }

    public function login_cas()
    {
        $cas = new Lib_Cas;
        $cas->forceAuth();
        $user = $cas->user();

        $timeNow = Time::now('Asia/Jakarta', 'en_US');
        $kode_sync = $timeNow->getTimestamp();

        if ($user) {
            $uniid = $user->userlogin;
            $fullname = $user->attributes['full_name'];

            // jika mahasiswa
            if (strlen($uniid) == 10) {
                //ambil data mahasiswa dari akademik
                $data_mahasiswa = akademik_profil_mhs($uniid);
                if (!empty($data_mahasiswa["success"]) && $data_mahasiswa["success"] == "true") {
                    $nim = strtolower($data_mahasiswa["NIM"]);
                    $nama = $data_mahasiswa["Nama"];
                    $idlembaga = $data_mahasiswa["kedelembaga"];
                    $jabatan = 0;
                    $nama_jabatan = "Mahasiswa";

                    // cek apakah data mahasiswa sudah tersimpan di user table
                    $row_user = $this->userModel->where("username", $nama)->first();
                    if (empty($row_user)) {
                        $password = password_hash("bpp@2024", PASSWORD_DEFAULT);
                        $this->userModel->simpan($nim, $password, $nama, $timeNow, $idlembaga, $nim . "@student.ums.ac.id");
                    } else {
                        $this->userModel->update_last_login($row_user["id"], $nama, $idlembaga, $timeNow);
                    }

                    // generate session
                    return $this->generate_session_login($nim, $nama, $jabatan, $idlembaga, $nama_jabatan);
                } else {
                    exit("Data mahasiswa tidak ada di data akademik");
                }
            } else {
                // ambil data dari hrd pegawai
                $data_pegawai = get_detail_dosen($uniid);
                if (!empty($data_pegawai["rows"]) && $data_pegawai["success"] == true) {
                    $pegawai = $data_pegawai["rows"];
                    $uniid = $uniid;
                    $nama = $pegawai["nama"];

                    // cek apakah punya jabatan
                    $jabatan = $this->jabatanModel->where("uniid_penjabat", $uniid)
                        ->orderBy("idlembaga", "ASC")
                        ->findAll();
                    if (!empty($jabatan)) {
                        $idlembaga = $jabatan[0]["idlembaga"];
                        $nama_jabatan = $jabatan[0]["nama_jabatan"];
                        $jabatan = 1;
                    } else {
                        $idlembaga = $pegawai['home_id'];
                        $nama_jabatan = "-";
                        $jabatan = 0;
                    }

                    // cek apakah data mahasiswa sudah tersimpan di user table
                    $row_user = $this->userModel->where("username", $uniid)->first();
                    if (empty($row_user)) {
                        $password = password_hash("bpp@2024", PASSWORD_DEFAULT);
                        $this->userModel->simpan($uniid, $password, $nama, $timeNow, $idlembaga, $uniid . "@ums.ac.id");
                    } else {
                        $this->userModel->update_last_login($row_user["id"], $nama, $idlembaga, $timeNow);
                    }

                    //generate session
                    return $this->generate_session_login($uniid, $nama, $jabatan, $idlembaga, $nama_jabatan);
                } else {
                    exit("Bukan pegawai ums");
                }
            }
        }
    }

    public function generate_session_login($uniid, $nama_gelar, $jabatan, $idlembaga, $nama_jabatan)
    {
        $data_session = [
            "login" => true,
            "uniid" => $uniid,
            "nama_gelar" => $nama_gelar,
            "jabatan" => $jabatan,
            "idlembaga" => $idlembaga,
            "nama_jabatan" => $nama_jabatan
        ];

        $_SESSION['userdata'] =  $data_session;

        return redirect()->to('/kepala/dashboard');

        // if ($level == "mahasiswa") {
        //     return redirect()->to('/mahasiswa/dashboard');
        // } elseif ($level == "panitia") {
        //     return redirect()->to('/panitia/dashboard');
        // } elseif ($level == "superadmin") {
        //     return redirect()->to('/superadmin/dashboard');
        // }
    }

    public function logout_app()
    {
        $cas = new Lib_Cas;
        $cas->keluar();
        $this->session->destroy();
        return redirect()->to('/');
    }
}
