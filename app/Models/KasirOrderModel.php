<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirOrderModel extends Model
{

    protected $table = 'kasir_order';
    protected $useTimestamps = true;
    protected $allowedFields = ['pemesan', 'no_meja', 'total_harga', 'uang_bayar', 'uang_kembali', 'status', 'waktu_dibuat'];
}
