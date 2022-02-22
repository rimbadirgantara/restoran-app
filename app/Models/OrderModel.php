<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{

    protected $table = 'order';
    protected $useTimestamps = true;
    protected $allowedFields = ['pemesan', 'nama_makanan', 'slug', 'no_meja', 'status', 'total_harga', 'porsi'];

    public function ambil_data_dengan_username($username)
    {
        return $this->where(['pemesan' => $username])->findAll();
    }

    public function jumlahkan_total_harga($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('order');
        $sql = $builder->selectSum('total_harga');
        return $sql->get();
    }

    public function hapus_order($id)
    {
        $this->delete($id);
    }

    public function proses_pesanan($username)
    {
        $this->set('status', 'Tolong di proses');
        $this->where('pemesan', $username);
        $this->update();
    }
}
