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
    <title>Laporan Profit</title>
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
            <h4 align="center">LAPORAN PROFIT</h4>
            <h5 align="center">TOKO : <?php echo $toko->nm_toko ?></h5>
            <?php if ($filter): ?>
                <h5 align="center">TANGGAL : <?php echo date_indo($awal) . " s/d " . date_indo($akhir) ?></h5>
            <?php else: ?>
            <h5 align="center">TANGGAL : <?php echo date_indo($tanggal) ?></h5>
            <?php endif?>
            <table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
<thead>
    <tr>
        <th style="width:50px;">No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga Modal</th>
        <th>Harga Jual</th>
        <th>Qty Terjual</th>
        <th>Modal</th>
        <th>Pendapatan</th>
        <th>Profit</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($profit->result() as $key): ?>
        <?php
$jum_tot = $key->jum_item;
$modal = $key->harga_modal * $jum_tot;
$pendapatan = $key->harga * $jum_tot;
$profit_gross = $pendapatan - $modal;
?>
    <tr>
        <td style="text-align:center;"><?php echo $no++ ?></td>
        <td style="text-align:left;"><?php echo $key->kd_barang ?></td>
        <td style="text-align:left;"><?php echo $key->nm_barang ?></td>
        <td style="text-align:right;"><?php echo number_format($key->harga_modal, 0, ',', '.') ?></td>
        <td style="text-align:right;"><?php echo number_format($key->harga, 0, ',', '.') ?></td>
        <td style="text-align:center;"><?php echo $jum_tot ?></td>
        <td style="text-align:right;"><?php echo number_format($modal, 0, ',', '.') ?></td>
        <td style="text-align:right;"><?php echo number_format($pendapatan, 0, ',', '.') ?></td>
        <td style="text-align:right;"><?php echo number_format($profit_gross, 0, ',', '.') ?></td>
    </tr>

    <?php
$tot_item += $jum_tot;
$tot_modal += $modal;
$tot_pendapatan += $pendapatan;
$tot_profit += $profit_gross;
?>

    <?php endforeach?>
</tbody>

    <tr style="background: grey;">
        <td colspan="5" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:center;"><b><?php echo $tot_item ?></b></td>
        <td style="text-align:right;"><b><?php echo number_format($tot_modal, 0, ',', '.') ?></b></td>
        <td style="text-align:right;"><b><?php echo number_format($tot_pendapatan, 0, ',', '.') ?></b></td>
        <td style="text-align:right; background: red"><b><?php echo number_format($tot_profit, 0, ',', '.') ?></b></td>
     </tr>
</table>
<?php
$diskonperbarang = $subdiskon->disk1;
$diskonakhir = $subdisakhir->diska;
$total_diskon = $diskonperbarang + $diskonakhir;
?>
<h4>Diskon</h4>
<table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
        <tr>
            <td>1. Total Diskon (per Barang)</td>
            <th style="text-align:right;"><?php echo number_format($diskonperbarang, 0, ',', '.') ?></th>
        </tr>
        <tr>
            <td>2. Total Diskon (per Transaksi)</td>
             <th style="text-align:right;"><?php echo number_format($diskonakhir, 0, ',', '.') ?></th>
        </tr>
         <tr>
            <th style="text-align:left">Total Diskon</th>
             <th style="text-align:right;background: red;color: white; width: 7em"><?php echo number_format($total_diskon, 0, ',', '.') ?></th>
        </tr>
</table>

</table>
<h4>Biaya Pengeluaran</h4>
<table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
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
        <td style="text-align:center;"><?php echo $noo++ ?></td>
        <td><?php echo date_indo($key->tgl) ?></td>
        <td><?php echo $key->id_user ?></td>
        <td><?php echo $key->jenis ?></td>
        <td><?php echo $key->ket ?></td>
        <td style="text-align:right;width: 7em"><?php echo number_format($key->biaya, 0, ',', '.') ?></td>
    </tr>
    <?php
$totbiaya += $key->biaya;
?>
    <?php endforeach?>
</tbody>

    <tr>
        <td colspan="5" style="text-align:center;"><b>Total</b></td>
        <td style="text-align:right;background: red;color: white;"><b><?php echo number_format($totbiaya, 0, ',', '.') ?></b></td>
    </tr>

</table>

<?php
$laba_bersih = $tot_profit - $totbiaya - $total_diskon;
?>
<table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
    <tr>
      <?php if ($filter): ?>
      <th style="text-align:left; font-size: 16px">Laba Bersih Tanggal <?php echo date_indo($awal) . " s/d " . date_indo($akhir) ?></th>
      <?php else: ?>
      <th style="text-align:left; font-size: 16px">Laba Bersih Tanggal <?php echo date_indo($tanggal) ?></th>
      <?php endif?>

    </tr>
    <tr>
        <th style="text-align:right;background: yellow; font-size: 16px;">Rp. <?php echo number_format($laba_bersih, 0, ',', '.') ?>,-</th>
    </tr>
</table>
</div>
</body>
</html>