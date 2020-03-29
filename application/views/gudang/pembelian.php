  <div class="content-wrapper" style="margin-bottom: 20px">
    <div class="container">
      <div class="row pad-botm">
          <div class="col-md-12">
              <h4 class="header-line">No. Faktur : <?php echo $faktur->no_faktur_pembelian ?></h4>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <table cellspacing="0">
              <thead>
                <tr>
                  <th align="left">Kode</th>
                  <th align="left">Nama Produk</th>
                  <th align="left">Kategori</th>
                  <th align="left">Harga</th>
                  <th align="left">Jumlah</th>
                  <th align="left">Satuan</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <input type="hidden" name="nofaktur" id="nofaktur" value="<?php echo $faktur->no_faktur_pembelian ?>">
                    <td><input type="text" style="width: 10em" name="idbarang" id="idbarang" class="form-control" placeholder="Kode produk" required autocomplete="off"></td>
                    <td><input type="text" style="width:25em" name="nm_barang" id="nm_barang" class="form-control" readonly></td>
                    <td><input type="text" style="width: 15em" name="nm_kategori" id="nm_kategori" class="form-control" readonly></td>
                    <td><input type="text" style="width: 7em" name="harga" id="harga" class="form-control" readonly></td>
                    <td><input type="number" style="width: 5em" min="1" name="jumlah" id="jumlah" class="form-control" onfocus="this.select();" oninput="validity.valid||(value='1');" onfocus="this.select();" value="1" required></td>
                    <td><input type="text" style="width: 7em" name="satuan" id="satuan" class="form-control" readonly></td>
                    <td><button type="submit" id="btn_add_list" class="btn btn-info">OK</button></td>
                    <input type="hidden" name="harga_beli" id="harga_beli">
                  </tr>
              </tbody>
          </table>
              <div class="alert alert-warning print-error-msg" role="alert" style="display:none"></div>
              <br>
              <table class="table table-condensed table-bordered" id="keranjang">
                <thead>
                  <tr>
                    <th style="text-align:center;">Aksi</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga Modal</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody id="show_data">
                </tbody>
              </table>
              <form action="<?php echo base_url('gudang/pembelian_selesai') ?>" id="formSelesai" class="form-inline" method="post">
              <input type="hidden" name="faktur_beli" id="faktur_beli" value="<?php echo $faktur->no_faktur_pembelian ?>">
              <input type="hidden" name="tot_harga" id="tot_harga">
              <button type="submit" id="btnSelesai" onclick="return confirm('Apakah sudah selesai?');" class="btn btn-info pull-right">SIMPAN</button>
              </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="ModalEdit" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Jumlah Beli</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?php echo base_url('gudang/simpan_edit_item_beli') ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-3" for="nofaktur_e">No. Faktur</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nofaktur_e" name="nofaktur_e" required readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="idbarang_e">Kode Barang</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="idbarang_e" name="idbarang_e" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="nm_barang_e">Nama</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="nm_barang_e" name="nm_barang_e" required>
              </div>
            </div>
            <input type="hidden" class="span6" id="harga_e" name="harga_e">
            <div class="form-group">
              <label class="control-label col-sm-3" for="jumlah_e">Edit Jumlah Beli</label>
              <div class="col-sm-5">
                <input type="number" style="width: 10em" min="1" name="jumlah_e" id="jumlah_e" class="form-control" onfocus="this.select();" oninput="validity.valid||(value='1');" onfocus="this.select();" value="1" required>
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
  </div>  <!-- Modal -->
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

  // Document ready cek start
  $(document).ready(function() {
    list_pembelian();
    document.getElementById('idbarang').focus();

    $('#idbarang').on('input',function(){
    $(".print-error-msg").css('display','none');
    var idbarang=$('#idbarang').val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('gudang/get_detail_produk') ?>",
            dataType : "JSON",
            data : {idbarang: idbarang},
            cache:false,
            success: function(data){
                $.each(data,function(namaproduk){
                    $('[name="nm_barang"]').val(data.namaproduk);
                    $('[name="nm_kategori"]').val(data.kategori);
                    $('[name="harga"]').val(convertToRupiah(data.harga_beli));
                    $('[name="harga_beli"]').val(data.harga_beli);
                    $('[name="satuan"]').val(data.satuan);
                });
            },
            error: function(jqXHR, textStatus, errorThrown){
                $('[name="nm_barang"]').val("");
                $('[name="nm_kategori"]').val("");
                $('[name="harga"]').val("");
                $('[name="harga_beli"]').val("");
                $('[name="satuan"]').val("");
        }
        });
      return false;
      });
    ///////////////////////////////////////////////////////////////////////////////////////////
    $('#btn_add_list').on('click',function(e){
        e.preventDefault();
        var idbarang=$('#idbarang').val();
        var nm_barang=$('#nm_barang').val();
        var jumlah=$('#jumlah').val();
        var harga_beli=$('#harga_beli').val();
        var nofaktur=$('#nofaktur').val();
        var satuan=$('#satuan').val();
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('gudang/add_list_pembelian') ?>",
                dataType : "JSON",
                data : {idbarang: idbarang, nm_barang:nm_barang, nofaktur:nofaktur, jumlah:jumlah, harga_beli:harga_beli,satuan:satuan},
                success: function(data){
                    $('[name="idbarang"]').val("");
                    $('[name="nm_barang"]').val("");
                    $('[name="nm_kategori"]').val("");
                    $('[name="harga"]').val("");
                    $('[name="satuan"]').val("");
                    $('[name="harga_beli"]').val("");
                    $('[name="jumlah"]').val("1");
                    $('[name="idbarang"]').focus();
                    $(".print-error-msg").css('display','none');
                    list_pembelian();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").html('Kode '+idbarang+' tidak terdaftar');
                    $('[name="idbarang"]').val("");
                    $('[name="nm_barang"]').val("");
                    $('[name="nm_kategori"]').val("");
                    $('[name="harga"]').val("");
                    $('[name="satuan"]').val("");
                    $('[name="harga_beli"]').val("");
                    $('[name="jumlah"]').val("1");
                    $('[name="idbarang"]').focus();
                }
            });
        });
    //////////////////////////////////////////////////////////////////////////////////////////////

      function list_pembelian() {
          $.ajax({
              type  : 'ajax',
              url   : '<?php echo base_url() ?>gudang/data_list_pembelian/<?php echo $this->uri->segment(3); ?>',
              async : true,
              dataType : 'json',
              success : function(data){
                  var html = '<p>Kosong</p>';
                  var i;
                  var total_item = 0;
                  var total_belanja = 0;
                  for(i=0; i<data.length; i++){
                      html += '<tr>'+
                              '<td style="text-align:center;">'+'<a href="javascript:;" class="item_hapus" data="'+data[i].kd_barang+'">Hapus</a>'+'</td>'+
                              '<td>'+data[i].kd_barang+'</td>'+
                              '<td>'+data[i].nm_barang+'</td>'+
                              '<td style="text-align:right;">'+convertToRupiah(data[i].harga)+'</td>'+
                              '<td style="text-align:center;">'+'<a href="javascript:;" class="item_edit" faktur="'+data[i].no_faktur_pembelian+'" idbarang="'+data[i].kd_barang+'" jumlah="'+data[i].jumlah+'" harga="'+data[i].harga+'" nama="'+data[i].nm_barang+'">'+data[i].jumlah+ ' '+data[i].satuan+'</a>'+'</td>'+
                              '<td style="text-align:right;">'+convertToRupiah(data[i].sub_total_beli)+'</td>'+
                              '</tr>';
                              total_item += parseInt(data[i].jumlah);
                              total_belanja += parseInt(data[i].sub_total_beli);
                          }
                          html += '<tr>'+
                                  '<th colspan="4" style="text-align:center; font-size : 14px;">Total</th>'+
                                  '<th style="text-align:center; font-size : 14px;">'+total_item+'</th>'+
                                  '<th style="text-align:right; font-size : 14px;">'+convertToRupiah(total_belanja)+'</th>'
                                  '</tr>';
                          $('#show_data').html(html);
                          $('[name="tot_harga"]').val(total_belanja);
                      }
                  });
              };
    //////////////////////////////////////////////////////////////////////////////////////////////
    $('#show_data').on('click','.item_hapus',function(){
          var idbarang= $(this).attr('data');
          var nofaktur = $('#nofaktur').val();
          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('gudang/hapus_item_beli') ?>",
            dataType : "JSON",
                    data : {idbarang:idbarang, nofaktur:nofaktur},
                    success: function(data){
                            list_pembelian();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        $(".print-error-msg").css('display','block');
                        $(".print-error-msg").html('Error Hapus Data');
                    }
                });
                return false;
      });
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $('#show_data').on('click','.item_edit',function(){
          var faktur=$(this).attr('faktur');
          var idbarang=$(this).attr('idbarang');
          var jumlah=$(this).attr('jumlah');
          var nama=$(this).attr('nama');
          var harga=$(this).attr('harga');
          $('#ModalEdit').modal('show');
          $(".print-error-edit").css('display','none');
          $('[name="nofaktur_e"]').val(faktur);
          $('[name="idbarang_e"]').val(idbarang);
          $('[name="jumlah_e"]').val(jumlah);
          $('[name="nm_barang_e"]').val(nama);
          $('[name="harga_e"]').val(harga);
          $('[name="jumlah_e"]').focus();
      });
    ///////////////////////////////////////////////////////////////////////////////////////////////
    $('#btnSimpan').on('click',function(){
          var nofaktur_e=$('#nofaktur_e').val();
          var idbarang_e=$('#idbarang_e').val();
          var jumlah_e=$('#jumlah_e').val();
          var harga_e=$('#harga_e').val();
          $.ajax({
              type : "POST",
              url  : "<?php echo base_url('gudang/simpan_edit_jumlah_beli') ?>",
              dataType : "JSON",
              data : {nofaktur_e:nofaktur_e, idbarang_e:idbarang_e, jumlah_e:jumlah_e, harga_e:harga_e},
              success: function(data){
                  $('[name="nofaktur_e"]').val("");
                  $('[name="idbarang_e"]').val("");
                  $('[name="jumlah_e"]').val("");
                  $('[name="harga_e"]').val("");
                  $('#ModalEdit').modal('hide');
                  console.log(data);
                  list_pembelian();
              },
              error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
                  $(".print-error-edit").css('display','block');
                  $(".print-error-edit").html('Edit tidak tersimpan');
                  list_pembelian();
              }
          });
          return false;
      });

  });

// End Document ready

  $("#idbarang").keypress(function(e){
      if(e.which==13){
          $("#jumlah").focus();
          return false;
      }
  });
  $("#jumlah").keypress(function(e){
      if(e.which==13){
          document.getElementById("btn_add_list").click();
          return false;
      }
  });

  function convertToRupiah(angka){
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return rupiah.split('',rupiah.length-1).reverse().join('');
  };

</script>

</body>
</html>