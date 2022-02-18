<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{

	protected $table = 'users';
	protected $useTimestamps = true;

	public function cek_login_dengan_username($username){
		return $this->where(['username' => $username])->first();
	}
}