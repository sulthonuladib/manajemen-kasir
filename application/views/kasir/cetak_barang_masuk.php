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
    <td align="center">DATA BARANG MASUK</td>
  </tr>
  <tr>
    <td align="center"><?php echo date_indo($tanggal) ?></td>
  </tr>
  </table>
<table width="250" align="center" style="border-collapse: collapse;">
  <tr style="border-bottom: 1px solid #ddd;">
    <td><strong>Kode Barang</strong></td>
    <td align="center"><strong>Masuk</strong></td>
    <td align="center"><strong>Stok</strong></td>
  </tr>
  <?php foreach ($masuk->result() as $key): ?>
  <tr style="border-bottom: 1px solid #ddd;">
    <td><?php echo $key->kd_barang ?></td>
    <td align="center"><?php echo $key->masuk ?></td>
    <td align="center"><?php echo $key->stok ?></td>
  </tr>
 <?php endforeach?>
</table>
</body>
</html>