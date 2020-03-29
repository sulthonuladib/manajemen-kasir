  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">DAFTAR MENU <span class="pull-right no-print"><a href="" data-toggle="modal" data-target="#myModal">Tambah Menu</a></span></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-success no-print" onclick="window.print();return false;">Print</button>
          <table id="tbUser" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Menu</th>
                <th>Nama Menu</th>
                <th class="no-print">Item Bahan</th>
                <th>Harga Modal</th>
                <th>Harga Jual</th>
                <th class="no-print">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($paket->result() as $key) : ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $key->kode_menu ?></td>
                  <td><?php echo $key->nama_menu ?></td>
                  <td class="no-print" align="center"><?php echo $key->item_bahan ?> Item</td>
                  <td align="right"><?php echo number_format($key->harga_modal, 0, ',', '.') ?></td>
                  <td align="right"><?php echo number_format($key->harga_jual, 0, ',', '.') ?></td>
                  <td class="no-print" align="center"><a href="javascript:void(0);" class="update-record" data-kode_menu="<?php echo $key->kode_menu; ?>" data-nama="<?php echo $key->nama_menu; ?>" data-harga="<?php echo $key->harga_jual; ?>">Edit</a> | <a href="javascript:void(0);" class="delete-record" data-kode_menu="<?php echo $key->kode_menu ?>">Hapus</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Tambah -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Menu</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('gudang/simpan_data_menu') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-3" for="kode_menu">Kode Menu</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kode_menu" name="kode_menu" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="nama_menu">Nama Menu</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="bahan_utama">Bahan Utama</label>
              <div class="col-sm-5">
                <select name="bahan_utama[]" id="bahan_utama" class="bootstrap-select" data-live-search="true" multiple required>
                  <?php foreach ($bahan_utama->result() as $key) : ?>
                    <option value="<?php echo $key->kd_barang; ?>"><?php echo $key->nm_barang; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="bahan_tambahan">Bahan Tambahan</label>
              <div class="col-sm-5">
                <select name="bahan_tambahan[]" id="bahan_tambahan" class="bootstrap-select" data-live-search="true" multiple>
                  <?php foreach ($bahan_tambahan->result() as $key) : ?>
                    <option value="<?php echo $key->kd_barang; ?>"><?php echo $key->nm_barang; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="harga_jual">Harga Jual</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="harga_jual" name="harga_jual" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="btnSimpan" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Update -->
  <div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Menu</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('gudang/simpan_edit_menu') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-3" for="kode_menu_e">Kode Menu</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="kode_menu_e" name="kode_menu_e" readonly="readonly" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="nama_menu_e">Nama Menu</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nama_menu_e" name="nama_menu_e" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="bahan_utama_e">Bahan Utama</label>
              <div class="col-sm-5">
                <select name="bahan_utama_e[]" id="bahan_utama_e" class="bootstrap-select strings" data-live-search="true" multiple required>
                  <?php foreach ($bahan_utama->result() as $key) : ?>
                    <option value="<?php echo $key->kd_barang; ?>"><?php echo $key->nm_barang; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="bahan_tambahan_e">Bahan Tambahan / Topping</label>
              <div class="col-sm-5">
                <select name="bahan_tambahan_e[]" id="bahan_tambahan_e" class="bootstrap-select strings2" data-live-search="true" multiple>
                  <?php foreach ($bahan_tambahan->result() as $key) : ?>
                    <option value="<?php echo $key->kd_barang; ?>"><?php echo $key->nm_barang; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="harga_jual_e">Harga Jual</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="harga_jual_e" name="harga_jual_e" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" id="btnSimpan" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Hapus -->
  <div class="modal fade" id="modalHapus" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Menu</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('gudang/hapus_menu') ?>" method="post">
            <h4>Apakah Kamu Yakin Menghapus Data Menu Ini?</h4>
        </div>
        <input type="hidden" id="kode_menu_h" name="kode_menu_h">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          <button type="submit" id="btnHapus" class="btn btn-primary">Ya</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <section class="footer-section no-print">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          &copy; Copyright <?php echo date('Y') ?>, <a href="https://github.com/sulthonuladib" target="_blank">B E D O K</a>
        </div>
      </div>
    </div>
  </section>
  </div>
  <!-- FOOTER SECTION END-->
  <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
  <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/jquery.price_format.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/js/bootstrap-select.min.js"></script>
  <script>
    $('#tbUser').DataTable({
      "paging": false,
      "ordering": false,
      "info": false,
    });
    $('form').attr('autocomplete', 'off');
    $("ul.nav li.dropdown").hover(function() {
      $(this).find(".dropdown-menu").stop(!0, !0).delay(100).fadeIn(500)
    }, function() {
      $(this).find(".dropdown-menu").stop(!0, !0).delay(100).fadeOut(500)
    });
    var pesan = "<?php echo $this->session->flashdata('msg'); ?>",
      error = "<?php echo $this->session->flashdata('error'); ?>";
    pesan ? (toastr.options = {
      positionClass: "toast-top-right"
    }, toastr.success(pesan)) : error && swal(error);

    function convertToRupiah(r) {
      for (var e = "", t = r.toString().split("").reverse().join(""), n = 0; n < t.length; n++) n % 3 == 0 && (e += t.substr(n, 3) + ".");
      return e.split("", e.length - 1).reverse().join("")
    };

    $(document).ready(function() {
      $('.bootstrap-select').selectpicker();
      $('.update-record').on('click', function() {
        var kode_menu = $(this).data('kode_menu');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        $(".strings").val('');
        $(".strings2").val('');
        $('#modalEdit').modal('show');
        $('[name="kode_menu_e"]').val(kode_menu);
        $('[name="nama_menu_e"]').val(nama);
        $('[name="harga_jual_e"]').val(convertToRupiah(harga));
        //AJAX REQUEST TO GET SELECTED PRODUCT
        $.ajax({
          url: "<?php echo base_url('gudang/get_bahan_by_menu'); ?>",
          method: "POST",
          data: {
            kode_menu: kode_menu
          },
          cache: false,
          success: function(data) {
            var item = data;
            var val1 = item.replace("[", "");
            var val2 = val1.replace("]", "");
            var values = val2;
            var akhir = values.replace(/['"]+/g, '');
            $.each(akhir.split(","), function(i, e) {
              $(".strings option[value='" + e + "']").prop("selected", true).trigger('change');
              $(".strings").selectpicker('refresh');
              $(".strings2 option[value='" + e + "']").prop("selected", true).trigger('change');
              $(".strings2").selectpicker('refresh');
            });
          }

        });
        return false;
      });

      //GET CONFIRM DELETE
      $('.delete-record').on('click', function() {
        var kode = $(this).data('kode_menu');
        $('#modalHapus').modal('show');
        $('[name="kode_menu_h"]').val(kode);
      });
    });

    $(function() {
      $('#harga_jual').priceFormat({
        prefix: '',
        centsLimit: 0,
        thousandsSeparator: '.'
      });
    });
    $(function() {
      $('#harga_jual_e').priceFormat({
        prefix: '',
        centsLimit: 0,
        thousandsSeparator: '.'
      });
    });
  </script>

  </body>

  </html>