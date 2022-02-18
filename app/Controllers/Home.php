<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'ResRim'
        ];
        return view('front_page/index', $data); 
    }
}
