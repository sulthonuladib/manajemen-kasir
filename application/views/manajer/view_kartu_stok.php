<div class="content-wrapper">
  <div class="container">
      <h4>KARTU STOK PORSI BAHAN</h4>
    <div class="row">
      <?php if ($barang): ?>
        <div class="col-md-12">
          <table class="table">
            <tr>
              <td>Kode Bahan</td>
              <td>:</td>
              <td><?php echo $barang->kd_barang ?></td>
            </tr>
            <tr>
              <td>Nama Bahan</td>
              <td>:</td>
              <td><?php echo $barang->nm_barang ?></td>
            </tr>
          </table>
            <table id="tbKartuStok" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <td><strong>Waktu</strong></td>
                  <td align="center"><strong>Masuk</strong></td>
                  <td align="center"><strong>Keluar</strong></td>
                  <td align="center"><strong>Saldo</strong></td>
                  <td><strong>Keterangan</strong></td>
                  <td><strong>User</strong></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list->result() as $key): ?>
                <tr>
                  <td><?php echo date_indo($key->waktu) . " " . $key->jam ?></td>
                  <td align="center"><?php echo $key->masuk ?></td>
                  <td align="center"><?php echo $key->keluar ?></td>
                  <td align="center" style="color: grey"><?php echo $key->saldo ?></td>
                  <td><?php echo $key->keterangan ?></td>
                  <td><?php echo $key->user ?></td>
                </tr>
                <?php endforeach?>
              </tbody>
            </table>
        </div>
      <?php else: ?>
        <div class="col-md-12">
          <h4>Kode Barang Tidak Ditemukan!</h4>
          <div>
            <a href="<?php echo base_url('manajer/kartu-stok/') ?>"><button class="btn btn-warning">KEMBALI</button></a>
          </div>
        </div>
      <?php endif?>
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
    <script src="<?php echo base_url() ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/dataTables/jquery.dataTables.js"></script>
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