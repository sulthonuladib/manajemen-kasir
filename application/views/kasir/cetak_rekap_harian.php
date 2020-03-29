<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rekap Harian</title>
<link rel="icon" type="image/png" href="<?php echo base_url('assets/') ?>/img/favicon.png"/>
<style type="text/css">
body {
	font-family: Calibri;
	font-size: 8pt;
	color: #000;
}
th, tr, td {
  padding: 2px;
}
</style>
</head>
<body onload="print()">
<table width="250" border="0" align="center">
  <tr>
    <td colspan="4" align="center"><font color="#000000" size="+2" style="text-transform:uppercase"><?php echo $toko->nm_toko; ?></font></td>
  </tr>
  <tr>
    <td align="center">REKAP PENJUALAN DAN PENGELUARAN</td>
  </tr>
  <tr>
    <td align="center"><?php echo date_indo($tgl) . " " . $waktu ?></td>
  </tr>
  </table>
<table width="250" align="center" style="border-collapse: collapse;">
  <tr style="border-bottom: 1px solid #ddd;">
    <td><strong>No Faktur</strong></td>
    <td align="right"><strong>Debet</strong></td>
    <td align="right"><strong>Cash</strong></td>
  </tr>
  <?php foreach ($rekap->result() as $key): ?>
  <tr style="border-bottom: 1px solid #ddd;">
    <td><?php echo $key->no_faktur_penjualan ?></td>
    <td><div align="right"><?php echo number_format($key->debet, 0, ',', '.') ?></div></td>
    <td><div align="right"><?php echo number_format($key->cash, 0, ',', '.') ?></div></td>
  </tr>
<?php
$total_debet += $key->debet;
$total_cash += $key->cash;
?>
 <?php endforeach?>
  <tr>
    <td>TOTAL</td>
    <td><div align="right"><strong>Rp. <?php echo number_format($total_debet, 0, ',', '.') ?></strong></div></td>
    <td><div align="right"><strong>Rp. <?php echo number_format($total_cash, 0, ',', '.') ?></strong></div></td>
  </tr>
</table>
<br />
<table width="250" align="center" style="border-collapse: collapse;">
  <tr style="border-bottom: 1px solid #ddd;">
    <td><strong>Jenis</strong></td>
    <td><strong>Keterangan</strong></td>
    <td align="right"><strong>Biaya</strong></td>
  </tr>
  <?php foreach ($pengeluaran->result() as $key): ?>
  <tr style="border-bottom: 1px solid #ddd;">
    <td><?php echo $key->jenis ?></td>
    <td><?php echo $key->ket ?></td>
    <td><div align="right"><?php echo number_format($key->biaya, 0, ',', '.') ?></div></td>
  </tr>
<?php
$total_biaya += $key->biaya;
?>
 <?php endforeach?>
  <tr>
    <td>TOTAL</td>
    <td></td>
    <td><div align="right"><strong>Rp. <?php echo number_format($total_biaya, 0, ',', '.') ?></strong></div></td>
  </tr>
</table>
</body>
</html>