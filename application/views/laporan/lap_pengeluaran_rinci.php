<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Aplikasi Point of Sales" />
    <meta name="author" content="yoriadiatma" />
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Laporan Pengeluaran Rinci</title>
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" />

</head>
<body>
<div class="container">
    <div align="right" class="no-print" id="formFilter" style="background-color: #F5F5F5;padding: 4px">
    <a href=""><button type="button" class="btn btn-success" onclick="window.print();return false;">Print</button></a>
    </div>
    <h4 align="center">LAPORAN PENGELUARAN RINCI</h4>
    <h5 align="center">TOKO : <?php echo $toko->nm_toko ?></h5>
    <h5 align="center">BULAN :  <?php echo bulan($bln) . " " . $thn; ?></h5>

<table id="tbBiaya" class="table table-bordered table-responsive">
<thead>
    <tr>
        <th style="width:50px;">No</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Jenis</th>
        <th>Keterangan</th>
        <th>Biaya (Rp)</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($biaya->result() as $key): ?>
    <tr>
        <td style="text-align:center;"><?php echo $no++ ?></td>
        <td><?php echo date_indo($key->tgl) ?></td>
        <td><?php echo $key->id_user ?></td>
        <td><?php echo $key->jenis ?></td>
        <td><?php echo $key->ket ?></td>
        <td style="text-align:right;"><?php echo number_format($key->biaya, 0, ',', '.') ?></td>
    </tr>
    <?php
$tot += $key->biaya;
?>
    <?php endforeach?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;"><b><?php echo number_format($tot, 0, ',', '.') ?></b></td>
    </tr>
</tfoot>
</table>
</div>
</body>
</html>