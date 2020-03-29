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
    <title>bedokCode</title>
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets/css/bootstrap-select.min.css" rel="stylesheet" >

</head>
<body>
<?php
$query = $this->db->get('tabel_toko', 1, 0);
$toko = $query->row();
$namatoko = $toko->nm_toko;
?>
    <div class="navbar navbar-inverse set-radius-zero no-print" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url('dashboard/') ?>">
                    <img style="padding-top: 20px;" height="100px" src="<?php echo base_url() ?>/assets/img/logo.png" />
                </a>
                <h2 style="display: inline; text-transform: uppercase;font-family: Open Sans; margin-left: 10px;"><?php echo $namatoko ?></h2>
            </div>
        </div>
    </div>
<?php
$hak = $this->session->userdata('akses');
?>
    <!-- LOGO HEADER END-->
    <section class="menu-section no-print">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-left">
                            <li><a href="<?php echo base_url('dashboard/') ?>">DASHBOARD</a></li>
                            <?php if ($hak != 'kasir'): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">MENU GUDANG<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/satuan/') ?>">SATUAN BAHAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/barang/') ?>">ENTRY BAHAN BAKU</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/menu/') ?>">DAFTAR MENU</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/pembelian-start/') ?>">PEMBELIAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/stok/') ?>">STOK BAHAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/bahan-rusak/') ?>">BAHAN RUSAK / BUSUK</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/stok-min/') ?>">BAHAN MAU HABIS</a></li>
                                </ul>
                            </li>
                            <?php endif?>
                            <?php if ($hak != 'gudang'): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">MENU KASIR<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('kasir/nomor-faktur/') ?>">MESIN KASIR</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('kasir/input-biaya/') ?>">INPUT BIAYA</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('kasir/rekap/') ?>">REKAP HARI INI</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('kasir/barang-masuk/') ?>">BAHAN MASUK HARI INI</a></li>
                                </ul>
                            </li>
                            <?php endif?>
                            <?php if ($hak == 'manager'): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">MANAJER TOKO<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('manajer/toko/') ?>">TOKO</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('manajer/user/') ?>">USER</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/stok/') ?>">STOK BAHAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('manajer/kartu-stok/') ?>">KARTU STOK</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('gudang/stok-min/') ?>">BAHAN MAU HABIS</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">GRAFIK<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a target="_blank" role="menuitem" tabindex="-1" href="<?php echo base_url('grafik/stok-barang/') ?>">GRAFIK PORSI BAHAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('grafik/profit-bulanan/') ?>">GRAFIK PROFIT BULANAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('grafik/penjualan-bulanan/') ?>">GRAFIK PENJUALAN BULANAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('grafik/penjualan-tahun/') ?>">GRAFIK PENJUALAN TAHUNAN</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">LAPORAN<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('laporan/biaya/') ?>">BIAYA-BIAYA</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?php echo base_url('laporan/nilai-persediaan/') ?>">PERSEDIAAN BAHAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?php echo base_url('laporan/pembelian/') ?>">PEMBELIAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?php echo base_url('laporan/penjualan-transaksi/') ?>">PENJUALAN PER TRANSAKSI</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?php echo base_url('laporan/penjualan-barang/') ?>">PENJUALAN PER MENU</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?php echo base_url('laporan/profit/') ?>">PROFIT PENJUALAN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('laporan/rekap/') ?>">REKAPITULASI PENJUALAN</a></li>
                                </ul>
                            </li>
                            <?php endif?>
                            <li><a href="<?php echo base_url('login/logout/') ?>"><strong style="color: red">KELUAR APLIKASI</strong></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>