<!-- MENU SECTION END-->
<div class="formSidebar w3-bar-block" style="right:0;padding:10px;" id="rightMenu">
  <button id="judul" onclick="tutupSideForm()" class="w3-bar-item">&times; Close Sidebar</button>
      <form id="formTambah" action="<?php echo base_url('gudang/simpan_barang') ?>" method="post">
        <table border="0" class="table" align="center">
          <tr>
            <td>Kode Bahan</td>
            <td>:</td>
            <td ><input name="kd_barang" type="text" id="kd_barang" required /></td>
          </tr>
          <tr>
            <td>Nama Bahan</td>
            <td>:</td>
            <td><input type="text" name="nm_barang" id="nm_barang" required /></td>
          </tr>
          <tr>
            <td>Satuan</td>
            <td>:</td>
            <td>
                <select name="kd_satuan" id="kd_satuan" required>
                    <option value="">Pilih Satuan</option>
                    <?php foreach ($satuan->result() as $key): ?>
                        <option value="<?php echo $key->kd_satuan ?>"><?php echo $key->nm_satuan ?></option>
                    <?php endforeach?>
                </select>
            </td>
          </tr>
          <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>
                <select name="kd_kategori" id="kd_kategori" class="span6" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori->result() as $key): ?>
                        <option value="<?php echo $key->kd_kategori ?>"><?php echo $key->nm_kategori ?></option>
                    <?php endforeach?>
                </select>
            </td>
          </tr>
          <tr>
            <td>Harga Beli</td>
            <td>:</td>
            <td><input type="text" name="hrg_beli" id="hrg_beli" required /></td>
          </tr>
          <tr>
            <td>Bahan Untuk</td>
            <td>:</td>
            <td><input style="width: 100px" type="number" min="1" name="estimasi_stok" id="estimasi_stok" required /> Porsi</td>
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
              <h3>DATA BAHAN <span class="pull-right"><a href="">Tambah Data</a></span></h3>
            </div>
        </div>
          <div class="w3-container" style="padding:20px;margin-bottom: 10px">
                <table id="tbBarang" class="table table-bordered table-striped table-responsive" style="width:100%">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Nama Bahan</th>
                      <th>Kategori</th>
                      <th>Satuan</th>
                      <th>Porsi/Satuan</th>
                      <th>Harga Beli</th>
                      <th>Modal / Porsi</th>
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
      function openRightMenu(){document.getElementById("main-isi").style.marginRight="30%",document.getElementById("main-isi").style.marginRight="30%",document.getElementById("rightMenu").style.width="30%",document.getElementById("rightMenu").style.display="block",document.getElementById("bukaSide").style.display="none"}function tutupSideForm(){document.getElementById("rightMenu").style.display="none",document.getElementById("main-isi").style.marginRight="0%",document.getElementById("bukaSide").style.display="block"};
      function convertToRupiah(r){for(var e="",t=r.toString().split("").reverse().join(""),n=0;n<t.length;n++)n%3==0&&(e+=t.substr(n,3)+".");return e.split("",e.length-1).reverse().join("")};

      $( document ).ready(function() {
          document.getElementById("main-isi").style.marginRight = "30%";
          document.getElementById("rightMenu").style.width = "30%";
          document.getElementById("bukaSide").style.display = "none";
          $('#tbBarang').on('click','.edit_record',function(){
              var kode=$(this).data('kode');
              var nama=$(this).data('nama');
              var satuan=$(this).data('satuan');
              var kategori=$(this).data('kategori');
              var hrg_beli=$(this).data('beli');
              var porsi=$(this).data('porsi');
              $('#formTambah').attr('action', '<?php echo base_url('gudang/simpan_barang_edit') ?>');
              $('#kd_barang').prop('readonly', true);
              document.getElementById("judul").innerHTML = "&times; Edit Data";
              openRightMenu();
              $('[name="kd_barang"]').val(kode);
              $('[name="nm_barang"]').val(nama);
              $('[name="kd_satuan"]').val(satuan);
              $('[name="kd_kategori"]').val(kategori);
              $('[name="estimasi_stok"]').val(porsi);
              $('[name="hrg_beli"]').val(convertToRupiah(hrg_beli));
          });

          $('#tbBarang').on('click','.hapus_record',function(){
                  var kode=$(this).data('kode');
                  var result = confirm("Apakah yakin akan menghapus kode "+kode+" ini?");
                  var akses = "<?php echo $this->session->userdata('akses') ?>";
                  if (akses == 'manager') {
                      if (result) {
                        window.location.href = '<?php echo base_url('gudang/hapus_barang/') ?>'+kode;
                      }
                  }
          });
      });

      $('#tbBarang').DataTable({
        "columnDefs": [
            {"className": "dt-right", "targets": [5,6]},
            {"className": "dt-center", "targets": [4,7]},
            {"orderable": false, "targets": 7}],
        "processing": true,
        "serverSide": true,
            "ajax": {
                "url": '<?php echo base_url(); ?>gudang/json_produk',
                "type": "POST",
            },
            "columns": [
                {"data": "kd_barang"},
                {"data": "nm_barang"},
                {"data": "nm_kategori"},
                {"data": "nm_satuan"},
                {"data": "estimasi_stok"},
                {"data": "hrg_beli",render: $.fn.dataTable.render.number( '.', '.', 0 )},
                {"data": "modal_per_porsi",render: $.fn.dataTable.render.number( '.', '.', 0 )},
                {"data": "Aksi"},
            ],
        });

    $(function(){
        $('#hrg_beli').priceFormat({
                prefix: '',
                centsLimit: 0,
                thousandsSeparator: '.'
        });
    });

    </script>

</body>
</html>