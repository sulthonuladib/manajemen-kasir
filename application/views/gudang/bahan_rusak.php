<div class="content-wrapper">
  <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Bahan Rusak / Busuk / Cacat</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" action="<?php echo base_url('gudang/simpan_bahan_rusak') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="kd_bahan">Kode Bahan</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="kd_bahan" name="kd_bahan" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nm_bahan">Nama Bahan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nm_bahan" name="nm_bahan" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="porsi_sekarang">Porsi Sekarang</label>
              <div class="col-sm-1">
                <input type="text" class="form-control" id="porsi_sekarang" name="porsi_sekarang" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="rusak">Jumlah Rusak</label>
              <div class="col-sm-1">
                <input type="number" min="1" class="form-control" id="rusak" name="rusak" required>
              </div> Porsi
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="ket">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ket" name="ket" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" onclick="return confirm('Apakah kamu yakin?')" class="btn btn-default">Simpan</button>
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

      $(document).ready(function() {
          document.getElementById('kd_bahan').focus();
          $('#kd_bahan').on('input',function(){
          var kd_bahan=$('#kd_bahan').val();
              $.ajax({
                  type : "POST",
                  url  : "<?php echo base_url('gudang/get_detail_bahan') ?>",
                  dataType : "JSON",
                  data : {kd_bahan: kd_bahan},
                  cache: false,
                  success: function(data){
                      $.each(data,function(nm_barang){
                          $('[name="nm_bahan"]').val(data.nm_barang);
                          $('[name="porsi_sekarang"]').val(data.stok);
                      });
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                      $('[name="nm_bahan"]').val("");
                      $('[name="porsi_sekarang"]').val("");
              }
              });
            return false;
            });
      });

    </script>

</body>
</html>