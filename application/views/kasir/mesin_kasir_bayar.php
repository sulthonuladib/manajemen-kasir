  <div class="content-wrapper" style="margin-bottom: 20px">
    <div style="margin-left: 20px;margin-right: 20px">
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <table style="width: 100%;height: 120px;">
                <tr>
                  <td style="font-size: 18pt">TOTAL</td>
                  <td align="right" style="font-size: 32pt"><strong><?php echo number_format($faktur->total_penjualan_sdiskon, 0, ',', '.') ?></strong></td>
                </tr>
                <tr>
                  <td style="font-size: 18pt;color: red;">KEMBALI</td>
                  <td align="right" style="font-size: 32pt;color: red;"><strong id="kembali">0</strong></td>
                </tr>
              </table>
              <hr>
              <div>
                <div class="form-inline">
                  <input type="hidden" name="nofak_dis" id="nofak_dis" value="<?php echo $faktur->no_faktur_penjualan ?>">
                  <input type="hidden" name="sum_belanja" id="sum_belanja" value="<?php echo $faktur->total_penjualan_sdiskon ?>">
                  <input style="text-align: right;" type="text" class="form-control pull-left" id="cash" placeholder="Cash (Rp)" name="cash">
                  <br><br>
                  <input style="text-align: right;" type="text" class="form-control pull-left" id="debet" placeholder="Debet (Rp)" name="debet">
                  <input type="text" class="form-control pull-right" id="bank" placeholder="Bank" name="bank">
                <br><br>
                <button id="btnHitung" class="btn btn-success pull-right">Hitung</button>
                </div>
              </div>
              <br><hr>
                <div>
                <form target="printstruk" id="formCetakStruk" class="form-inline" action="<?php echo base_url('kasir/cetak-struk/') ?>" onsubmit="window.open('about:blank','printstruk','width=500,height=400');" method="post">
                <input type="hidden" name="sum_print" id="sum_print" value="<?php echo $faktur->total_penjualan_sdiskon ?>">
                <input type="hidden" name="diskon_print" id="diskon_print" value="<?php echo $faktur->diskon ?>">
                <input type="hidden" name="nofak_print" id="nofak_print" value="<?php echo $faktur->no_faktur_penjualan ?>">
                <input type="hidden" name="cash_print" id="cash_print" value="0">
                <input type="hidden" name="debet_print" id="debet_print" value="0">
                <input type="hidden" name="bank_print" id="bank_print">
                <button onclick="newTransaksi();" type="submit" id="btnCetakStruk" class="btn btn-danger pull-right">PRINT</button>
                </form>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
                Faktur : <?php echo $faktur->no_faktur_penjualan ?><span class="pull-right"><?php echo date_indo($tgl) ?> <span id="waktu"></span></span>
            </div>
            <div class="panel-body">
            <table id="tbUser" class="table table-bordered table-responsive">
              <thead>
                <tr>
                  <td align="center">Aksi</td>
                  <td>Kode</td>
                  <td>Nama Barang</td>
                  <td align="right">Harga</td>
                  <td align="center">Jumlah</td>
                  <td align="center">Diskon %</td>
                  <td align="right">Subtotal</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list->result() as $key): ?>
                <tr>
                  <td align="center">Hapus</td>
                  <td><?php echo $key->kd_barang ?></td>
                  <td><?php echo substr($key->nm_barang, 0, 40) ?></td>
                  <td align="right"><?php echo number_format($key->harga, 0, ',', '.') ?></td>
                  <td align="center"><?php echo $key->jumlah ?></td>
                  <td align="center"><?php echo $key->diskonpersen ?> %</td>
                  <td align="right"><?php echo number_format($key->sub_total_jual, 0, ',', '.') ?></td>
                </tr>
<?php
$tot_item += $key->jumlah;
$tot_belanja += $key->sub_total_jual;
?>
                <?php endforeach?>
              </tbody>
              <tr>
                <td colspan="4" align="right"><strong>Total</strong></td>
                <td align="center"><strong><?php echo $tot_item ?> Items</strong></td>
                <td></td>
                <td align="right"><strong>Rp. <?php echo number_format($tot_belanja, 0, ',', '.') ?></strong></td>
              </tr>
            </table>
            </div>
          </div>
        </div>
    </div>
  </div>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <script src="<?php echo base_url() ?>/assets/js/jquery-3.3.1.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/toastr.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/jquery.price_format.min.js"></script>
    <script>
      $('form').attr('autocomplete', 'off');
      $('input').attr('autocomplete', 'off');
      $("ul.nav li.dropdown").hover(function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeIn(500)},function(){$(this).find(".dropdown-menu").stop(!0,!0).delay(100).fadeOut(500)});
      var pesan="<?php echo $this->session->flashdata('msg'); ?>",error="<?php echo $this->session->flashdata('error'); ?>";pesan?(toastr.options={positionClass:"toast-top-right"},toastr.success(pesan)):error&&swal(error,"","error");

      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('waktu').innerHTML = h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
      }

      function checkTime(i) {
          if (i < 10) {i = "0" + i};
          return i;
      }

    $(document).ready(function() {
        startTime();
        $('#cash').focus();
        $('#btnHitung').on('click',function(e){
            e.preventDefault();
            var belanja = $('#sum_belanja').val();
            var cash = $('#cash').val();
            var debet = $('#debet').val();
            var bank = $('#bank').val();
            var cash1 = cash.replace(/[^\d]/g,"");
            var debet1 = debet.replace(/[^\d]/g,"");
            var kembali = (Number(cash1)+Number(debet1))-Number(belanja);
            if (kembali<0) {
              alert("Uang tidak  cukup");
            } else {
              $("#kembali").html(convertToRupiah(kembali));
            }
        });
        $('#btnCetakStruk').on('click',function(e){
            var belanja = $('#sum_belanja').val();
            var cash = $('#cash_print').val();
            var debet = $('#debet_print').val();
            var kembali = (Number(cash)+Number(debet))-Number(belanja);
            if (kembali<0) {
              alert("Uang tidak  cukup");
              return false;
            } else {
              $('#formCetakStruk').submit(function() {
                window.open('about:blank','printstruk','width=500,height=400');
                this.target = 'printstruk';
                window.location.href = "<?php echo base_url('kasir/transaksi-selesai/') ?>";
              });
            }
        });

        function newTransaksi(){
          window.location.href = "<?php echo base_url('kasir/transaksi-selesai/') ?>";
        }

        $(function(){
          $('#cash').on("keyup",function(){
              var cash = $('#cash').val();
              var cash1 = cash.replace(/[^\d]/g,"");
              $('#cash_print').val(cash1);
          })
        });
        $(function(){
          $('#debet').on("keyup",function(){
              var debet = $('#debet').val();
              var debet1 = debet.replace(/[^\d]/g,"");
              $('#debet_print').val(debet1);
          })
        });
        $(function(){
          $('#bank').on("keyup",function(){
              var bank = $('#bank').val();
              $('#bank_print').val(bank);
          })
        });
      });

      function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
              return false;
          }
        return true;
      }

      $(function(){
          $('#cash').priceFormat({
                  prefix: '',
                  centsLimit: 0,
                  thousandsSeparator: '.'
          });
          $('#debet').priceFormat({
                  prefix: '',
                  centsLimit: 0,
                  thousandsSeparator: '.'
          });
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