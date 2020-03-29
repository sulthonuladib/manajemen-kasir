  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">STOK PORSI PER BAHAN <?php echo $tgl ?></h4>
          </div>
      </div>
  <div style="margin-bottom: 20px">
  <form class="form-inline" action="" method="get">
      <div class="form-group">
        <label for="email">Kategori:</label>
        <select name="category" id="category" class="form-control">
          <option value="wow">SEMUA KATEGORI</option>
          <?php foreach ($kategori->result() as $key): ?>
              <option <?php if ($kat == $key->kd_kategori) {echo 'selected';}?> value="<?php echo $key->kd_kategori ?>"><?php echo $key->nm_kategori ?></option>
          <?php endforeach?>
        </select>
      </div>
      <div class="form-group">
        <label for="pwd">Stok:</label>
        <select name="sort_stok" id="sort_stok" class="form-control">
          <option <?php if ($sort == 'more') {echo 'selected';}?> value="more">Di atas 0</option>
          <option <?php if ($sort == 'all') {echo 'selected';}?> value="all">SEMUA</option>
          <option <?php if ($sort == 'empty') {echo 'selected';}?> value="empty">0</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default">Filter</button>
      <a href="<?php echo base_url('gudang/stok/') ?>"><button type="button" class="btn btn-success">Reset</button></a>
  </form>
</div>
      <div class="row">
        <div class="col-md-12">
            <table id="tbStok" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th>Harga Modal</th>
                  <th>Porsi Stok</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($stok->result() as $key): ?>
                <tr>
                  <td><?php echo $key->kd_barang ?></td>
                  <td><?php echo $key->nm_barang ?></td>
                  <td><?php echo $key->nm_kategori ?></td>
                  <td><?php echo $key->nm_satuan ?></td>
                  <td align="right"><?php echo number_format($key->hrg_beli, 0, ',', '.') ?></td>
                  <td align="center"><?php echo $key->stok ?></td>
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
            'copy', 'csv', 'pdf', 'print'
        ]
      });
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);

    </script>

</body>
</html>