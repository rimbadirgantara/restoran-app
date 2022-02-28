<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\KasirOrderModel;
use App\Models\MenuModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->UserModel = new UserModel;
        $this->OrderModel = new OrderModel;
        $this->KasirOrderModel = new KasirOrderModel;
        $this->MenuModel = new MenuModel;
        $this->urlSegment = \Config\Services::request();
    }
    public function index()
    {
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Dashboard',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'jumlah_semua' => $this->UserModel->where(['level' => 'pembeli'])->countALL(),
            'jumlah_order' => $this->OrderModel->countALL(),
            'profit' => $this->KasirOrderModel->jumlahkan_total_harga()->getResultArray(),
            'jumlah_menu' => $this->MenuModel->countALL()
        ];
        return view('admin/index', $data);
    }
}
