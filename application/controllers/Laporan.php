<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct() {
		parent::__construct();
		//validasi jika user belum login
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		}

		if ($this->session->userdata('akses') != 'manager') {
			$url = base_url('dashboard/');
			redirect($url);
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('laporan_model');
		$this->load->helper('random');
	}

	public function retur() {
		$tanggal = date('Y-m-d');
		$filter = $this->input->get('filter');
		$a = $this->input->get('a');
		$b = $this->input->get('b');
		$c = $this->input->get('c');
		$d = $this->input->get('d');
		$e = $this->input->get('e');
		$f = $this->input->get('f');
		$tgl_awal = $c . "-" . $b . "-" . $a;
		$tgl_akhir = $f . "-" . $e . "-" . $d;
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$data['no'] = 1;
		$data['totalretur'] = 0;
		$data['tanggal'] = $tanggal;
		$data['awal'] = $tgl_awal;
		$data['akhir'] = $tgl_akhir;
		$data['filter'] = $filter;
		$data['toko'] = $this->laporan_model->get_toko();
		if ($filter == "ok") {
			$data['retur'] = $this->laporan_model->getDataReturFilter($tgl_awal, $tgl_akhir);
		} else {
			$data['retur'] = $this->laporan_model->getDataRetur($tanggal);
		}
		$this->load->view('laporan/retur', $data);
	}

	public function biaya() {
		$data['bulan'] = date('m');
		$this->load->view('header', $data, FALSE);
		$this->load->view('laporan/biaya');
	}

	public function view_biaya() {
		$tipe = $this->input->post('action');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tgl_awal = $tahun . "-" . $bulan . "-01";
		$tgl_akhir = $tahun . "-" . $bulan . "-31";
		$data['toko'] = $this->laporan_model->get_toko();
		$data['bln'] = $bulan;
		$data['thn'] = $tahun;
		if ($tipe == 'Rekap') {
			$data['no'] = 1;
			$data['tot'] = 0;
			$data['tot_a'] = 0;
			$data['tot_b'] = 0;
			$data['tot_c'] = 0;
			$data['tot_d'] = 0;
			$data['tot_tot'] = 0;
			$data['biaya'] = $this->laporan_model->getDataPengeluaranRekap($tgl_awal, $tgl_akhir);
			$this->load->view('laporan/lap_pengeluaran_rekap', $data, FALSE);
		} elseif ($tipe == 'Rinci') {
			$data['no'] = 1;
			$data['tot'] = 0;
			$data['biaya'] = $this->laporan_model->getDataPengeluaranRinci($tgl_awal, $tgl_akhir);
			$this->load->view('laporan/lap_pengeluaran_rinci', $data, FALSE);
		}
	}

	public function nilai_persediaan() {
		$nilai_persediaan = $this->laporan_model->getNilaiPersediaan();
		$data['toko'] = $this->laporan_model->get_toko();
		if ($nilai_persediaan) {
			$data['no'] = 1;
			$data['tot'] = 0;
			$data['tot_beli'] = 0;
			$data['tot_jual'] = 0;
			$data['tot_nbeli'] = 0;
			$data['tot_njual'] = 0;
			$data['nilai_modal'] = 0;
			$data['nilai_jual'] = 0;
			$data['nilai_persediaan'] = $nilai_persediaan;
			$this->load->view('laporan/lap_nilai_persediaan', $data, FALSE);
		}
	}

	public function pembelian() {
		$tanggal = date('Y-m-d');
		$filter = $this->input->get('filter');
		$a = $this->input->get('a');
		$b = $this->input->get('b');
		$c = $this->input->get('c');
		$d = $this->input->get('d');
		$e = $this->input->get('e');
		$f = $this->input->get('f');
		$tgl_awal = $c . "-" . $b . "-" . $a;
		$tgl_akhir = $f . "-" . $e . "-" . $d;
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$data['no'] = 1;
		$data['tot'] = 0;
		$data['tot_harga'] = 0;
		$data['tanggal'] = $tanggal;
		$data['awal'] = $tgl_awal;
		$data['akhir'] = $tgl_akhir;
		$data['filter'] = $filter;
		$data['toko'] = $this->laporan_model->get_toko();
		if ($filter == "ok") {
			$data['pembelian'] = $this->laporan_model->getDataPembelianFilter($tgl_awal, $tgl_akhir);
		} else {
			$data['pembelian'] = $this->laporan_model->getDataPembelian($tanggal);
		}
		$this->load->view('laporan/pembelian', $data);
	}

	public function penjualan_transaksi() {
		$tanggal = date('Y-m-d');
		$filter = $this->input->get('filter');
		$a = $this->input->get('a');
		$b = $this->input->get('b');
		$c = $this->input->get('c');
		$d = $this->input->get('d');
		$e = $this->input->get('e');
		$f = $this->input->get('f');
		$tgl_awal = $c . "-" . $b . "-" . $a;
		$tgl_akhir = $f . "-" . $e . "-" . $d;
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$data['no'] = 1;
		$data['subtot'] = 0;
		$data['diskon'] = 0;
		$data['grandtot'] = 0;
		$data['cash'] = 0;
		$data['debet'] = 0;
		$data['tanggal'] = $tanggal;
		$data['awal'] = $tgl_awal;
		$data['akhir'] = $tgl_akhir;
		$data['filter'] = $filter;
		$data['toko'] = $this->laporan_model->get_toko();
		if ($filter == "ok") {
			$data['penjualan'] = $this->laporan_model->getDataPenjualanTransaksiFilter($tgl_awal, $tgl_akhir);
		} else {
			$data['penjualan'] = $this->laporan_model->getDataPenjualanTransaksi($tanggal);
		}
		$this->load->view('laporan/penjualan_transaksi', $data);
	}

	public function penjualan_barang() {
		$tanggal = date('Y-m-d');
		$filter = $this->input->get('filter');
		$a = $this->input->get('a');
		$b = $this->input->get('b');
		$c = $this->input->get('c');
		$d = $this->input->get('d');
		$e = $this->input->get('e');
		$f = $this->input->get('f');
		$tgl_awal = $c . "-" . $b . "-" . $a;
		$tgl_akhir = $f . "-" . $e . "-" . $d;
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$data['no'] = 1;
		$data['tot'] = 0;
		$data['tanggal'] = $tanggal;
		$data['awal'] = $tgl_awal;
		$data['akhir'] = $tgl_akhir;
		$data['filter'] = $filter;
		$data['toko'] = $this->laporan_model->get_toko();
		if ($filter == "ok") {
			$data['penjualan'] = $this->laporan_model->getDataPenjualanBarangFilter($tgl_awal, $tgl_akhir);
		} else {
			$data['penjualan'] = $this->laporan_model->getDataPenjualanBarang($tanggal);
		}
		$this->load->view('laporan/penjualan_barang', $data);
	}

	public function profit() {
		$tanggal = date('Y-m-d');
		$filter = $this->input->get('filter');
		$a = $this->input->get('a');
		$b = $this->input->get('b');
		$c = $this->input->get('c');
		$d = $this->input->get('d');
		$e = $this->input->get('e');
		$f = $this->input->get('f');
		$tgl_awal = $c . "-" . $b . "-" . $a;
		$tgl_akhir = $f . "-" . $e . "-" . $d;
		$data['tgl'] = date('d');
		$data['bln'] = date('m');
		$data['thn'] = date('Y');
		$data['no'] = 1;
		$data['noo'] = 1;
		$data['tot_item'] = 0;
		$data['tot_modal'] = 0;
		$data['tot_pendapatan'] = 0;
		$data['tot_profit'] = 0;
		$data['totbiaya'] = 0;
		$data['tanggal'] = $tanggal;
		$data['awal'] = $tgl_awal;
		$data['akhir'] = $tgl_akhir;
		$data['filter'] = $filter;
		$data['toko'] = $this->laporan_model->get_toko();
		if ($filter == "ok") {
			$data['profit'] = $this->laporan_model->getDataProfit($tgl_awal, $tgl_akhir);
			$data['subdiskon'] = $this->laporan_model->getDiskonBarang($tgl_awal, $tgl_akhir)->row();
			$data['subdisakhir'] = $this->laporan_model->getDiskonAkhir($tgl_awal, $tgl_akhir)->row();
			$data['biaya'] = $this->laporan_model->getDataPengeluaranRinci($tgl_awal, $tgl_akhir);
		} else {
			$data['profit'] = $this->laporan_model->getDataProfit1($tanggal);
			$data['subdiskon'] = $this->laporan_model->getDiskonBarang1($tanggal)->row();
			$data['subdisakhir'] = $this->laporan_model->getDiskonAkhir1($tanggal)->row();
			$data['biaya'] = $this->laporan_model->getDataPengeluaranRinci1($tanggal);
		}
		$this->load->view('laporan/profit', $data);
	}

	public function rekap() {
		$this->load->model('grafik_model');
		$data['year'] = date('Y');
		$data['bulan'] = date('m');
		$data['tahun'] = $this->grafik_model->getTahunJual()->result_array();
		$this->load->view('header', $data, FALSE);
		$this->load->view('laporan/pilih_bulan');
	}

	public function rekapitulasi_penjualan() {
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$data_rekap = $this->laporan_model->getDataRekap($tahun, $bulan)->result();
		$data['diskon'] = $this->laporan_model->getDiskon($tahun, $bulan)->result();
		$data['toko'] = $this->laporan_model->get_toko();
		$data['tahun'] = $tahun;
		$data['bulan'] = $bulan;
		$data['rekap'] = $data_rekap;
		$data['aa'] = 0;
		$data['bb'] = 0;
		$data['cc'] = 0;
		$data['dd'] = 0;
		$data['ee'] = 0;
		$data['ff'] = 0;
		$data['gg'] = 0;
		$data['tot'] = 0;
		$data['tot_a'] = 0;
		$data['tot_b'] = 0;
		$data['tot_c'] = 0;
		$data['tot_d'] = 0;
		$data['tot_tot'] = 0;
		$data['biaya'] = $this->laporan_model->getDataPengeluaranRekapitulasi($tahun, $bulan);
		$this->load->view('laporan/lap_rekap', $data, FALSE);
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */