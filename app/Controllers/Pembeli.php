<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\Request;
use PhpParser\Node\Expr\FuncCall;

class Pembeli extends BaseController
{
	public function __construct()
	{
		$this->MenuModel = new MenuModel;
		$this->OrderModel = new OrderModel;
	}

	public function index()
	{
		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Dashboard Pembeli',

			'menu' => $this->MenuModel->findAll(),
			'order' => $this->OrderModel->ambil_data_dengan_username(session()->get('username')),
			'data_harga' => $this->OrderModel->jumlahkan_total_harga(session()->get('username'))
		];
		return view('pembeli/index', $data);
	}

	public function tambah_order()
	{
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

	public function hapus_order($id)
	{
		$this->OrderModel->hapus_order($id);
		return redirect()->to(base_url('/a'));
	}

	public function form_pesanan($slug)
	{
		$data = [
			'title' => 'ResRim | Pembeli',
			'banner' => 'ResRim',
			'page' => 'Home',
			'sub_page' => 'Dashboard Pembeli',

			'menu' => $this->MenuModel->findAll(),
			'order' => $this->OrderModel->ambil_data_dengan_username(session()->get('username')),
			'makanan' => $this->MenuModel->ambil_data_dengan_slug(htmlspecialchars($slug)),
			'validation' => \Config\Services::validation(),
		];
		// dd($data['order']);
		if (empty($data['makanan'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
		}
		return view('pembeli/proses_pesanan', $data);
	}

	public function proses_pesanan($slug_makanan)
	{
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
			'status' => 'Belum di proses'
		];

		$this->OrderModel->save($data_orderan);
		return redirect()->to(base_url('/a'));
	}

	public function proses_pesanan_v2($username)
	{
		$this->OrderModel->proses_pesanan($username);
		return redirect()->to(base_url('/a'));
	}
}
