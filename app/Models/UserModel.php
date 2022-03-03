<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'status_akun', 'level', 'ip', 'password', 'status'];

    public function search_pembeli($keyword)
    {
        $builder = $this->table('users');
        $builder->where(['level' => 'pembeli']);
        $builder->like('nama', $keyword);
        return $builder;
    }

    public function search_kasir($keyword)
    {
        $builder = $this->table('users');
        $builder->where(['level' => 'kasir']);
        $builder->like('nama', $keyword);
        return $builder;
    }
}
