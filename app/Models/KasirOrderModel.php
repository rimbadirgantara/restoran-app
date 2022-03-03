<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirOrderModel extends Model
{

    protected $table = 'kasir_order';
    protected $useTimestamps = true;
    protected $allowedFields = ['pemesan', 'no_meja', 'total_harga', 'uang_bayar', 'uang_kembali', 'status', 'waktu_dibuat', 'waktu_bayar', 'kasir'];

    public function update_data_pembeli($data)
    {
        $this->set('uang_bayar', $data['uang_bayar']);
        $this->set('uang_kembali', $data['uang_kembalian']);
        $this->set('status', $data['status']);
        $this->set('waktu_bayar', $data['waktu_bayar']);
        $this->set('kasir', $data['kasir']);
        $this->where('pemesan', $data['pemesan']);
        $this->update();
    }

    public function jumlahkan_total_harga()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kasir_order');
        $builder->where(['status' => 'Sudah Bayar']);
        $sql = $builder->selectSum('total_harga');
        return $sql->get();
    }

    public function jumlahkan_total_harga_dengan_username($username)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('kasir_order');
        $builder->where(['pemesan' => $username]);
        $sql = $builder->selectSum('total_harga');
        return $sql->get();
    }

    public function search_profit($k)
    {
        $builder = $this->table('kasir_order');
        $builder->like('pemesan', $k);
        $builder->orLike('no_meja', $k);
        $builder->orLike('status', $k);
        return $builder;
    }
}
