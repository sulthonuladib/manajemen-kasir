  <!-- MENU SECTION END-->
<div class="formSidebar w3-bar-block" style="right:0;padding:10px;" id="rightMenu">
  <button id="judul" onclick="tutupSideForm()" class="w3-bar-item">&times; Close Sidebar</button>
      <form id="formTambah" action="<?php echo base_url('gudang/simpan_edit_stok') ?>" method="post">
        <table border="0" class="table" align="center">
          <tr>
            <td>Kode Barang</td>
            <td>:</td>
            <td ><input name="kd_barang" type="text" id="kd_barang" required readonly/></td>
          </tr>
          <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nm_barang" id="nm_barang" required readonly/></td>
          </tr>
          <tr id="row-stok">
            <td>Stok</td>
            <td>:</td>
            <td>
              <input type="number" name="stok" id="stok" min="0" required />
              <input type="hidden" name="sebelumnya" id="sebelumnya" required />
            </td>
          </tr>
          <tr id="row-min">
            <td>Stok Minimal</td>
            <td>:</td>
            <td><input type="number" name="stok_min" id="stok_min" min="0" required /></td>
          </tr>
          <tr id="row-publish">
            <td>Publish Data?</td>
            <td>:</td>
            <td>
              <select name="publish" id="publish">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
              </select>
            </td>
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
              <h3>EDIT STOK <span></span></h3>
            </div>
        </div>
          <div class="w3-container" style="padding:20px;margin-bottom: 10px">
                <table id="tbBarang" class="table table-bordered table-striped table-responsive" style="width:100%">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Nama Barang</th>
                      <th>Kategori</th>
                      <th>Stok</th>
                      <th>Stok Min</th>
                      <th class="td-actions" align="center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
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
    <script src="<?php echo base_url() ?>/assets/js/jquery.price_format.min.js"></script>
    <script>
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);
      function openRightMenu(){document.getElementById("main-isi").style.marginRight="35%",document.getElementById("main-isi").style.marginRight="35%",document.getElementById("rightMenu").style.width="35%",document.getElementById("rightMenu").style.display="block",document.getElementById("bukaSide").style.display="none"}function tutupSideForm(){document.getElementById("rightMenu").style.display="none",document.getElementById("main-isi").style.marginRight="0%",document.getElementById("bukaSide").style.display="block"};
      function convertToRupiah(r){for(var e="",t=r.toString().split("").reverse().join(""),n=0;n<t.length;n++)n%3==0&&(e+=t.substr(n,3)+".");return e.split("",e.length-1).reverse().join("")};

      $( document ).ready(function() {
          document.getElementById("main-isi").style.marginRight = "35%";
          document.getElementById("rightMenu").style.width = "35%";
          document.getElementById("bukaSide").style.display = "none";
          $('#tbBarang').on('click','.edit_record',function(){
              var kode=$(this).data('kode');
              var nama=$(this).data('nama');
              var stok=$(this).data('stok');
              var stok_min=$(this).data('stok_min');
              openRightMenu();
              $('[name="kd_barang"]').val(kode);
              $('[name="nm_barang"]').val(nama);
              $('[name="stok"]').val(stok);
              $('[name="sebelumnya"]').val(stok);
              $('[name="stok_min"]').val(stok_min);
          });
      });

      $('#tbBarang').DataTable({
        "columnDefs": [
            {"className": "dt-center", "targets": [3,4,5]},
            {"orderable": false, "targets": 5 }],
        "processing": true,
        "serverSide": true,
            "ajax": {
                "url": '<?php echo base_url(); ?>gudang/json_edit_stok',
                "type": "POST",
            },
            "columns": [
                {"data": "kd_barang"},
                {"data": "nm_barang"},
                {"data": "nm_kategori"},
                {"data": "stok"},
                {"data": "stok_min"},
                {"data": "Aksi"},
            ],
        });

    </script>

</body>
</html>