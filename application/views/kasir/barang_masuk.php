  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">PENAMBAHAN BAHAN <?php echo date_indo($tanggal) ?> <span class="pull-right"><a id="btnLihat" class="btn btn-danger" href="<?php echo base_url('kasir/cetak-barang-masuk') ?>">Cetak</a></span></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <table id="tbPenjualan" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Porsi Masuk</th>
                  <th>Porsi Sekarang</th>
                  <th>Keterangan</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($masuk->result() as $key): ?>
                <tr>
                  <td align="center"><?php echo $no++ ?></td>
                  <td><?php echo $key->kd_barang ?></td>
                  <td><?php echo $key->nm_barang ?></td>
                  <td align="center"><?php echo $key->masuk ?></td>
                  <td align="center"><?php echo $key->stok ?></td>
                  <td><?php echo $key->keterangan ?></td>
                  <td><?php echo $key->jam ?></td>
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
    $("#btnLihat").on('click', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      window.open(url, '_blank', 'location=yes,height=600,width=500,scrollbars=yes,status=yes');
    });

    </script>

</body>
</html>