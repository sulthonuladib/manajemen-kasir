  <!-- MENU SECTION END-->

<div class="formSidebar w3-bar-block" style="right:0;padding:10px;" id="rightMenu">
  <button id="judul" onclick="tutupSideForm()" class="w3-bar-item">&times; Close Sidebar</button>
      <form id="formTambah" action="<?php echo base_url('gudang/simpan_kategori') ?>" method="post">
        <table border="0" class="table" align="center">
          <tr>
            <td>Kode Kategori</td>
            <td>:</td>
            <td ><input name="kd_kategori" type="text" id="kd_kategori" /></td>
          </tr>
          <tr>
            <td>Nama Kategori</td>
            <td>:</td>
            <td><input type="text" name="nm_kategori" id="nm_kategori" /></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>
              <input type="submit" class="btn" name="button_tambah" id="button_tambah" value="Simpan" />
              <input type="reset" class="btn btn-primary" name="button_reset" id="button_reset" value="Reset" />
            </td>
          </tr>
        </table>
      </form>
</div>
    <div id="main-isi">
        <div class="w3-teal">
          <button id="bukaSide" class="w3-button w3-teal w3-right" onclick="openRightMenu()">&#9776;</button>
            <div class="w3-container">
              <h3>KATEGORI BARANG <span class="pull-right"><a href="">Tambah Data</a></span></h3>
            </div>
        </div>
          <div class="w3-container" style="padding:20px;margin-bottom: 10px">
                <table id="tbKategori" class="table table-bordered table-striped table-responsive">
                  <thead>
                    <tr>
                      <th>Kode Kategori</th>
                      <th>Nama Kategori</th>
                      <th class="td-actions" align="center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($kategori->result() as $key): ?>
                    <tr>
                      <td><?php echo $key->kd_kategori ?></td>
                      <td><?php echo $key->nm_kategori ?></td>
                      <td style="text-align: center;"><a href="javascript:void(0);" class="edit_record" data-kode="<?php echo $key->kd_kategori ?>" data-nama="<?php echo $key->nm_kategori ?>">Edit</a></td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
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
      $('#tbKategori').DataTable({
      });
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);
      function openRightMenu(){document.getElementById("main-isi").style.marginRight="35%",document.getElementById("main-isi").style.marginRight="35%",document.getElementById("rightMenu").style.width="35%",document.getElementById("rightMenu").style.display="block",document.getElementById("bukaSide").style.display="none"}function tutupSideForm(){document.getElementById("rightMenu").style.display="none",document.getElementById("main-isi").style.marginRight="0%",document.getElementById("bukaSide").style.display="block"}

      $( document ).ready(function() {
          document.getElementById("main-isi").style.marginRight = "35%";
          document.getElementById("rightMenu").style.width = "35%";
          document.getElementById("bukaSide").style.display = "none";
          $('#tbKategori').on('click','.edit_record',function(){
              var kode=$(this).data('kode');
              var nama=$(this).data('nama');
              $('#formTambah').attr('action', '<?php echo base_url('gudang/simpan_kategori_edit') ?>');
              $('#kd_kategori').prop('readonly', true);
              document.getElementById("judul").innerHTML = "&times; Edit Data";
              openRightMenu();
              $('[name="kd_kategori"]').val(kode);
              $('[name="nm_kategori"]').val(nama);
          });
      });

    </script>

</body>
</html>