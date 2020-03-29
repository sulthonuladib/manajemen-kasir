  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">DATA BARANG YANG KURANG DARI JUMLAH MINIMAL <?php echo date_indo(date('Y-m-d')) ?></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <table id="tbStok" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Harga Jual</th>
                  <th>Harga Beli</th>
                  <th>Stok</th>
                  <th>Stok Minimal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($stok->result() as $key): ?>
                <tr>
                  <td><?php echo $key->kd_barang ?></td>
                  <td><?php echo $key->nm_barang ?></td>
                  <td><?php echo $key->nm_kategori ?></td>
                  <td align="right"><?php echo number_format($key->hrg_jual, 0, '.', ',') ?></td>
                  <td align="right"><?php echo number_format($key->hrg_beli, 0, '.', ',') ?></td>
                  <td align="center"><?php echo $key->stok ?></td>
                  <td align="center"><?php echo $key->stok_min ?></td>
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
    <script src="<?php echo base_url() ?>/assets/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jszip.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/vfs_fonts.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
    <script>
      $('#tbStok').DataTable({
          "paging":   false,
          "ordering": false,
          "info":     false,
          "dom": 'Bfrtip',
          "buttons": [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);

    </script>

</body>
</html>