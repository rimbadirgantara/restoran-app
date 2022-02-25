<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $table = 'order';
    protected $useTimestamps = true;
    protected $allowedFields = ['pemesan', 'nama_makanan', 'slug', 'no_meja', 'status', 'total_harga', 'porsi', 'waktu_dibuat'];

    public function ambil_data_dengan_username($username)
    {
        return $this->where(['pemesan' => $username])->findAll();
    }

    public function ambil_data_dengan_id($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function jumlahkan_total_harga($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('order');
        $builder->where('pemesan', $username);
        $sql = $builder->selectSum('total_harga');
        return $sql->get();
    }

    public function edit_data_order($id, $data)
    {
        $this->set('no_meja', $data['no_meja']);
        $this->set('porsi', $data['porsi']);
        $this->set('total_harga', $data['total_harga']);
        $this->where('id', $id);
        $this->update();
    }

    public function update_data_pembeli_sudah_bayar($data)
    {
        $this->set('status', 'Sudah Bayar');
        $this->where('pemesan', $data['pemesan']);
        $this->update();
    }

    public function edit_status_order($username)
    {
        $this->set('status', 'Belum di proses');
        $this->where('pemesan', $username);
        $this->update();
    }

    public function hapus_order($id)
    {
        $this->delete($id);
    }

    public function hapus_data($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('order');
        $builder->where(['pemesan' => $username]);
        $builder->delete();
    }

    public function proses_pesanan($username)
    {
        $this->set('status', 'Belum bayar');
        $this->where('pemesan', $username);
        $this->update();
    }

    public function ambil_semua_data_belum_bayar()
    {
        return $this->where(['status' => 'Belum bayar'])->findAll();
    }
}
