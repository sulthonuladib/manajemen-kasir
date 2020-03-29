<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_model extends CI_Model {

	public function getKategory() {
		$this->db->order_by('kd_kategori');
		return $this->db->get('tabel_kategori_barang');
	}

	public function cekKodeKategori($kode) {
		$query = $this->db->query("SELECT kd_kategori FROM tabel_kategori_barang WHERE kd_kategori='$kode'");
		return $query;
	}

	public function getSatuan() {
		$this->db->order_by('nm_satuan');
		return $this->db->get('tabel_satuan_barang');
	}

	public function cekKodeSatuan($kode) {
		$query = $this->db->query("SELECT kd_satuan FROM tabel_satuan_barang WHERE kd_satuan='$kode'");
		return $query;
	}

	public function getSupplier() {
		$this->db->order_by('kd_supplier');
		return $this->db->get('tabel_supplier');
	}

	public function cekKodeSupplier($kode) {
		$query = $this->db->query("SELECT kd_supplier FROM tabel_supplier WHERE kd_supplier='$kode'");
		return $query;
	}

	public function getProduk() {
		$this->load->library('datatables');
		$this->datatables->select('a.kd_barang,a.nm_barang,a.kd_satuan,a.kd_kategori,a.kd_supplier,a.hrg_jual,a.hrg_beli,a.kode_virtual,b.nm_kategori,c.nm_satuan,d.nm_supplier,a.estimasi_stok,a.modal_per_porsi');
		$this->datatables->from('tabel_barang AS a');
		$this->datatables->join('tabel_kategori_barang AS b', 'a.kd_kategori = b.kd_kategori', 'left');
		$this->datatables->join('tabel_satuan_barang AS c', 'a.kd_satuan = c.kd_satuan', 'left');
		$this->datatables->join('tabel_supplier AS d', 'a.kd_supplier = d.kd_supplier', 'left');
		$this->db->order_by('a.kd_kategori');
		$this->datatables->add_column('Aksi', '<a href="javascript:void(0);" class="edit_record" title="Edit data" data-kode="$1" data-nama="$2" data-satuan="$3" data-kategori="$4" data-supplier="$5" data-jual="$6" data-beli="$7" data-satuan="$8" data-porsi="$9"><i class="fa fa-pencil-square-o"></i></a> <a href="javascript:void(0);" class="hapus_record" title="Hapus data" data-kode="$1"><i class="fa fa-trash-o"></i></a>', 'kd_barang, nm_barang, kd_satuan, kd_kategori, kd_supplier, hrg_jual, hrg_beli, nm_satuan, estimasi_stok');
		return print_r($this->datatables->generate());
	}

	public function cekKodeBarang($kode) {
		return $this->db->query("SELECT kd_barang FROM tabel_barang WHERE kd_barang='$kode'");
	}

	public function getStok() {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_stok_toko.stok>0 ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokAll() {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokAllEmpty() {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_stok_toko.stok=0 ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokSort($kat) {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_kategori_barang.kd_kategori='" . $kat . "' ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokEmpty($kat) {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_stok_toko.stok=0 AND tabel_kategori_barang.kd_kategori='" . $kat . "' ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokMore($kat) {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_stok_toko.stok>0 AND tabel_kategori_barang.kd_kategori='" . $kat . "' ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokMin() {
		return $this->db->query("SELECT * FROM tabel_stok_toko,tabel_barang,tabel_kategori_barang,tabel_satuan_barang WHERE tabel_stok_toko.kd_barang=tabel_barang.kd_barang AND tabel_barang.kd_kategori=tabel_kategori_barang.kd_kategori AND tabel_barang.kd_satuan=tabel_satuan_barang.kd_satuan AND tabel_stok_toko.stok<tabel_stok_toko.stok_min ORDER BY tabel_barang.kd_barang ASC");
	}

	public function getStokMaudiEdit() {
		$this->load->library('datatables');
		$this->datatables->select('a.kd_barang,a.nm_barang,a.kd_kategori,b.nm_kategori,e.stok,e.stok_min');
		$this->datatables->from('tabel_barang AS a');
		$this->datatables->join('tabel_kategori_barang AS b', 'a.kd_kategori = b.kd_kategori', 'left');
		$this->datatables->join('tabel_stok_toko AS e', 'a.kd_barang = e.kd_barang', 'left');
		$this->datatables->add_column('Aksi', '<a href="javascript:void(0);" class="edit_record" title="Edit data" data-kode="$1" data-nama="$2" data-kategori="$3" data-stok="$4" data-stok_min="$5"><i class="fa fa-pencil-square-o"></i></a>', 'kd_barang, nm_barang, kd_kategori, stok, stok_min');
		return print_r($this->datatables->generate());
	}

	public function getNoFakturPembelian($ymd) {
		$q = $this->db->query("SELECT MAX(RIGHT(no_faktur_pembelian,5)) AS id_max FROM tabel_pembelian WHERE substr(no_faktur_pembelian,6,6)='$ymd'");
		$kd = "";
		$kodeawal = "SS001";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int) $k->id_max) + 1;
				$kd = sprintf("%05s", $tmp);
			}
		} else {
			$kd = "00001";
		}
		return $kodeawal . $ymd . $kd;
	}

	public function getDataPembelian($noresi, $username) {
		$this->db->where('tabel_pembelian.no_faktur_pembelian', $noresi);
		$this->db->where('tabel_pembelian.id_user', $username);
		$this->db->where('tabel_pembelian.selesai', '0');
		return $this->db->get('tabel_pembelian');
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

	public function data_list_pembelian($nofak) {
		return $this->db->select('tabel_rinci_pembelian.*')
			->where('no_faktur_pembelian', $nofak)
			->get('tabel_rinci_pembelian')
			->result();
	}

	public function getbarang($idbarang) {
		$this->db->where('kd_barang', $idbarang);
		return $this->db->get('tabel_barang');
	}

	public function getPembelianSelesai($nofaktur, $id_user) {
		$this->db->where('no_faktur_pembelian', $nofaktur);
		$this->db->where('id_user', $id_user);
		return $this->db->get('tabel_pembelian');
	}

	public function getProdukDibeli($nofaktur) {
		$this->db->where('no_faktur_pembelian', $nofaktur);
		return $this->db->get('tabel_rinci_pembelian');
	}

	public function getStokBeli($kd_barang_item) {
		return $this->db->query("SELECT * FROM tabel_stok_toko WHERE kd_barang='$kd_barang_item'");
	}

	public function getPorsi($kd_barang_item) {
		return $this->db->query("SELECT * FROM tabel_barang WHERE kd_barang='$kd_barang_item'");
	}

	public function getDataMenu() {
		$this->db->order_by('kode_menu');
		return $this->db->get('tabel_menu');
	}

	public function getDetailMenu() {
		$this->db->select('a.*,COUNT(b.kode_menu) AS item_bahan');
		$this->db->from('tabel_menu AS a');
		$this->db->join('tabel_rinci_menu AS b', 'a.kode_menu=b.kode_menu');
		$this->db->join('tabel_barang AS c', 'b.kode_bahan=c.kd_barang');
		$this->db->group_by('a.kode_menu');
		$query = $this->db->get();
		return $query;
	}

	public function getBahanUtama() {
		$this->db->where('kd_kategori', 'K001');
		return $this->db->get('tabel_barang');
	}

	public function getBahanTambahan() {
		$this->db->where('kd_kategori', 'K002');
		return $this->db->get('tabel_barang');
	}

	public function save_menu($kode_menu, $nama_menu, $bahan_utama, $bahan_tambahan, $harga_jual) {
		$this->db->trans_start();
		$id_menu = $this->db->insert_id();
		$result = array();
		foreach ($bahan_utama AS $key => $val) {
			$result[] = array(
				'kode_menu' => $kode_menu,
				'kode_bahan' => $_POST['bahan_utama'][$key],
			);
		}
		$this->db->insert_batch('tabel_rinci_menu', $result);
		if ($bahan_tambahan) {
			$result2 = array();
			foreach ($bahan_tambahan AS $key => $val) {
				$result2[] = array(
					'kode_menu' => $kode_menu,
					'kode_bahan' => $_POST['bahan_tambahan'][$key],
				);
			}
			$this->db->insert_batch('tabel_rinci_menu', $result2);
		}
		$jum = $this->db->query("SELECT SUM(a.modal_per_porsi) AS tot_mod FROM tabel_barang AS a JOIN tabel_rinci_menu AS b ON a.kd_barang=b.kode_bahan WHERE kode_menu='$kode_menu'");
		$x = $jum->row_array();
		$harga_modal = $x['tot_mod'];
		$data = array(
			'kode_menu' => $kode_menu,
			'nama_menu' => $nama_menu,
			'harga_jual' => $harga_jual,
			'harga_modal' => $harga_modal,
		);
		$this->db->insert('tabel_menu', $data);
		$this->db->trans_complete();
	}

	public function save_edit_menu($kode_menu, $nama_menu, $bahan_utama, $bahan_tambahan, $harga_jual) {
		$this->db->trans_start();
		$this->db->delete('tabel_rinci_menu', array('kode_menu' => $kode_menu));

		$result = array();
		foreach ($bahan_utama AS $key => $val) {
			$result[] = array(
				'kode_menu' => $kode_menu,
				'kode_bahan' => $_POST['bahan_utama_e'][$key],
			);
		}
		$this->db->insert_batch('tabel_rinci_menu', $result);
		if ($bahan_tambahan) {
			$result2 = array();
			foreach ($bahan_tambahan AS $key => $val) {
				$result2[] = array(
					'kode_menu' => $kode_menu,
					'kode_bahan' => $_POST['bahan_tambahan_e'][$key],
				);
			}
			$this->db->insert_batch('tabel_rinci_menu', $result2);
		}

		$jum = $this->db->query("SELECT SUM(a.modal_per_porsi) AS tot_mod FROM tabel_barang AS a JOIN tabel_rinci_menu AS b ON a.kd_barang=b.kode_bahan WHERE kode_menu='$kode_menu'");
		$x = $jum->row_array();
		$harga_modal = $x['tot_mod'];
		$data = array(
			'nama_menu' => $nama_menu,
			'harga_jual' => $harga_jual,
			'harga_modal' => $harga_modal,
		);
		$this->db->where('kode_menu', $kode_menu);
		$this->db->update('tabel_menu', $data);

		$this->db->trans_complete();
	}

	public function cekKodeMenu($kode_menu) {
		$this->db->where('kode_menu', $kode_menu);
		return $this->db->get('tabel_menu');
	}

	public function get_bahan_by_menu($kode_menu) {
		$this->db->select('*');
		$this->db->from('tabel_barang AS a');
		$this->db->join('tabel_rinci_menu AS b', 'b.kode_bahan=a.kd_barang');
		$this->db->join('tabel_menu AS c', 'b.kode_menu=c.kode_menu');
		$this->db->where('c.kode_menu', $kode_menu);
		$query = $this->db->get();
		return $query;
	}

	public function delete_menu($kode_menu) {
		$this->db->trans_start();
		$this->db->delete('tabel_menu', array('kode_menu' => $kode_menu));
		$this->db->delete('tabel_rinci_menu', array('kode_menu' => $kode_menu));
		$this->db->trans_complete();
	}

	public function get_detail_bahan($kd_bahan) {
		$hsl = $this->db->query("SELECT tabel_stok_toko.stok, tabel_barang.nm_barang, tabel_barang.hrg_beli, tabel_barang.hrg_jual FROM tabel_barang LEFT JOIN tabel_stok_toko ON tabel_barang.kd_barang = tabel_stok_toko.kd_barang WHERE tabel_barang.kd_barang='$kd_bahan'");
		if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'nm_barang' => $data->nm_barang,
					'stok' => $data->stok,
				);
			}
		}
		return $hasil;
	}

	public function cekStok($kd_bahan) {
		$this->db->where('kd_barang', $kd_bahan);
		return $this->db->get('tabel_stok_toko');
	}
}

/* End of file Gudang_model.php */
/* Location: ./application/models/Gudang_model.php */