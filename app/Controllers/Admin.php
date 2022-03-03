<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\KasirOrderModel;
use App\Models\MenuModel;
use \Dompdf\Dompdf;

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
        $keyword = htmlspecialchars($this->request->getVar('keyword'));
        if ($keyword) {
            $pembeli = $this->UserModel->search_pembeli($keyword)->paginate(5, 'pembeli');
        } else {
            $pembeli = $this->UserModel->where(['level' => 'pembeli'])->paginate(5, 'pembeli');
        }
        $current_page_pembeli = htmlspecialchars($this->request->getVar('page_pembeli')) ? htmlspecialchars($this->request->getVar('page_pembeli')) : 1;

        $keyword_kasir = htmlspecialchars($this->request->getVar('keyword_kasir'));
        if ($keyword_kasir) {
            $kasir = $this->UserModel->search_kasir($keyword_kasir)->findAll();
        } else {
            $kasir = $this->UserModel->where(['level' => 'kasir'])->findAll();
        }
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Member',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'pembeli' => $pembeli,
            'pembeli_pager' => $this->UserModel->pager,
            'current_page_pembli' => $current_page_pembeli,
            ////////////////////////////////////////////
            'kasir' => $kasir,
            'kasir_pager' => $this->UserModel->pager,
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

            'validation' => \Config\Services::validation(),
            'pembeli' => $this->UserModel->where(['id' => $id])->first()
        ];

        return view('admin/member/form_edit_user', $data);
    }

    public function send_edit_member($id)
    {
        $id_ = base64_decode($id);
        $email = htmlspecialchars($this->request->getVar('email'));
        $username = htmlspecialchars($this->request->getVar('username'));
        $data_lama = $this->UserModel->where(['id' => $id_])->first();
        if ($data_lama['email'] === $email) {
            $rules_email = 'required|valid_email';
        } else {
            $rules_email = 'required|valid_email|is_unique[users.email]';
        }
        if ($data_lama['username'] === $username) {
            $rules_username = 'required';
        } else {
            $rules_username = 'required|is_unique[users.username]';
        }
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib di isi!'
                ]
            ],
            'email' => [
                'rules' => $rules_email,
                'errors' => [
                    'required' => 'Email wajib di isi!',
                    'valid_email' => 'Gunakan format email yang benar!',
                    'is_unique' => 'Email ini sudah di gunakan!'
                ]
            ],
            'username' => [
                'rules' => $rules_username,
                'errors' => [
                    'required' => 'Nama wajib di isi!',
                    'valid_email' => 'Gunakan format email yang benar',
                    'is_unique' => 'Userneme ini sudah di gunakan!'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/member/' . $id . '/edit'))->withInput()->with('validation', $validation);
        }

        if (htmlspecialchars($this->request->getVar('status_akun')) === 'Aktif') {
            $status = 'aktif';
        } else {
            $status = 'non aktif';
        }


        $data_edit = [
            'nama' => $this->request->getVar('nama'),
            'email' => $email,
            'username' => $username,
            'status_akun' => $status
        ];

        $this->UserModel->update($id_, $data_edit);
        session()->setFlashdata("edit_berhasil", "Data '" . $data_edit["nama"] . "' berhasil di update!");
        return redirect()->to(base_url('/member'));
    }

    public function tambah_user()
    {
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Member',
            'sub_page' => 'Tambah Pembeli',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'validation' => \Config\Services::validation()
        ];
        return view('admin/member/form_tambah_user', $data);
    }

    public function send_data_tambah_user()
    {
        $rules = [
            'nama_pengguna' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Nama wajib di isi!',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email wajib di isi!',
                    'valid_email' => 'Gunakan format email yang benar!',
                    'is_unique' => 'Email ini sudah di gunakan!'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]|min_length[5]',
                'errors' => [
                    'required' => 'Username wajib di isi!',
                    'is_unique' => 'Userneme ini sudah di gunakan!',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Username wajib di isi!',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/member/tmbhuser'))->withInput()->with('validation', $validation);
        }
        if (htmlspecialchars($this->request->getVar('status_akun')) === 'Aktif') {
            $status = 'aktif';
        } else {
            $status = 'non aktif';
        }
        if (htmlspecialchars($this->request->getVar('level') === 'Kasir')) {
            $level = 'kasir';
        } elseif (htmlentities($this->request->getVar('level') === 'Pembeli')) {
            $level = 'pembeli';
        }
        $data = [
            'nama' => htmlspecialchars($this->request->getVar('nama_pengguna')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'status_akun' => $status,
            'level' => $level,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'status' => 'offline',
            'ip' => $_SERVER['REMOTE_ADDR']
        ];
        $this->UserModel->save($data);
        session()->setFlashdata('berhasil_tambah_user', 'Berhasil menambahkan' . $this->request->getVar('level'));
        return redirect()->to(base_url('/member'));
    }





    public function order()
    {
        $keyword = htmlspecialchars($this->request->getVar('keyword'));
        if ($keyword) {
            $order = $this->OrderModel->search_order($keyword)->paginate(5, 'order');
        } else {
            $order = $this->OrderModel->paginate(5, 'order');
        }
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Order',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'order' => $order,
            'order_pager' => $this->OrderModel->pager
        ];
        return view('admin/order/index', $data);
    }

    public function profit()
    {
        // fungsi search
        $keyword = htmlspecialchars($this->request->getVar('keyword'));
        if ($keyword) {
            $profit = $this->KasirOrderModel->search_profit($keyword)->paginate(5, 'profit');
        } else {
            $profit = $this->KasirOrderModel->paginate(5, 'profit');
        }
        // penghitung halaman untuk pagination
        $current_page = $this->request->getVar('page_profit') ? $this->request->getVar('page_profit') : 1;

        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Profit',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'profit' => $profit,
            'profit_pager' => $this->KasirOrderModel->pager,
            'current_page' => $current_page,
            'total_pendapatan' => $this->KasirOrderModel->jumlahkan_total_harga()
        ];
        return view('admin/profit/index', $data);
    }

    public function exportPDF_transaksi()
    {
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

    public function hapus_semua_data_profit()
    {
        $this->KasirOrderModel->emptyTable('kasir_order');
        session()->setFlashdata('hapus_semua_data_profit', 'Berhasil menghapus semuda data transaksi');
        return redirect()->to(base_url('/profit'));
    }


    public function menu()
    {
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Menu',
            'sub_page' => 'Index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'menu' => $this->MenuModel->findAll()
        ];
        return view('admin/menu/index', $data);
    }
}
