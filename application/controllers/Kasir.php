<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	function __construct() {
		parent::__construct();
		//validasi jika user belum login
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		}

		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('kasir_model');
		$this->load->helper('random');
	}

	public function input_biaya() {
		$data['level'] = $this->session->userdata('akses');
		$this->load->view('header', $data);
		$this->load->view('kasir/biaya');
	}

	public function simpan_biaya() {
		$jenis = $this->input->post('jenis_biaya');
		$biaya = str_replace(".", "", $this->input->post('biaya'));
		$ket = $this->input->post('ket');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('ses_username');

		$data = array(
			'tgl' => $tgl,
			'id_user' => $id_user,
			'biaya' => $biaya,
			'jenis' => $jenis,
			'ket' => $ket,
		);
		$this->db->insert('tabel_biaya', $data);
		echo $this->session->set_flashdata('msg', 'Input biaya berhasil');
		redirect('kasir/input-biaya/', 'refresh');
	}

	public function mutasi() {
		$data['level'] = $this->session->userdata('akses');
		$this->load->view('header', $data);
		$this->load->view('kasir/mutasi');
	}

	public function get_detail_produk() {
		$idbarang = $this->input->post('idbarang');
		$data = $this->kasir_model->get_detail_produk($idbarang);
		echo json_encode($data);
	}

	public function simpan_mutasi() {
		$jenis = $this->input->post('jenis_mutasi');
		$kode = $this->input->post('kd_barang');
		$jumlah = $this->input->post('jumlah');
		$ket = $this->input->post('ket');
		$tgl = date('Y-m-d');
		$waktu = date('Y-m-d');
		$jam = date('H:i:s');
		$kd_toko = "SS001";
		$publish = "0";
		$user = $this->session->userdata('ses_username');

		if ($jenis == "Masuk") {
			$cek_stok = $this->kasir_model->cek_stok_mutasi($kode);
			$i = $cek_stok->row_array();
			$stok_sekarang = $i['stok'];
			$stok_baru = (int) $jumlah + (int) $stok_sekarang;
			$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_baru' WHERE kd_barang='$kode'");
			$this->db->query("INSERT INTO tabel_mutasi (mutasi,kd_barang,jumlah,ket,tgl) VALUES ('$jenis','$kode','$jumlah','$ket','$tgl')");
			$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kode','$waktu','$jam','$stok_sekarang','0','$jumlah','$stok_baru','$ket','$user','$publish')");
			echo $this->session->set_flashdata('msg', 'Input mutasi masuk ' . $kode . ' berhasil');
			redirect('kasir/mutasi/', 'refresh');
		} else {
			$cek_stok = $this->kasir_model->cek_stok_mutasi($kode);
			$i = $cek_stok->row_array();
			$stok_sekarang = $i['stok'];
			if ($stok_sekarang < $jumlah) {
				echo $this->session->set_flashdata('error', 'Input mutasi gagal, stok tidak mencukupi');
				redirect('kasir/mutasi/', 'refresh');
			} else {
				$stok_baru = (int) $stok_sekarang - (int) $jumlah;
				$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_baru' WHERE kd_barang='$kode'");
				$this->db->query("INSERT INTO tabel_mutasi (mutasi,kd_barang,jumlah,ket,tgl) VALUES ('$jenis','$kode','$jumlah','$ket','$tgl')");
				$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kode','$waktu','$jam','$stok_sekarang','$jumlah','0','$stok_baru','$ket','$user','$publish')");
				echo $this->session->set_flashdata('msg', 'Input mutasi keluar ' . $kode . ' berhasil');
				redirect('kasir/mutasi/', 'refresh');
			}
		}
	}

	public function retur() {
		$this->load->view('header');
		$this->load->view('kasir/retur');
	}

	public function get_data_faktur() {
		$nofak = $this->input->post('nofak');
		$data['list'] = $this->kasir_model->get_list($nofak);
		$data['faktur'] = $this->kasir_model->detail_faktur($nofak);
		$hasil = $this->load->view('kasir/list_retur', $data, true);
		$callback = array(
			'hasil' => $hasil,
		);
		echo json_encode($callback);
	}

	public function retur_item() {
		$nofak = $this->uri->segment(3);
		$kd_barang = base64_decode($this->uri->segment(4));
		$data_barang = $this->kasir_model->getProdukRetur($nofak, $kd_barang)->row();
		if ($data_barang) {
			$data['produk'] = $data_barang;
			$this->load->view('header', $data);
			$this->load->view('kasir/retur_item');
		} else {
			$this->load->view('error404');
		}
	}

	public function simpan_retur() {
		$nofak = $this->input->post('nofak');
		$kd_barang = $this->input->post('kd_barang');
		$jum_retur = $this->input->post('jum_retur');
		$ket = $this->input->post('ket');
		$tgl = date('Y-m-d');
		$data_barang = $this->kasir_model->getProdukRetur($nofak, $kd_barang);
		$data_stok = $this->kasir_model->getStokRetur($kd_barang);
		$i = $data_barang->row_array();
		$s = $data_stok->row_array();
		$nm_barang = $i['nm_barang'];
		$harga_item = $i['harga'];
		$stok_awal = $s['stok'];
		$stok_sekarang = (int) $stok_awal + (int) $jum_retur;
		$total_harga_retur = (int) $jum_retur * (int) $harga_item;
		$kd_toko = "SS001";
		$waktu = date('Y-m-d');
		$jam = date('H:i:s');
		$user = $this->session->userdata('ses_username');
		$publish = "0";
		$this->db->query("INSERT INTO tabel_retur (no_faktur_penjualan,kd_barang,nm_barang,jumlah,total_retur,ket,tgl) VALUES ('$nofak','$kd_barang','$nm_barang','$jum_retur','$total_harga_retur','$ket','$tgl')");
		$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kd_barang','$waktu','$jam','$stok_awal','0','$jum_retur','$stok_sekarang','$ket','$user','$publish')");
		$this->db->query("UPDATE tabel_rinci_penjualan SET retur='$jum_retur' WHERE kd_barang='$kd_barang' AND no_faktur_penjualan='$nofak'");
		$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_sekarang' WHERE kd_barang='$kd_barang'");
		echo $this->session->set_flashdata('msg', 'Retur Sukses');
		redirect('kasir/retur/', 'refresh');
	}

	public function rekap() {
		$tgl = date('Y-m-d');
		$akses = $this->session->userdata('akses');
		$data['tanggal'] = $tgl;
		$data['no'] = 1;
		$data['noo'] = 1;
		$data['subtot'] = 0;
		$data['diskon'] = 0;
		$data['grandtot'] = 0;
		$data['cash'] = 0;
		$data['debet'] = 0;
		$data['tot_biaya'] = 0;
		$data['penjualan'] = $this->kasir_model->dataTransaksiHariIni($tgl);
		if ($akses == 'manager') {
			$data['pengeluaran'] = $this->kasir_model->dataPengeluaranHariIniAll($tgl);
		} else {
			$data['pengeluaran'] = $this->kasir_model->dataPengeluaranHariIni($tgl);
		}
		$this->load->view('header', $data);
		$this->load->view('kasir/rekap_harian');
	}

	public function reprint_struk() {
		$tgl = date('d-m-Y');
		$waktu = date('H:i:s');
		$nofaktur = $this->uri->segment(3);
		$data_faktur = $this->kasir_model->reprintStruk($nofaktur)->row();
		$produk = $this->kasir_model->getProdukDijual($nofaktur);
		if ($data_faktur) {
			$data['toko'] = $this->kasir_model->get_toko();
			$data['faktur'] = $data_faktur;
			$data['tgl'] = $tgl;
			$data['waktu'] = $waktu;
			$data['produk'] = $produk;
			$data['total_item'] = 0;
			$data['subtotal'] = 0;
			$this->load->view('kasir/reprint_struk_transaksi', $data);
		} else {
			$this->load->view('error404');
		}
	}

	public function cetak_rekap() {
		$akses = $this->session->userdata('akses');
		$waktu = date('H:i:s');
		$tgl_sort = date('Y-m-d');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('ses_username');
		$data_rekap = $this->kasir_model->getRekapHarian($tgl_sort);
		$data['toko'] = $this->kasir_model->get_toko();
		$data['tgl'] = $tgl;
		$data['waktu'] = $waktu;
		$data['user'] = $id_user;
		$data['total_debet'] = 0;
		$data['total_cash'] = 0;
		$data['total_biaya'] = 0;
		$data['rekap'] = $data_rekap;
		if ($akses == 'manager') {
			$data['pengeluaran'] = $this->kasir_model->dataPengeluaranHariIniAll($tgl);
		} else {
			$data['pengeluaran'] = $this->kasir_model->dataPengeluaranHariIni($tgl);
		}
		$this->load->view('kasir/cetak_rekap_harian', $data);
	}

	public function barang_masuk() {
		$tgl = date('Y-m-d');
		$data['no'] = 1;
		$data['tanggal'] = $tgl;
		$data['masuk'] = $this->kasir_model->dataBarangMasuk($tgl);
		$this->load->view('header', $data);
		$this->load->view('kasir/barang_masuk');
	}

	public function cetak_barang_masuk() {
		$tgl = date('Y-m-d');
		$data['toko'] = $this->kasir_model->get_toko();
		$data['no'] = 1;
		$data['tanggal'] = $tgl;
		$data['masuk'] = $this->kasir_model->dataBarangMasuk($tgl);
		$this->load->view('kasir/cetak_barang_masuk', $data);
	}

	public function nomor_faktur() {
		$ymd = date('ymd');
		$tgl_now = date('Y-m-d');
		$waktu = date('H:i:s');
		$kodeawal = "SS001";
		$id_user = $this->session->userdata('ses_username');
		$max = $this->db->query("SELECT MAX(RIGHT(no_faktur_penjualan,3)) AS last FROM tabel_penjualan WHERE substr(no_faktur_penjualan,6,6)='$ymd'");
		$x = $max->row_array();
		$last = $x['last'];
		$cek = $this->db->query("SELECT * FROM tabel_penjualan WHERE substr(no_faktur_penjualan,-3)='$last' AND substr(no_faktur_penjualan,6,6)='$ymd'");
		$i = $cek->row_array();
		$user = $i['id_user'];
		$selesai = $i['selesai'];
		if ($user == $id_user && $selesai == '0') {
			$nofaktur = $kodeawal . $ymd . $last;
		} else {
			$nofaktur = $this->kasir_model->getNoFaktur($ymd);
			$data = array(
				'no_faktur_penjualan' => $nofaktur,
				'tgl_penjualan' => $tgl_now,
				'waktu' => $waktu,
				'id_user' => $id_user,
				'selesai' => '0',
			);
			$this->db->insert('tabel_penjualan', $data);
		}
		redirect('kasir/mesin-kasir/' . $nofaktur, 'refresh');
	}

	public function nomor_faktur_new() {
		$ymd = date('ymd');
		$tgl_now = date('Y-m-d');
		$waktu = date('H:i:s');
		$id_user = $this->session->userdata('ses_username');
		$nofaktur = $this->kasir_model->getNoFaktur($ymd);
		$data = array(
			'no_faktur_penjualan' => $nofaktur,
			'tgl_penjualan' => $tgl_now,
			'waktu' => $waktu,
			'id_user' => $id_user,
			'selesai' => '0',
		);
		$this->db->insert('tabel_penjualan', $data);
		redirect('kasir/mesin-kasir/' . $nofaktur, 'refresh');
	}

	public function mesin_kasir() {
		$noresi = $this->uri->segment(3);
		$username = $this->session->userdata('ses_username');
		$data_faktur = $this->kasir_model->getDataPenjualan($noresi, $username)->row();
		$list_barang = $this->kasir_model->getListPenjualan($noresi);
		if ($data_faktur) {
			$data['tgl'] = date('Y-m-d');
			$data['faktur'] = $data_faktur;
			$data['list'] = $list_barang;
			$data['tot_item'] = 0;
			$data['tot_belanja'] = 0;
			$data['belanja'] = $this->kasir_model->getTotalBelanja($noresi)->row();
			$this->load->view('header', $data);
			$this->load->view('kasir/mesin_kasir');
		} else {
			$this->load->view('error404');
		}
	}

	public function penjualan_pending() {
		$id_user = $this->session->userdata('ses_username');
		$now = date('Y-m-d');
		$before = date('Y-m-d', strtotime('-30 days', strtotime($now)));
		$data['pending'] = $this->kasir_model->transaksiPending($id_user, $now, $before);
		$data['no'] = 1;
		$this->load->view('header', $data);
		$this->load->view('kasir/penjualan_pending');
	}

	public function go_to_bayar() {
		$noresi = $this->input->post('nofak_bayar');
		$total_penjualan = $this->input->post('total_belanja');
		$diskon = $this->input->post('diskon_belanja');
		$ket_diskon = $this->input->post('diskon_ket');
		$total_sdiskon = $total_penjualan - $diskon;
		$data = array(
			'total_penjualan' => $total_penjualan,
			'diskon' => $diskon,
			'total_penjualan_sdiskon' => $total_sdiskon,
			'ket_diskon' => $ket_diskon,
		);
		$this->db->where('no_faktur_penjualan', $noresi);
		$this->db->update('tabel_penjualan', $data);
		$uri = base_url('kasir/mesin-kasir-bayar/') . $noresi;
		header("Location: " . $uri, TRUE, $http_response_code);
	}

	public function mesin_kasir_bayar() {
		$noresi = $this->uri->segment(3);
		$username = $this->session->userdata('ses_username');
		$data_faktur = $this->kasir_model->getDataPenjualan($noresi, $username)->row();
		$list_barang = $this->kasir_model->getListPenjualan($noresi);
		if ($data_faktur) {
			$data['tgl'] = date('Y-m-d');
			$data['faktur'] = $data_faktur;
			$data['list'] = $list_barang;
			$data['tot_item'] = 0;
			$data['tot_belanja'] = 0;
			$data['belanja'] = $this->kasir_model->getTotalBelanja($noresi)->row();
			$this->load->view('header', $data);
			$this->load->view('kasir/mesin_kasir_bayar');
		} else {
			$this->load->view('error404');
		}
	}

	public function cekbarang() {
		$nofaktur = urldecode($this->uri->segment(3));
		$idbarang = urldecode($this->uri->segment(4));
		$produk = $this->kasir_model->getbarang($idbarang);
		$cek_sudah_ada = $this->kasir_model->cek_sudah_ada($idbarang, $nofaktur);
		$cek_stok = $this->kasir_model->cek_jumlah_stok($idbarang);
		$x = $produk->row_array();
		$harga_jual = $x['harga_jual'];
		$jumlah = "1";
		$diskonrp = "0";
		$diskonpersen = "0";
		$subtotal = ($harga_jual * $jumlah) - $diskonrp;
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;

		if ($produk->num_rows() > 0) {
			$i = $cek_stok->row_array();
			$stok_sekarang = $i['stok'];
			if ($cek_sudah_ada->num_rows() > 0) {
				$s = $cek_sudah_ada->row_array();
				$jum_beli = $s['jumlah'];
				$jum_beli_sekarang = $jumlah + $jum_beli;
				$subtot_sekarang = ($harga_jual * $jum_beli_sekarang) - $diskonrp;
				if ($jum_beli_sekarang > $stok_sekarang) {
					echo $this->session->set_flashdata('error', 'Stok bahan tidak cukup');
					header("Location: " . $uri, TRUE, $http_response_code);
				} else {
					$this->db->query("UPDATE tabel_rinci_penjualan SET jumlah='$jum_beli_sekarang', sub_total_jual='$subtot_sekarang', diskonrp='$diskonrp', diskonpersen='$diskonpersen' WHERE kd_barang='$idbarang' AND no_faktur_penjualan='$nofaktur'");
					header("Location: " . $uri, TRUE, $http_response_code);
				}
			} else {
				if ($stok_sekarang < $jumlah) {
					echo $this->session->set_flashdata('error', 'Stok bahan tidak cukup');
					header("Location: " . $uri, TRUE, $http_response_code);
				} else {
					if ($subtotal < 0) {
						echo $this->session->set_flashdata('error', 'Error');
						header("Location: " . $uri, TRUE, $http_response_code);
					} else {
						$input = array(
							'no_faktur_penjualan' => $nofaktur,
							'kd_barang' => $x['kode_menu'],
							'nm_barang' => $x['nama_menu'],
							'jumlah' => $jumlah,
							'harga_modal' => $x['harga_modal'],
							'harga' => $harga_jual,
							'diskonrp' => $diskonrp,
							'diskonpersen' => $diskonpersen,
							'sub_total_jual' => $subtotal,
						);
						$this->db->insert('tabel_rinci_penjualan', $input);
						header("Location: " . $uri, TRUE, $http_response_code);
					}
				}
			}
		} else {
			echo $this->session->set_flashdata('error', 'Kode ' . $idbarang . ' tidak tersedia :(');
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	public function hapus_barang_beli() {
		$nofaktur = urldecode($this->uri->segment(3));
		$idbarang = urldecode($this->uri->segment(4));
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;
		$this->db->query("DELETE FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$nofaktur' AND kd_barang='$idbarang'");
		header("Location: " . $uri, TRUE, $http_response_code);
	}

	public function edit_jumlah_beli() {
		$idbarang = $this->input->post('kd_barang_e');
		$nofaktur = $this->input->post('nofak_e');
		$jumlah = $this->input->post('jml');
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;
		$cek_stok = $this->kasir_model->cek_jumlah_stok($idbarang);
		$rinci = $this->kasir_model->cek_sudah_ada($idbarang, $nofaktur);
		$i = $cek_stok->row_array();
		$x = $rinci->row_array();
		$stok_sekarang = $i['stok'];
		$diskonrp = $jumlah * $x['harga'] * $x['diskonpersen'] / 100;
		$subtot_sekarang = ($x['harga'] * $jumlah) - $diskonrp;
		if ($jumlah > $stok_sekarang) {
			echo $this->session->set_flashdata('error', 'Stok tidak cukup');
			header("Location: " . $uri, TRUE, $http_response_code);
		} else {
			$this->db->query("UPDATE tabel_rinci_penjualan SET jumlah='$jumlah', sub_total_jual='$subtot_sekarang', diskonrp='$diskonrp' WHERE kd_barang='$idbarang' AND no_faktur_penjualan='$nofaktur'");
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	public function edit_diskon_beli() {
		$idbarang = $this->input->post('kd_barang_d');
		$nofaktur = $this->input->post('nofak_d');
		$diskonpersen = $this->input->post('dis_d');
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;
		$rinci = $this->kasir_model->cek_sudah_ada($idbarang, $nofaktur);
		$x = $rinci->row_array();
		$diskonrp = $x['jumlah'] * $x['harga'] * $diskonpersen / 100;
		$subtot_sekarang = ($x['harga'] * $x['jumlah']) - $diskonrp;
		if ($diskonpersen > 100) {
			echo $this->session->set_flashdata('error', 'Diskon tidak valid');
			header("Location: " . $uri, TRUE, $http_response_code);
		} else {
			$this->db->query("UPDATE tabel_rinci_penjualan SET sub_total_jual='$subtot_sekarang', diskonrp='$diskonrp', diskonpersen='$diskonpersen' WHERE kd_barang='$idbarang' AND no_faktur_penjualan='$nofaktur'");
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	public function hitung_diskon() {
		$nofaktur = $this->input->post('nofak_dis');
		$input_diskon = $this->input->post('diskon');
		$total_penjualan = $this->input->post('sum_belanja');
		$diskon = str_replace(".", "", $input_diskon);
		$ket_dis = $this->input->post('ket_dis');
		$penjualan_sdiskon = $total_penjualan - $diskon;
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;
		if ($penjualan_sdiskon < 0) {
			echo $this->session->set_flashdata('error', 'Diskon tidak valid');
			header("Location: " . $uri, TRUE, $http_response_code);
		} else {
			$data = array(
				'total_penjualan' => $total_penjualan,
				'diskon' => $diskon,
				'total_penjualan_sdiskon' => $penjualan_sdiskon,
				'ket_diskon' => $ket_dis,
			);
			$this->db->where('no_faktur_penjualan', $nofaktur);
			$this->db->update('tabel_penjualan', $data);
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	function get_autocomplete() {
		if (isset($_GET['term'])) {
			$result = $this->kasir_model->cari_nama($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row) {
					$arr_result[] = array(
						'label' => $row->nama_menu,
						'kode' => $row->kode_menu,
					);
				}
				echo json_encode($arr_result);
			}
		}
	}

	public function cetak_struk() {
		$tgl = date('Y-m-d');
		$waktu = date('H:i:s');
		$kd_toko = "SS001";
		$debet = 0;
		$bayar = 0;
		$id_user = $this->session->userdata('ses_username');
		$nofaktur = $this->input->post('nofak_print');
		$diskon = $this->input->post('diskon_print');
		$total_penjualan = $this->input->post('sum_print');
		$bayar = $this->input->post('cash_print');
		$debet = $this->input->post('debet_print');
		$bank = $this->input->post('bank_print');
		$cash = $total_penjualan - $debet;
		$kembali = ($bayar + $debet) - $total_penjualan;
		$selesai = 1;
		$ket_ks = "Penjualan " . $nofaktur;
		$uri = base_url('kasir/mesin-kasir/') . $nofaktur;
		$this->db->trans_start();
		$data_faktur = $this->kasir_model->getPenjualanSelesai($nofaktur, $id_user)->row();
		$list_produk = $this->kasir_model->getProdukDijual($nofaktur)->result();
		if ($data_faktur && $list_produk) {
			foreach ($list_produk as $key) {
				$kd_barang_item = $key->kd_barang;
				$jumlah_item = $key->jumlah;
				$validasi_stok = $this->kasir_model->getStok($kd_barang_item);
				$i = $validasi_stok->row_array();
				$stok_sekarang = $i['stok'];
				if ($stok_sekarang < $jumlah_item) {
					echo $this->session->set_flashdata('error', 'Stok ada yang kurang');
					header("Location: " . $uri, TRUE, $http_response_code);
					return false;
				} else {
					$stok_porsi = $this->kasir_model->getStokPorsi($kd_barang_item)->result();
					foreach ($stok_porsi as $key) {
						$kd_bahan = $key->kode_bahan;
						$stok_bahan = $key->stok;
						$stok_baru = (int) $stok_bahan - (int) $jumlah_item;
						$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_baru' WHERE kd_barang='$kd_bahan'");
						$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kd_bahan','$tgl','$waktu','$stok_bahan','$jumlah_item','0','$stok_baru','$ket_ks','$id_user','0')");
					}
				}
			};
			$update = array(
				'waktu' => $waktu,
				'cash' => $cash,
				'debet' => $debet,
				'ket' => $bank,
				'selesai' => $selesai,
			);
			$this->db->where('id_user', $id_user);
			$this->db->where('no_faktur_penjualan', $nofaktur);
			$this->db->update('tabel_penjualan', $update);
			$this->db->trans_complete();
			$data_cetak['toko'] = $this->kasir_model->get_toko();
			$data_cetak['faktur'] = $data_faktur;
			$data_cetak['tgl'] = $tgl;
			$data_cetak['waktu'] = $waktu;
			$data_cetak['bayar'] = $bayar;
			$data_cetak['kembali'] = $kembali;
			$data_cetak['debet'] = $debet;
			$data_cetak['produk'] = $list_produk;
			$data_cetak['total_item'] = 0;
			$data_cetak['subtotal'] = 0;
			$this->load->view('kasir/struk_transaksi', $data_cetak);
		} else {
			echo "Error retrieving information from server. <br><br>Halaman ini tidak bisa dimuat ulang, silahkan tutup halaman ini.";
		}
	}

	public function transaksi_selesai() {
		$this->load->view('header');
		$this->load->view('kasir/transaksi_selesai');
	}

	public function hapus_faktur() {
		$nofaktur = urldecode($this->uri->segment(3));
		$this->db->query("DELETE FROM tabel_penjualan WHERE no_faktur_penjualan='$nofaktur'");
		$this->db->query("DELETE FROM tabel_rinci_penjualan WHERE no_faktur_penjualan='$nofaktur'");
		echo $this->session->set_flashdata('msg', 'Faktur berhasil ' . $nofaktur . ' dihapus');
		redirect('kasir/penjualan-pending/', 'refresh');
	}

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */