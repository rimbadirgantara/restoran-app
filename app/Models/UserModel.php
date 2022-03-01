<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'status_akun', 'level', 'ip'];

    public function search_pembeli($keyword)
    {
        $builder = $this->table('users');
        $builder->like('nama', $keyword);
        // $builder->orLike('username', $keyword);
        return $builder;
    }
}
