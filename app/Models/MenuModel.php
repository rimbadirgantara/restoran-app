<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

	protected $table = 'menu';
	protected $useTimestamps = true;

	public function ambil_data_dengan_slug($slug_makanan)
	{
		return $this->where(['slug' => $slug_makanan])->first();
	}
}
