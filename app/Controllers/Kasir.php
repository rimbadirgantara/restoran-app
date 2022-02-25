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
            'page' => 'Kasir',
            'sub_page' => 'Transaksi',

            'order' => $this->KasirOrderModel->where(['status' => 'Belum bayar'])->findAll(),
            'order_sudah' => $this->KasirOrderModel->where(['status' => 'Sudah bayar'])->findAll()
        ];
        return view('kasir/index', $data);
    }

    public function info_bill_pembeli($username)
    {
        $username = base64_decode($username);
        $data = [
            'title' => 'ResRim | Kasir',
            'banner' => 'ResRim',
            'page' => 'Kasir',
            'sub_page' => 'Transaksi',

            'order' => $this->OrderModel->ambil_data_dengan_username($username),
            'data_harga' => $this->OrderModel->jumlahkan_total_harga($username),
            'validation' => \Config\Services::validation()
        ];
        return view('kasir/info-bill-pembeli', $data);
    }

    public function hapus_data_karsir_order($id, $username)
    {
        $id = base64_decode($id);
        $username = base64_decode($username);
        // hapus data di tabel kasir order
        $this->KasirOrderModel->delete($id);
        return redirect()->to(base_url('/k'));
    }

    public function pembayaran_bill($username)
    {
        $rules = [
            'nomimal_pembayaran' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Isi nominal pembayaran!',
                    'numeric' => 'Hanya menerima angka!'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/k/' . $username . '/info-bill-pembeli'))->withInput()->with('validation', $validation);
        }
        $username = htmlspecialchars(base64_decode($username));
        $total_harga = htmlspecialchars($this->request->getVar('total_harga'));
        $nomimal_pembayaran = htmlspecialchars($this->request->getVar('nomimal_pembayaran'));
        $kembalian = $nomimal_pembayaran - $total_harga;

        // if ($nomimal_pembayaran < $total_harga) {
        //     echo "
        //         <script>
        //             alert('Nominal tidak memcukupi!');
        //         </script>
        //     ";
        //     return redirect()->to(base_url('/k/' . $username . '/info-bill-pembeli'));
        // }

        $data = [
            'pemesan' => $username,
            'uang_bayar' => $nomimal_pembayaran,
            'uang_kembalian' => $kembalian,
            'waktu_bayar' => time(),
            'kasir' => session()->get('username'),
            'status' => 'Sudah Bayar'
        ];
        $this->KasirOrderModel->update_data_pembeli($data);
        $this->OrderModel->hapus_data($data['pemesan']);
        return redirect()->to(base_url('/k/'));
    }
}
