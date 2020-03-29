<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_model extends CI_Model {

	public function get_toko() {
		$query = $this->db->query("SELECT * FROM tabel_toko LIMIT 1");
		return $query->row();
	}

	public function get_detail_produk($idbarang) {
		$hsl = $this->db->query("SELECT tabel_stok_toko.stok, tabel_barang.nm_barang, tabel_satuan_barang.nm_satuan, tabel_barang.hrg_beli, tabel_barang.hrg_jual, tabel_kategori_barang.nm_kategori FROM tabel_barang LEFT JOIN tabel_stok_toko ON tabel_barang.kd_barang = tabel_stok_toko.kd_barang LEFT JOIN tabel_kategori_barang ON tabel_barang.kd_kategori = tabel_kategori_barang.kd_kategori LEFT JOIN tabel_satuan_barang ON tabel_barang.kd_satuan = tabel_satuan_barang.kd_satuan WHERE tabel_barang.kd_barang='$idbarang'");
		if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'namaproduk' => $data->nm_barang,
					'stok' => $data->stok,
					'harga' => $data->hrg_jual,
					'kategori' => $data->nm_kategori,
					'harga_beli' => $data->hrg_beli,
					'satuan' => $data->nm_satuan,
				);
			}
		}
		return $hasil;
	}

	public function cek_stok_mutasi($kode) {
		return $this->db->query("SELECT * FROM tabel_stok_toko WHERE kd_barang='$kode'");
	}

	public function get_list($nofak) {
		return $this->db->select('tabel_rinci_penjualan.*')
			->where('tabel_rinci_penjualan.no_faktur_penjualan', $nofak)
			->get('tabel_rinci_penjualan')
			->result();
	}

	public function detail_faktur($nofak) {
		return $this->db->select('tabel_penjualan.*')
			->where('tabel_penjualan.no_faktur_penjualan', $nofak)
			->where('tabel_penjualan.selesai', '1')
			->get('tabel_penjualan')
			->row();
	}

	public function getProdukRetur($nofak, $kd_barang) {
		return $this->db->select('tabel_rinci_penjualan.*')
			->where('tabel_rinci_penjualan.no_faktur_penjualan', $nofak)
			->where('tabel_rinci_penjualan.kd_barang', $kd_barang)
			->get('tabel_rinci_penjualan');
	}

	public function getStokRetur($kd_barang) {
		return $this->db->query("SELECT * FROM tabel_stok_toko WHERE kd_barang='$kd_barang'");
	}

	public function dataTransaksiHariIni($tgl) {
		return $this->db->select('tabel_penjualan.*')
			->where('tabel_penjualan.tgl_penjualan', $tgl)
			->where('tabel_penjualan.selesai', '1')
			->order_by('no_faktur_penjualan')
			->get('tabel_penjualan');
	}

	public function dataPengeluaranHariIni($tgl) {
		return $this->db->select('tabel_biaya.*')
			->where('tabel_biaya.tgl', $tgl)
			->where('tabel_biaya.id_user', 'kasir')
			->order_by('id')
			->get('tabel_biaya');
	}

	public function dataPengeluaranHariIniAll($tgl) {
		return $this->db->select('tabel_biaya.*')
			->where('tgl', $tgl)
			->order_by('id')
			->get('tabel_biaya');
	}

	public function reprintStruk($nofaktur) {
		$this->db->where('no_faktur_penjualan', $nofaktur);
		return $this->db->get('tabel_penjualan');
	}

	public function getProdukDijual($nofaktur) {
		$this->db->where('no_faktur_penjualan', $nofaktur);
		return $this->db->get('tabel_rinci_penjualan');
	}

	public function getRekapHarian($tgl_sort) {
		$this->db->where('selesai', '1');
		$this->db->where('tgl_penjualan', $tgl_sort);
		return $this->db->get('tabel_penjualan');
	}

	public function dataBarangMasuk($tgl) {
		$this->db->join('tabel_barang AS b', 'a.kode_barang = b.kd_barang', 'left');
		$this->db->join('tabel_stok_toko AS c', 'a.kode_barang = c.kd_barang', 'left');
		$this->db->where('a.waktu', $tgl);
		$this->db->where('a.publish', '1');
		return $this->db->get('tabel_kartu_stok AS a');
	}

	public function getNoFaktur($ymd) {
		$q = $this->db->query("SELECT MAX(RIGHT(no_faktur_penjualan,3)) AS id_max FROM tabel_penjualan WHERE substr(no_faktur_penjualan,6,6)='$ymd'");
		$kd = "";
		$kodeawal = "SS001";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->id_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd = "001";
		}
		return $kodeawal . $ymd . $kd;
	}

	public function getDataPenjualan($noresi, $username) {
		$this->db->where('no_faktur_penjualan', $noresi);
		$this->db->where('id_user', $username);
		$this->db->where('selesai', '0');
		return $this->db->get('tabel_penjualan');
	}

	public function getbarang($idbarang) {
		$this->db->where('kode_menu', $idbarang);
		return $this->db->get('tabel_menu');
	}

	public function cek_sudah_ada($idbarang, $nofaktur) {
		return $this->db->query("SELECT * FROM tabel_rinci_penjualan WHERE kd_barang='$idbarang' AND no_faktur_penjualan='$nofaktur'");
	}

	public function cek_jumlah_stok($idbarang) {
		return $this->db->query("SELECT MIN(tabel_stok_toko.stok) AS stok FROM tabel_stok_toko,tabel_rinci_menu WHERE tabel_rinci_menu.kode_bahan=tabel_stok_toko.kd_barang AND tabel_rinci_menu.kode_menu='$idbarang'");
	}

	public function getListPenjualan($noresi) {
		return $this->db->query("SELECT * FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$noresi' ORDER BY id");
	}

	public function getTotalBelanja($noresi) {
		return $this->db->query("SELECT SUM(sub_total_jual) AS tot_bel FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$noresi'");
	}

	public function cari_nama($nm_barang) {
		$this->db->like('nama_menu', $nm_barang, 'both');
		$this->db->order_by('kode_menu', 'ASC');
		$this->db->limit(6);
		return $this->db->get('tabel_menu')->result();
	}

	public function getPenjualanSelesai($nofaktur, $id_user) {
		$this->db->where('no_faktur_penjualan', $nofaktur);
		$this->db->where('id_user', $id_user);
		return $this->db->get('tabel_penjualan');
	}

	public function getStok($kd_barang_item) {
		return $this->db->query("SELECT MIN(tabel_stok_toko.stok) AS stok FROM tabel_stok_toko,tabel_rinci_menu WHERE tabel_rinci_menu.kode_bahan=tabel_stok_toko.kd_barang AND tabel_rinci_menu.kode_menu='$kd_barang_item'");
	}

	public function transaksiPending($id_user, $now, $before) {
		return $this->db->query("SELECT * FROM tabel_penjualan WHERE selesai='0' AND id_user='$id_user' AND tgl_penjualan BETWEEN '" . $before . "' AND  '" . $now . "' ORDER BY no_faktur_penjualan DESC");
	}

	public function getStokPorsi($kd_barang_item) {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_rinci_menu WHERE tabel_rinci_menu.kode_bahan=tabel_stok_toko.kd_barang AND tabel_rinci_menu.kode_menu='$kd_barang_item'");
	}
}

/* End of file Kasir_model.php */
/* Location: ./application/models/Kasir_model.php */