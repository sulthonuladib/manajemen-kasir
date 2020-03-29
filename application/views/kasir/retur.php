<div class="content-wrapper">
  <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">RETUR BARANG</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-warning print-error-msg" role="alert" style="display:none"></div>
          <form class="form-inline" id="formRetur" action="" method="post">
              <div class="form-group">
                <label for="pwd">Nomor Faktur : </label>
                  <input type="text" class="form-control" id="nofak" name="nofak" required>
              </div>
              <button type="submit" id="btnLihatRetur" class="btn btn-default">LIHAT</button>
          </form>
          <br>
            <div id="view" class="span8">

            </div>
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
    <script src="<?php echo base_url() ?>/assets/js/jquery.price_format.min.js"></script>
    <script>
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);

      $(document).ready(function() {
        $("#btnLihatRetur").click(function(e){
         e.preventDefault();
         var nofak=$('#nofak').val();
         $(this).html("SEARCHING...").attr("disabled", "disabled");
            $.ajax({
              url: '<?php echo base_url('kasir/get_data_faktur') ?>',
              type: 'POST',
              data: {nofak:nofak},
              dataType: "json",
              beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                  e.overrideMimeType("application/json;charset=UTF-8");
                }
              },
              success: function(response){
                $("#btnLihatRetur").html("LIHAT").removeAttr("disabled");
                $("#view").html(response.hasil);
              },
              error: function (xhr, ajaxOptions, thrownError) {
                $("#btnLihatRetur").html("LIHAT").removeAttr("disabled");
                $(".print-error-msg").css('display','block');
                $(".print-error-msg").html('Nomor faktur tidak ditemukan');
              }
            });
          });
    });
    </script>

</body>
</html>