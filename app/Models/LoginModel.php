<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{

	protected $table = 'users';
	protected $useTimestamps = true;
	protected $allowedFields = ['status'];

	public function cek_login_dengan_username($username)
	{
		return $this->where(['username' => $username])->first();
	}

	public function edit_status_akun($username, $stat)
	{
		if ($stat === 'online') {
			$this->set('status', 'online');
			$this->where('username', $username);
			$this->update();
		} elseif ($stat === 'offline') {
			$this->set('status', 'offline');
			$this->where('username', $username);
			$this->update();
		}
	}
}
