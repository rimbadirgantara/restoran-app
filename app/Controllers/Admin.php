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
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pembeli = $this->UserModel->search_pembeli($keyword)->paginate(5, 'pembeli');
        } else {
            $pembeli = $this->UserModel->where(['level' => 'pembeli'])->paginate(5, 'pembeli');
        }
        $current_page = $this->request->getVar('page_pembeli') ? $this->request->getVar('page_pembeli') : 1;
        $data = [
            'title' => 'Resrim | Admin',
            'sidebar_banner' => 'Resrim App',
            'page_name' => 'Member',
            'sub_page' => 'index',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),

            'current_page' => $current_page,
            'pembeli' => $pembeli,
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

        if ($this->request->getVar('status_akun') === 'Aktif') {
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
            'nama' => [
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
        $data = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'status_akun' => $status,
            'level' => 'pembeli',
            'ip' => $_SERVER['REMOTE_ADDR']
        ];
        $this->UserModel->save($data);
        session()->setFlashdata('berhasil_tambah_user', 'Berhasil menambahkan pembeli');
        return redirect()->to(base_url('/member'));
    }
}
