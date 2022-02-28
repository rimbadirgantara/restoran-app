<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\KasirOrderModel;
use \Dompdf\Dompdf;

class Kasir extends BaseController
{
    public function __construct()
    {
        $this->MenuModel = new MenuModel;
        $this->OrderModel = new OrderModel;
        $this->KasirOrderModel = new KasirOrderModel;
        $this->urlSegment = \Config\Services::request();
    }

    public function index()
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

        $data = [
            'title' => 'ResRim | Kasir',
            'banner' => 'ResRim',
            'page' => 'Kasir',
            'sub_page' => 'Transaksi',

            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            // 'order' => $this->KasirOrderModel->where(['status' => 'Belum bayar'])->findAll(),
            // 'order_sudah' => $this->KasirOrderModel->where(['status' => 'Sudah bayar'])->findAll(),

            //pagination
            'order' => $this->KasirOrderModel->where(['status' => 'Belum bayar'])->paginate(4, 'transkasi_belum_bayar'),
            'order_sudah' => $this->KasirOrderModel->where(['status' => 'Sudah bayar'])->paginate(4, 'transkasi_sudah_bayar'),
            'order_pager' => $this->KasirOrderModel->pager,
        ];
        return view('kasir/index', $data);
    }

    public function info_bill_pembeli($username)
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

        $username = base64_decode($username);
        $data = [
            'title' => 'ResRim | Kasir',
            'banner' => 'ResRim',
            'page' => 'Kasir',
            'sub_page' => 'Transaksi',

            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'order' => $this->OrderModel->ambil_data_dengan_username($username),
            'data_harga' => $this->OrderModel->jumlahkan_total_harga($username),
            'validation' => \Config\Services::validation()
        ];
        return view('kasir/info-bill-pembeli', $data);
    }

    public function hapus_data_karsir_order($id, $username)
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

        $id = base64_decode($id);
        $username = base64_decode($username);
        // update status di tabel order
        $this->OrderModel->edit_status_order($username);
        // hapus data di tabel kasir order
        $this->KasirOrderModel->delete($id);
        return redirect()->to(base_url('/k'));
    }

    public function pembayaran_bill($username)
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

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

    public function tabeL_transaksi()
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

        // penghitung halaman untuk pagination
        $current_page = $this->request->getVar('page_transpager') ? $this->request->getVar('page_transpager') : 1;

        $data = [
            'title' => 'ResRim | Kasir',
            'banner' => 'ResRim',
            'page' => 'Kasir',
            'sub_page' => 'Tabel Transaksi',

            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'order_sudah' => $this->KasirOrderModel->where(['status' => 'Sudah bayar'])->paginate(5, 'transpager'),
            'transpager' => $this->KasirOrderModel->pager,
            'current_page' => $current_page,
            'total_pendapatan' => $this->KasirOrderModel->jumlahkan_total_harga(),
        ];
        return view('kasir/tbltrans', $data);
    }

    public function exportPDF_transaksi()
    {
        if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'pembeli') {
            return redirect()->to(base_url('/a'));
        } elseif (session()->get('level') === 'adminis') {
            echo 'owner di larang masuk';
            die;
        }

        // dompdf
        $pdf = new Dompdf();
        $data = [
            'order_sudah' => $this->KasirOrderModel->where(['status' => 'Sudah bayar'])->findAll(),
            'total_pendapatan' => $this->KasirOrderModel->jumlahkan_total_harga(),
        ];
        $html = view('pdfhtml/transaksi', $data);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('laporan transaksi.pdf', array("Attachment" => 0));
    }
}
