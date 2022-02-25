<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\KasirOrderModel;
use CodeIgniter\HTTP\Request;
use PhpParser\Node\Expr\FuncCall;

class Pembeli extends BaseController
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
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Dashboard Pembeli',

			'menu' => $this->MenuModel->findAll(),
			'order' => $this->OrderModel->ambil_data_dengan_username(session()->get('username')),
			'data_harga' => $this->OrderModel->jumlahkan_total_harga(session()->get('username')),
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'username' => htmlspecialchars(session()->get('username'))
		];
		return view('pembeli/index', $data);
	}

	public function tambah_order()
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$slug_makanan = htmlspecialchars($this->request->getVar('tambah_makanan'));
		$nama_makanan = $this->MenuModel->ambil_data_dengan_slug($slug_makanan);
		$data = [
			'pemesan' => session()->get('username'),
			'nama_makanan' => $nama_makanan['nama_masakan'],
			'slug' => $slug_makanan,
		];
		$this->OrderModel->save($data);
		return redirect()->to(base_url('/a/#menu'));
	}

	public function edit_pesanan($id, $slug_makanan)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Dashboard Pembeli',

			'username' => session()->get('username'),
			'makanan' => $this->MenuModel->ambil_data_dengan_slug($slug_makanan),
			'_makanan' => $this->OrderModel->ambil_data_dengan_id($id),
			'slug_makanan' => $slug_makanan,
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'validation' => \Config\Services::validation()
		];
		return view('pembeli/edit_pesanan', $data);
	}

	public function hapus_order($id)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$this->OrderModel->hapus_order($id);
		return redirect()->to(base_url('/a'));
	}

	public function form_pesanan($slug)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Dashboard Pembeli',

			'menu' => $this->MenuModel->findAll(),
			'order' => $this->OrderModel->ambil_data_dengan_username(session()->get('username')),
			'makanan' => $this->MenuModel->ambil_data_dengan_slug(htmlspecialchars($slug)),
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'validation' => \Config\Services::validation()
		];
		// dd($data['order']);
		if (empty($data['makanan'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
		}
		return view('pembeli/proses_pesanan', $data);
	}

	public function proses_pesanan($slug_makanan)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$rules = [
			'jumlah_porsi' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Isi jumlah porsi!',
					'numeric' => 'Jumlah harus angka!'
				]
			],

			'no_meja' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Isi nomor meja',
					'numeric' => 'Jumlah harus angka!'
				]
			]
		];

		if (!$this->validate($rules)) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/a/' . $slug_makanan . '/proses'))->withInput()->with('validation', $validation);
		}

		$harga = $this->MenuModel->ambil_data_dengan_slug($slug_makanan);
		// pengeccekan makanan
		if (empty($harga)) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
		}
		$porsi = htmlspecialchars($this->request->getVar('jumlah_porsi'));
		$total_semua = intVal($harga['harga']) * intVal($porsi);

		$data_orderan = [
			'pemesan' => htmlspecialchars(session()->get('username')),
			'nama_makanan' => $harga['nama_masakan'],
			'slug' => htmlspecialchars($slug_makanan),
			'no_meja' => htmlspecialchars($this->request->getVar('no_meja')),
			'porsi' => $porsi,
			'total_harga' => $total_semua,
			'status' => 'Belum di proses',
			'waktu_dibuat' => time()
		];

		$this->OrderModel->save($data_orderan);
		return redirect()->to(base_url('/a'));
	}

	public function send_edit_pesanan($id, $slug_makanan)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$rules = [
			'jumlah_porsi' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Isi jumlah porsi!',
					'numeric' => 'Jumlah harus angka!'
				]
			],

			'no_meja' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Isi nomor meja',
					'numeric' => 'Jumlah harus angka!'
				]
			]
		];

		if (!$this->validate($rules)) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('/a/' . $id . '/edit_pesanan'))->withInput()->with('validation', $validation);
		}

		$harga = $this->MenuModel->ambil_data_dengan_slug($slug_makanan);
		$porsi = htmlspecialchars($this->request->getVar('jumlah_porsi'));
		$no_meja = htmlspecialchars($this->request->getVar('no_meja'));
		$total_harga = intval($porsi) * intVal($harga['harga']);

		$data = [
			'no_meja' => $no_meja,
			'porsi' => $porsi,
			'total_harga' => $total_harga
		];

		// dd($data);

		$this->OrderModel->update($id, $data);
		return redirect()->to(base_url('/a'));
	}

	public function proses_pesanan_v2($username)
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}
		// data untuk table kasir_order
		$a = $this->OrderModel->ambil_data_dengan_username($username);
		$total_harga = $this->OrderModel->jumlahkan_total_harga($username);
		$total_harga = $total_harga->getResultArray();
		// simpan data ke kasir order
		$data = [
			'pemesan' => $a[0]['pemesan'],
			'no_meja' => $a[0]['no_meja'],
			'total_bayar' => 0,
			'total_harga' => $total_harga[0]['total_harga'],
			'total_bayar' => 0,
			'uang_kembalian' => 0,
			'status' => 'Belum Bayar',
			'waktu_dibuat' => time()
		];

		$this->KasirOrderModel->save($data);
		$this->OrderModel->proses_pesanan($username);
		return redirect()->to(base_url('/a'));
	}

	public function tabel_transaksi()
	{
		if (!session()->get('nama') and !session()->get('username') and !session()->get('level')) {
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'kasir') {
			echo 'kasir di larang masuk';
			die;
		} elseif (session()->get('level') === 'adminis') {
			echo 'owner di larang masuk';
			die;
		}

		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Transaksi',

			'menu' => $this->MenuModel->findAll(),
			'order_sudah' => $this->KasirOrderModel->where(['pemesan' => session()->get('username')])->findAll(),
			'total_pendapatan' => $this->KasirOrderModel->jumlahkan_total_harga_dengan_username(session()->get('username')),
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'username' => htmlspecialchars(session()->get('username'))
		];
		return view('pembeli/tabel_transaksi', $data);
	}
}
