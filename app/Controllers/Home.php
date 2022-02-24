<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Home extends BaseController
{
    protected $LoginModel;
    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        $data = [
            'title' => 'ResRim | Home',
            'banner' => 'ResRim',
        ];
        return view('front_page/index', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'ResRim | Login',
            'banner' => 'ResRim',
            'validation' => \Config\Services::validation()
        ];
        return view('login/index', $data);
    }

    public function login_progress()
    {
        $v = [
            'username' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Username harus di isi!',
                    'min_length' => 'Username harus lebih dari 3 karakter!'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Password harus di isi!',
                    'min_length' => 'Password harus lebih dari 3 karakter!'
                ]
            ]
        ];

        if (!$this->validate($v)) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/login'))->withInput()->with('validation', $validation);
        }

        $username = htmlspecialchars($this->request->getVar('username'));
        $password = htmlspecialchars($this->request->getVar('password'));
        $cek_user = $this->LoginModel->cek_login_dengan_username($username);

        if ($cek_user) {
            if ($username === $cek_user['username']) {
                if (password_verify($password, $cek_user['password'])) {
                    if ($cek_user['status_akun'] === 'aktif') {
                        if ($cek_user['level'] === 'pembeli') {

                            $data_ses = [
                                'nama' => $cek_user['nama'],
                                'username' => $cek_user['username'],
                                'level' => $cek_user['level']
                            ];
                            session()->set($data_ses);
                            return redirect()->to(base_url('/a'));
                        } elseif ($cek_user['level'] === 'kasir') {

                            $data_ses = [
                                'nama' => $cek_user['nama'],
                                'username' => $cek_user['username'],
                                'level' => $cek_user['level']
                            ];
                            session()->set($data_ses);
                            return redirect()->to(base_url('/k'));
                        } elseif ($cek_user['level'] === 'admin') {

                            // $data_ses = [
                            //     'nama' => $cek_user['nama'],
                            //     'username' => $cek_user['username'],
                            //     'level' => $cek_user['level'],
                            //     'no_laboran' => $cek_user['no_laboran']
                            // ];
                            // session()->set($data_ses);
                            // return redirect()->to(base_url('/lab/'.$cek_user['lab'].'/detail/labor'));
                            echo 'anda admin';
                        } else {
                            session()->setFlashdata('login_dulu', 'Anda tidak di kenali');
                            return redirect()->to(base_url('/login'));
                        }
                    } else {
                        session()->setFlashdata('login_dulu', 'Akun anda tidak aktif');
                        return redirect()->to(base_url('/login'));
                    }
                } else {
                    session()->setFlashdata('login_dulu', 'Password salah');
                    return redirect()->to(base_url('/login'));
                }
            } else {
                session()->setFlashdata('login_dulu', 'Username salah');
                return redirect()->to(base_url('/login'));
            }
        } else {
            session()->setFlashdata('login_dulu', 'User tidak terdaftar');
            return redirect()->to(base_url('/login'));
        }
    }

    public function lgt()
    {
        // berhasil
        $data_ses = [
            'nama',
            'username',
            'level'
        ];
        session()->remove($data_ses);
        session()->destroy();
        return redirect()->to(base_url('/login'));
        // echo ' test'; die;?
    }
}
