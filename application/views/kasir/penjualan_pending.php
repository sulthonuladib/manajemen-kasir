  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">PENJUALAN PENDING <span><a class="btn btn-danger pull-right" href="<?php echo base_url('kasir/nomor-faktur-new/') ?>">Transaksi Faktur Baru</a></span></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <table id="tbPending" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Faktur</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pending->result() as $key): ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $key->no_faktur_penjualan ?></td>
                  <td><?php echo date_indo($key->tgl_penjualan) ?></td>
                  <td><?php echo $key->waktu ?></td>
                  <td align="center"><a href="<?php echo base_url('kasir/mesin-kasir/') . $key->no_faktur_penjualan ?>">Lanjut</a> | <a onclick="return confirm('Yakin hapus faktur ini?')" href="<?php echo base_url('kasir/hapus-faktur/') . $key->no_faktur_penjualan ?>">Hapus</a></td>
                </tr>
                <?php endforeach?>
              </tbody>
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
</div>
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
    </script>

</body>
</html>