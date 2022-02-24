<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\KasirOrderModel;
use CodeIgniter\HTTP\Request;
use PhpParser\Node\Expr\FuncCall;

class Kasir extends BaseController
{
    public function __construct()
    {
        $this->MenuModel = new MenuModel;
        $this->OrderModel = new OrderModel;
        $this->KasirOrderModel = new KasirOrderModel;
    }

    public function index()
    {
        $data = [
            'title' => 'ResRim | Kasir',
            'banner' => 'ResRim',
            'page' => 'Transaksi',
            'sub_page' => 'Kasir',

            'order' => $this->KasirOrderModel->findAll()
        ];
        return view('kasir/index', $data);
    }
}
