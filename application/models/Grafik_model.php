<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_model extends CI_Model {

	public function statistik_stok() {

		$query = $this->db->query("SELECT a.kd_kategori,a.nm_barang,b.stok,a.kd_barang,b.stok FROM tabel_barang a JOIN tabel_stok_toko b ON a.kd_barang=b.kd_barang ORDER BY b.kd_barang");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	public function getTahunJual() {
		return $this->db->query("SELECT DISTINCT YEAR(tgl_penjualan) AS thn FROM tabel_penjualan");
	}

	public function graf_penjualan_perbulan($tahun, $bulan) {
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_penjualan,'%d') AS tanggal ,SUM(a.total_penjualan_sdiskon) AS total FROM tabel_penjualan AS a WHERE EXISTS (SELECT 1 FROM tabel_rinci_penjualan AS b WHERE a.no_faktur_penjualan=b.no_faktur_penjualan) AND MONTH(a.tgl_penjualan)='$bulan' AND YEAR(a.tgl_penjualan)='$tahun' AND a.selesai='1' GROUP BY DAY(a.tgl_penjualan)");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	public function graf_profit_perbulan($tahun, $bulan) {
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_penjualan,'%d') AS tanggal ,SUM(b.harga*b.jumlah) AS tot_pendapatan, SUM(b.jumlah*b.harga_modal) AS tot_modal, SUM(b.diskonrp) AS tot_diskonrp FROM tabel_penjualan AS a  JOIN tabel_rinci_penjualan AS b ON a.no_faktur_penjualan=b.no_faktur_penjualan WHERE EXISTS (SELECT 1 FROM tabel_rinci_penjualan AS b WHERE a.no_faktur_penjualan=b.no_faktur_penjualan) AND MONTH(a.tgl_penjualan)='$bulan' AND YEAR(a.tgl_penjualan)='$tahun' AND a.selesai='1' GROUP BY DAY(a.tgl_penjualan)");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	public function getDiskon($tahun, $bulan) {
		$query = $this->db->select('SUM(diskon) AS tot_diskon2')
			->where('MONTH(a.tgl_penjualan)', $bulan)
			->where('YEAR(a.tgl_penjualan)', $tahun)
			->where('a.selesai', '1')
			->group_by('a.tgl_penjualan')
			->get('tabel_penjualan AS a');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

	public function graf_penjualan_pertahun($tahun) {
		$query = $this->db->query("SELECT DATE_FORMAT(a.tgl_penjualan,'%M') AS bulan, SUM(a.total_penjualan_sdiskon) AS total FROM tabel_penjualan AS a WHERE EXISTS (SELECT 1 FROM tabel_rinci_penjualan AS b WHERE a.no_faktur_penjualan=b.no_faktur_penjualan) AND YEAR(a.tgl_penjualan)='$tahun' AND a.selesai='1' GROUP BY MONTH(a.tgl_penjualan)");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$hasil[] = $data;
			}
			return $hasil;
		}
	}

}

/* End of file Grafik_model.php */
/* Location: ./application/models/Grafik_model.php */