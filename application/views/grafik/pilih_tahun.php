  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">GRAFIK PENJUALAN TAHUNAN</h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <form class="form-inline" target="_blank" action="<?php echo base_url('grafik/grafik-penjualan-tahunan') ?>" method="post">
                <div class="form-group">
                  <label for="email" style="width: 100px">Tahun : </label>
                    <select name="tahun" id="tahun" class="form-control" required>
                      <option value="">Pilih Tahun</option>
                      <?php foreach ($tahun as $key): ?>
                        <option <?php if ($year == $key['thn']) {echo 'selected';}?> value="<?php echo $key['thn'] ?>"><?php echo $key['thn'] ?></option>
                      <?php endforeach?>
                    </select>
                </div><br><br>
              <div style="margin-left: 100px">
                <button type="submit" id="btnSimpanBiaya" class="btn btn-success">LIHAT</button>
              </div>
         </form>
        </div>
      </div>
    </div>
  </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; Copyright <?php echo date('Y') ?>, <a href="https://alele-solutions.com" target="_blank">Alele Solutions</a>
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/dataTables.buttons.min.js"></script>
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