<?php if ($faktur): ?>
  <div><strong>No Faktur : </strong><?php echo $faktur->no_faktur_penjualan ?><span class="pull-right"><strong>Tanggal Transaksi : </strong><?php echo date_indo($faktur->tgl_penjualan) ?> <?php echo $faktur->waktu ?></span></div>

<?php endif?>
<table class="table table-condensed table-bordered" id="tbRetur">
    <tr>
      <th>Kode Produk</th>
      <th>Nama Produk</th>
      <th>Jumlah</th>
      <th style="text-align: right">Harga</th>
      <th style="text-align: right">Subtotal</th>
      <th style="text-align: center">Aksi</th>
    </tr>
    <?php if ($faktur): ?>
      <?php foreach ($list as $l): ?>
        <tr>
          <td><?php echo $l->kd_barang ?></td>
          <td><?php echo $l->nm_barang ?></td>
          <td style="text-align: center"><?php echo $l->jumlah ?></td>
          <td style="text-align: right"><?php echo number_format($l->harga, 0, ',', '.') ?></td>
          <td style="text-align: right"><?php echo number_format($l->sub_total_jual, 0, ',', '.') ?></td>
          <td style="text-align: center"><a href="javascript:void(0);" class="retur_item" data-nofak='<?php echo $l->no_faktur_penjualan ?>' data-kode='<?php echo $l->kd_barang ?>'>Retur</a></td>
        </tr>
    <?php endforeach;?>
    <?php else: ?>
      <?php echo "<tr><td colspan='5'>Data tidak ditemukan</td></tr>"; ?>
    <?php endif?>
</table>
<script>
   $(document).ready(function() {
        $('#tbRetur').on('click','.retur_item',function(){
            var nofak=$(this).data('nofak');
            var kode=$(this).data('kode');
            var kode_enk = btoa(kode);
            window.location.href = "<?php echo base_url('kasir/retur-item/') ?>"+nofak+"/"+kode_enk;
        });
    });
</script>