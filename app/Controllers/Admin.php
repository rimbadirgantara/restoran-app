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

    public function member()
    {
        $current_page = $this->request->getVar('page_pembeli') ? $this->request->getVar('page_pembeli') : 1;
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Member',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'current_page' => $current_page,
            'pembeli' => $this->UserModel->where(['level' => 'pembeli'])->paginate(5, 'pembeli'),
            'pembeli_pager' => $this->UserModel->pager,
        ];
        return view('admin/member/index', $data);
    }

    public function hapus_member($id)
    {
        $id = base64_decode($id);
        $this->UserModel->delete($id);
        session()->setFlashdata('berhasil_hapus_user', 'Berhasil Menghapus User');
        return redirect()->to(base_url('/member'));
    }

    public function edit_member($id)
    {
        $id = base64_decode($id);
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Member',
            'sub_page' => 'Info Pembeli',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'pembeli' => $this->UserModel->where(['id' => $id])->first()
        ];

        return view('admin/member/form_edit_user', $data);
    }
}
