<div class="content-wrapper">
  <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Mutasi Barang</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div class="alert alert-warning print-error-msg" role="alert" style="display:none"></div>
          <form class="form-horizontal" id="formMutasi" action="<?php echo base_url('kasir/simpan_mutasi') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="nm_toko">Nama Toko</label>
              <div class="col-sm-5">
                <select name="jenis_mutasi" id="jenis_mutasi" class="form-control" required>
                  <option value="">Pilih Jenis Mutasi</option>
                  <option value="Masuk">Mutasi Masuk</option>
                  <option value="Keluar">Mutasi Keluar</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kd_barang">Kode Produk</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kd_barang" name="kd_barang" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nm_produk">Nama Produk</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nm_produk" name="nm_produk" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="stok">Stok Sekarang</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="stok" name="stok" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jumlah">Jumlah Mutasi</label>
              <div class="col-sm-2">
                <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="ket">Keterangan</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="ket" name="ket" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" id="btnSimpanMutasi" class="btn btn-default">Simpan</button>
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
    <script src="<?php echo base_url() ?>/assets/js/jquery.price_format.min.js"></script>
    <script>
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);

    $('#btnSimpanMutasi').on('click',function(e){
      e.preventDefault();
      var jenis = $('#jenis_mutasi').val();
      var kode = $('#kd_barang').val();
      var jumlah = $('#jumlah').val();
      var nama = $('#nm_produk').val();
      if (jenis == "" || kode == "" || jumlah == "") {
        $(".print-error-msg").css('display','block');
            $(".print-error-msg").html('Lengkapi isi data');
          } else if (nama == "") {
            $(".print-error-msg").css('display','block');
                $(".print-error-msg").html('Kode barang tidak terdaftar');
          }
            else {
              swal({
                    title: "Yakin data sudah benar?",
                    buttons: true,
              })
              .then((simpan) => {
                    if (simpan) {
                  document.getElementById("formMutasi").submit();
                }
              });
            }
      });

      $(document).ready(function() {
        $('#kd_barang').on('input',function(){
        var idbarang=$('#kd_barang').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('kasir/get_detail_produk') ?>",
                dataType : "JSON",
                data : {idbarang: idbarang},
                cache:false,
                success: function(data){
                    $.each(data,function(namaproduk){
                        $('[name="nm_produk"]').val(data.namaproduk);
                        $('[name="stok"]').val(data.stok);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('[name="nm_produk"]').val("");
                    $('[name="stok"]').val("");
            }
            });
          return false;
          });
      });
    </script>

</body>
</html>