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
    <title>Laporan Barang Retur</title>
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" />

</head>
<body>
    <div class="container">
        <div align="center" class="no-print" id="formFilter" style="background-color: #F5F5F5;padding: 4px">
          <form class="form-inline" action="" method="get">
            <input type="hidden" name="filter" id="filter" value="ok">
              <div class="form-group">
                <label for="a">Tanggal : </label>
                <select name="a" id="a" class="form-control">
                <?php for ($i = 1; $i <= 31; $i++) {?>
                  <option <?php if ($i == $tgl) {echo 'selected';}?> value="<?php echo sprintf('%02d', $i) ?>"><?php echo sprintf('%02d', $i) ?></option>
                <?php }?>
                </select>
                <select name="b" id="b" class="form-control">
                <?php for ($i = 1; $i <= 12; $i++) {?>
                  <option <?php if ($i == $bln) {echo 'selected';}?> value="<?php echo sprintf('%02d', $i) ?>"><?php echo sprintf('%02d', $i) ?></option>
                <?php }?>
                </select>
                <select name="c" id="c" class="form-control">
                <?php for ($i = 2016; $i <= date('Y'); $i++) {?>
                  <option <?php if ($i == $thn) {echo 'selected';}?> value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label for="pwd"> s/d </label>
                <select name="d" id="d" class="form-control">
                    <?php for ($i = 1; $i <= 31; $i++) {?>
                    <option <?php if ($i == $tgl) {echo 'selected';}?> value="<?php echo sprintf('%02d', $i) ?>"><?php echo sprintf('%02d', $i) ?></option>
                    <?php }?>
                </select>
                <select name="e" id="e" class="form-control">
                <?php for ($i = 1; $i <= 12; $i++) {?>
                    <option <?php if ($i == $bln) {echo 'selected';}?> value="<?php echo sprintf('%02d', $i) ?>"><?php echo sprintf('%02d', $i) ?></option>
                <?php }?>
                </select>
                <select name="f" id="f" class="form-control">
                <?php for ($i = 2016; $i <= date('Y'); $i++) {?>
                  <option <?php if ($i == $thn) {echo 'selected';}?> value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php }?>
                </select>
              </div>
              <button type="submit" class="btn btn-danger">Filter</button>
              <a href=""><button type="button" class="btn btn-success" onclick="window.print();return false;">Print</button></a>
          </form>
        </div>
            <h4 align="center">LAPORAN BARANG RETUR</h4>
            <h5 align="center">TOKO : <?php echo $toko->nm_toko ?></h5>
            <?php if ($filter): ?>
                <h5 align="center">TANGGAL : <?php echo date_indo($awal) . " s/d " . date_indo($akhir) ?></h5>
            <?php else: ?>
            <h5 align="center">TANGGAL : <?php echo date_indo($tanggal) ?></h5>
            <?php endif?>
            <table id="tbRetur" class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Faktur</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($retur->result() as $key): ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $key->no_faktur_penjualan ?></td>
                  <td><?php echo $key->kd_barang ?></td>
                  <td><?php echo $key->nm_barang ?></td>
                  <td align="center"><?php echo $key->jumlah ?></td>
                  <td align="right"><?php echo number_format($key->total_retur, 0, ',', '.') ?></td>
                  <td><?php echo $key->ket ?></td>
                </tr>
                <?php
$totalretur += $key->total_retur;
endforeach?>
              </tbody>
              <tr>
                <td colspan="5" align="center"><strong>Total Retur Barang</strong></td>
                <td align="right"><strong>Rp <?php echo number_format($totalretur, 0, ',', '.') ?></strong></td>
                <td></td>
              </tr>
            </table>
    </div>
</body>
</html>