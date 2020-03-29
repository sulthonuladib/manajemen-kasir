  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">REKAP <?php echo date_indo($tanggal) ?> <span class="pull-right"><a id="btnRekap" class="btn btn-danger" href="<?php echo base_url('kasir/cetak-rekap') ?>">Cetak Rekap</a></span></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <h4><strong>Penjualan</strong></h4>
            <table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nomor Faktur</th>
                  <th>Waktu</th>
                  <th>Total Belanja</th>
                  <th>Diskon</th>
                  <th>Grand Total</th>
                  <th>Cash</th>
                  <th>Debet</th>
                  <th>Ket</th>
                  <th>User</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($penjualan->result() as $key): ?>
                <tr>
                  <td align="center"><?php echo $no++ ?></td>
                  <td><?php echo $key->no_faktur_penjualan ?></td>
                  <td><?php echo $key->waktu ?></td>
                  <td align="right"><?php echo number_format($key->total_penjualan, 0, ',', '.') ?></td>
                  <td align="right"><?php echo number_format($key->diskon, 0, ',', '.') ?></td>
                  <td align="right"><?php echo number_format($key->total_penjualan_sdiskon, 0, ',', '.') ?></td>
                  <td align="right"><?php echo number_format($key->cash, 0, ',', '.') ?></td>
                  <td align="right"><?php echo number_format($key->debet, 0, ',', '.') ?></td>
                  <td><?php echo $key->ket ?></td>
                  <td><?php echo $key->id_user ?></td>
                  <td align="center"><a href="javascript:void(0);" class="lihat_record" title="Lihat Detail" data-faktur="<?php echo $key->no_faktur_penjualan ?>">Lihat</a></td>
                </tr>
<?php
$subtot += $key->total_penjualan;
$diskon += $key->diskon;
$grandtot += $key->total_penjualan_sdiskon;
$cash += $key->cash;
$debet += $key->debet;
?>
                <?php endforeach?>
              </tbody>
                  <thead>
                    <tr>
                      <td colspan="3" align="center">Total</td>
                      <td align="right"><?php echo number_format($subtot, 0, ',', '.') ?></td>
                      <td align="right"><?php echo number_format($diskon, 0, ',', '.') ?></td>
                      <td align="right"><?php echo number_format($grandtot, 0, ',', '.') ?></td>
                      <td align="right"><?php echo number_format($cash, 0, ',', '.') ?></td>
                        <td align="right"><?php echo number_format($debet, 0, ',', '.') ?></td>
                        <td></td>
                        <td></td>
                      <td></td>
                    </tr>
                  </thead>
            </table>
            <h4><strong>Pengeluaran</strong></h4>
            <table id="tbPengeluaran" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>User</th>
                  <th>Jenis</th>
                  <th>Keterangan</th>
                  <th>Biaya</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pengeluaran->result() as $key): ?>
                <tr>
                  <td align="center"><?php echo $noo++ ?></td>
                  <td><?php echo $key->id_user ?></td>
                  <td><?php echo $key->jenis ?></td>
                  <td><?php echo $key->ket ?></td>
                  <td align="right"><?php echo number_format($key->biaya, 0, ',', '.') ?></td>
                </tr>
<?php
$tot_biaya += $key->biaya;
?>
                <?php endforeach?>
              </tbody>
                  <thead>
                    <tr>
                      <td colspan="4" align="center">Total</td>
                      <td align="right"><?php echo number_format($tot_biaya, 0, ',', '.') ?></td>
                    </tr>
                  </thead>
            </table>
        </div>
      </div>
    </div>
  </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                &copy; Copyright <?php echo date('Y') ?>, <a href="https://github.com/sulthonuladib" target="_blank">B E D O K</a>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
    <script>
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);
    $('#tbPenjualan').on('click','.lihat_record',function(){
        var faktur = $(this).data('faktur');
        var url = "<?php echo base_url('kasir/reprint_struk/') ?>"+faktur;
        window.open(url, '_blank', 'location=yes,height=400,width=500,scrollbars=yes,status=yes');
    });
    $("#btnRekap").on('click', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      window.open(url, '_blank', 'location=yes,height=600,width=500,scrollbars=yes,status=yes');
    });

    </script>

</body>
</html>