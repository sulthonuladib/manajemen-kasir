  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">DATA USER <span class="pull-right"><a href="" data-toggle="modal" data-target="#myModal">Tambah User</a></span></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <table id="tbUser" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th>ID User</th>
                  <th>Nama User</th>
                  <th>Hak Akses</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user->result() as $key): ?>
                <tr>
                  <td><?php echo $key->id_user ?></td>
                  <td><?php echo $key->nm_user ?></td>
                  <td><?php echo $key->akses ?></td>
                  <td align="center"><a href="javascript:void(0);" class="edit_record" data-id="<?php echo $key->id_user ?>" data-nama="<?php echo $key->nm_user ?>" data-akses="<?php echo $key->akses ?>">Edit</a> | <a href="javascript:void(0);" class="hapus_record" data-id="<?php echo $key->id_user ?>">Hapus</a></td>
                </tr>
                <?php endforeach?>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah User</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('manajer/simpan_user') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="id_user">ID User</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="id_user" name="id_user" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nm_user">Nama</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nm_user" name="nm_user" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="password">Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="akses">Akses</label>
              <div class="col-sm-5">
                <select name="akses" id="akses" class="form-control" required>
                  <option value="">Pilih Hak Akses</option>
                  <option value="manager">Manager</option>
                  <option value="admin">Admin</option>
                  <option value="gudang">Gudang</option>
                  <option value="kasir">Kasir</option>
                </select>
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
  <div class="modal fade" id="modalEdit" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('manajer/simpan_user_edit') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-3" for="id_user_e">ID User</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="id_user_e" name="id_user_e" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="nm_user_e">Nama</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nm_user_e" name="nm_user_e" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="password_e">Password Baru</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" id="password_e" placeholder="Kosongkan apabila tidak diganti" name="password_e">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="akses_e">Akses</label>
              <div class="col-sm-5">
                <select name="akses_e" id="akses_e" class="form-control" required>
                  <option value="">Pilih Hak Akses</option>
                  <option value="manager">Manager</option>
                  <option value="admin">Admin</option>
                  <option value="gudang">Gudang</option>
                  <option value="kasir">Kasir</option>
                </select>
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
</div>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
    <script>
      $('#tbUser').DataTable({
          "paging":   false,
          "ordering": false,
      });
      $('form').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error);

      $(document).ready(function() {
          $('#tbUser').on('click','.edit_record',function(){
              var id_user_e=$(this).data('id');
              var nm_user_e=$(this).data('nama');
              var akses_e=$(this).data('akses');
              $('#modalEdit').modal('show');
              $('[name="id_user_e"]').val(id_user_e);
              $('[name="nm_user_e"]').val(nm_user_e);
              $('[name="akses_e"]').val(akses_e);
          });

          $('#tbUser').on('click','.hapus_record',function(){
              var id=$(this).data('id');
              var result = confirm("Apakah yakin akan menghapus kode "+id+" ini?");
              var akses = "<?php echo $this->session->userdata('akses') ?>";
              if (akses == 'manager') {
                  if (result) {
                    window.location.href = '<?php echo base_url('manajer/hapus_user/') ?>'+id;
                  }
              }
          });
      });

      $("#id_user").keypress(function(e){
          if(e.which==32){
              return false;
          }
      });

    </script>

</body>
</html>