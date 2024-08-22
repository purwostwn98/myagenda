<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'my_user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'nama_gelar', 'last_login', 'homebase_id', 'email'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function simpan(
        $username,
        $password,
        $nama_gelar,
        $last_login,
        $homebase_id,
        $email
    ) {
        $data = [
            'username' => $username,
            'password' => $password,
            'nama_gelar' => $nama_gelar,
            'last_login' => $last_login,
            'homebase_id' => $homebase_id,
            'email' => $email
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

    public function update_last_login($id, $nama, $homebase_id, $last_login)
    {
        $data = [
            "nama_gelar" => $nama,
            "homebase_id" => $homebase_id,
            "last_login" => $last_login
        ];
        $this->transBegin();
        $this->update($id, $data);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = 0;
        } else {
            $this->transCommit();
            $msg = $id;
        }
        return $msg;
    }
}
