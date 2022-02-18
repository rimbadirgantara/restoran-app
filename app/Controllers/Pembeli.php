<?php

namespace App\Controllers;
use App\Models\MenuModel;

class Pembeli extends BaseController
{	
	public function __construct(){
		$this->MenuModel = new MenuModel;
	}

	public function index()
	{
		$data = [
            'title' => 'ResRim | Pembeli',
            'banner' => 'ResRim',
            'page' => 'Home',
            'sub_page' => 'Dashboard Pembeli',

            'menu' => $this->MenuModel->findAll()
        ];

		return view('pembeli/index', $data);
	}
}