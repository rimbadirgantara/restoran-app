<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,
        td,
        th {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 2px;
        }

        th {
            background-color: #CCC;
        }

        h2 {
            font-family: 'Courier New', Courier, monospace;
        }

        @page {
            margin: 10px;
        }
    </style>
    <title>PDF</title>
</head>

<body>
    <h2>Laporan Transaksi <?= date('d / m / Y - H:i', time()); ?> WIB</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pemesan</th>
                <th>Total Transaksi</th>
                <th>Waktu Pemesanan</th>
                <th>Waktu Pembayara</th>
                <th>Kasir</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($order_sudah as $o) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $o['pemesan']; ?></td>
                    <td>Rp. <?= $o['total_harga']; ?>,-</td>
                    <td><?= date('d / m / Y - H:i', $o['waktu_dibuat']); ?> WIB</td>
                    <td><?= date('d / m / Y - H:i', $o['waktu_bayar']); ?> WIB</td>
                    <td><?= $o['kasir']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php foreach ($total_pendapatan->getResultArray() as $a) : ?>
        <p>Total Pendapatan : Rp. <?= $a['total_harga']; ?>,-</p>
    <?php endforeach; ?>
</body>

</html>