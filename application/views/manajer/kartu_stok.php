<div class="content-wrapper">
  <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Kartu Stok Bahan</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" action="<?php echo base_url('manajer/view_kartu_stok/') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="kd_barang">Kode Bahan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kd_barang" name="kd_barang" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">LIHAT</button>
              </div>
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
      document.getElementById('kd_barang').focus();

    </script>

</body>
</html>