  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">LAPORAN BIAYA</h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12" align="center">
            <form class="form-inline" target="_blank" action="<?php echo base_url('laporan/view-biaya/') ?>" method="post">
                <div class="form-group">
                  <label for="bulan">Bulan :</label>
                    <select name="bulan" id="bulan" class="form-control" required>
                      <option <?php if ($bulan == '01') {echo 'selected';}?> value="01">Januari</option>
                      <option <?php if ($bulan == '02') {echo 'selected';}?> value="02">Februari</option>
                      <option <?php if ($bulan == '03') {echo 'selected';}?> value="03">Maret</option>
                      <option <?php if ($bulan == '04') {echo 'selected';}?> value="04">April</option>
                      <option <?php if ($bulan == '05') {echo 'selected';}?> value="05">Mei</option>
                      <option <?php if ($bulan == '06') {echo 'selected';}?> value="06">Juni</option>
                      <option <?php if ($bulan == '07') {echo 'selected';}?> value="07">Juli</option>
                      <option <?php if ($bulan == '08') {echo 'selected';}?> value="08">Agustus</option>
                      <option <?php if ($bulan == '09') {echo 'selected';}?> value="09">September</option>
                      <option <?php if ($bulan == '10') {echo 'selected';}?> value="10">Oktober</option>
                      <option <?php if ($bulan == '11') {echo 'selected';}?> value="11">November</option>
                      <option <?php if ($bulan == '12') {echo 'selected';}?> value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="tahun">Tahun : </label>
                    <select name="tahun" id="tahun" class="form-control" required>
                      <?php for ($i = 2016; $i <= date('Y'); $i++) {?>
                      <option <?php if ($i == date('Y')) {echo 'selected';}?> value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php }?>
                    </select>
                </div><br><br>
              <div>
                  <input type="submit" class="btn btn-warning" name="action" value="Rekap" />
                  <input type="submit" class="btn btn-success" name="action" value="Rinci" />
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