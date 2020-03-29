<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller {

	function __construct() {
		parent::__construct();
		//validasi jika user belum login
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('gudang_model');
		$this->load->library('datatables');
		$this->load->helper('random');
	}

	public function kategori() {
		$data['kategori'] = $this->gudang_model->getKategory();
		$this->load->view('header', $data);
		$this->load->view('gudang/kategori');
	}

	public function simpan_kategori() {
		$kode = $this->input->post('kd_kategori');
		$nama = $this->input->post('nm_kategori');
		$cek_kode = $this->gudang_model->cekKodeKategori($kode);

		if ($cek_kode->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Kode ' . $kode . ' sudah terdaftar :(');
			redirect('gudang/kategori/', 'refresh');
		} else {
			$data = array(
				'kd_kategori' => $kode,
				'nm_kategori' => $nama,
			);
			$this->db->insert('tabel_kategori_barang', $data);
			echo $this->session->set_flashdata('msg', 'Kategori ' . $nama . ' berhasil ditambah');
			redirect('gudang/kategori/', 'refresh');
		}
	}

	public function simpan_kategori_edit() {
		$kode = $this->input->post('kd_kategori');
		$nama = $this->input->post('nm_kategori');
		$data = array(
			'nm_kategori' => $nama,
		);
		$this->db->where('kd_kategori', $kode);
		$this->db->update('tabel_kategori_barang', $data);
		echo $this->session->set_flashdata('msg', 'Kategori ' . $kode . ' berhasil diedit');
		redirect('gudang/kategori/', 'refresh');
	}

	public function satuan() {
		$data['satuan'] = $this->gudang_model->getSatuan();
		$this->load->view('header', $data);
		$this->load->view('gudang/satuan');
	}

	public function simpan_satuan() {
		$uri = base_url('gudang/satuan/');
		$kode = $this->input->post('kd_satuan');
		$nama = $this->input->post('nm_satuan');
		$cek_kode = $this->gudang_model->cekKodeSatuan($kode);

		if ($cek_kode->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Kode ' . $kode . ' sudah terdaftar :(');
			redirect('gudang/satuan/', 'refresh');
		} else {
			$data = array(
				'kd_satuan' => $kode,
				'nm_satuan' => $nama,
			);
			$this->db->insert('tabel_satuan_barang', $data);
			echo $this->session->set_flashdata('msg', 'Satuan ' . $nama . ' berhasil ditambah');
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	public function simpan_satuan_edit() {
		$kode = $this->input->post('kd_satuan');
		$nama = $this->input->post('nm_satuan');
		$data = array(
			'nm_satuan' => $nama,
		);
		$this->db->where('kd_satuan', $kode);
		$this->db->update('tabel_satuan_barang', $data);
		echo $this->session->set_flashdata('msg', 'Kode ' . $kode . ' berhasil diedit');
		redirect('gudang/satuan/', 'refresh');
	}

	public function supplier() {
		$data['supplier'] = $this->gudang_model->getSupplier();
		$this->load->view('header', $data);
		$this->load->view('gudang/supplier');
	}

	public function simpan_supplier() {
		$kode = $this->input->post('kd_supplier');
		$nama = $this->input->post('nm_supplier');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$an = $this->input->post('an');
		$cek_kode = $this->gudang_model->cekKodeSupplier($kode);

		if ($cek_kode->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Kode ' . $kode . ' sudah terdaftar :(');
			redirect('gudang/supplier/', 'refresh');
		} else {
			$data = array(
				'kd_supplier' => $kode,
				'nm_supplier' => $nama,
				'almt_supplier' => $alamat,
				'tlp_supplier' => $telp,
				'atas_nama' => $an,
			);
			$this->db->insert('tabel_supplier', $data);
			echo $this->session->set_flashdata('msg', 'Supplier ' . $nama . ' berhasil ditambah');
			redirect('gudang/supplier/', 'refresh');
		}
	}

	public function simpan_supplier_edit() {
		$kode = $this->input->post('kd_supplier');
		$nama = $this->input->post('nm_supplier');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$atas = $this->input->post('an');
		$data = array(
			'nm_supplier' => $nama,
			'almt_supplier' => $alamat,
			'tlp_supplier' => $telp,
			'atas_nama' => $atas,
		);
		$this->db->where('kd_supplier', $kode);
		$this->db->update('tabel_supplier', $data);
		echo $this->session->set_flashdata('msg', 'Kode ' . $kode . ' berhasil diedit');
		redirect('gudang/supplier/', 'refresh');
	}

	public function barang() {
		$data['kategori'] = $this->gudang_model->getKategory();
		$data['satuan'] = $this->gudang_model->getSatuan();
		$data['supplier'] = $this->gudang_model->getSupplier();
		$this->load->view('header', $data);
		$this->load->view('gudang/barang');
	}

	public function json_produk() {
		if ($this->input->is_ajax_request()) {
			$this->gudang_model->getProduk();
		} else {
			redirect('gudang/barang/', 'refresh');
		}
	}

	public function simpan_barang() {
		$uri = base_url('gudang/barang/');
		$kode = $this->input->post('kd_barang');
		$nama = $this->input->post('nm_barang');
		$satuan = $this->input->post('kd_satuan');
		$kategori = $this->input->post('kd_kategori');
		$hrg_modal = str_replace(".", "", $this->input->post('hrg_beli'));
		$estimasi_stok = $this->input->post('estimasi_stok');
		$stok_awal = "0";
		$stok_min = "5";
		$user = $this->session->userdata('ses_username');
		$modal_per_porsi = $hrg_modal / $estimasi_stok;

		$cek_kode = $this->gudang_model->cekKodeBarang($kode);
		if ($cek_kode->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Kode Produk ' . $kode . ' sudah terdaftar :(');
			header("Location: " . $uri, TRUE, $http_response_code);
		} else {
			$data = array(
				'kd_barang' => $kode,
				'nm_barang' => $nama,
				'kd_satuan' => $satuan,
				'kd_kategori' => $kategori,
				'estimasi_stok' => $estimasi_stok,
				'modal_per_porsi' => $modal_per_porsi,
				'hrg_beli' => $hrg_modal,
			);
			$data_stok = array(
				'kd_toko' => "SS001",
				'kd_barang' => $kode,
				'stok' => $stok_awal,
				'stok_min' => $stok_min,
				'tgl_perubahan' => date('d-m-Y H:i:s'),
				'ket' => "Bahan Baru",
			);
			$this->db->insert('tabel_barang', $data);
			$this->db->insert('tabel_stok_toko', $data_stok);
			echo $this->session->set_flashdata('msg', 'Produk ' . $kode . ' berhasil ditambah');
			header("Location: " . $uri, TRUE, $http_response_code);
		}
	}

	public function hapus_barang() {
		$kode = urldecode($this->uri->segment(3));
		$this->db->query("DELETE FROM tabel_barang WHERE kd_barang='$kode'");
		$this->db->query("DELETE FROM tabel_stok_toko WHERE kd_barang='$kode'");
		echo $this->session->set_flashdata('msg', 'Produk ' . $kode . ' berhasil dihapus');
		redirect('gudang/barang/', 'refresh');
	}

	public function simpan_barang_edit() {
		$kode = $this->input->post('kd_barang');
		$nama = $this->input->post('nm_barang');
		$satuan = $this->input->post('kd_satuan');
		$kategori = $this->input->post('kd_kategori');
		$hrg_modal = str_replace(".", "", $this->input->post('hrg_beli'));
		$estimasi_stok = $this->input->post('estimasi_stok');
		$modal_per_porsi = $hrg_modal / $estimasi_stok;
		$this->db->trans_start();
		$data = array(
			'nm_barang' => $nama,
			'kd_satuan' => $satuan,
			'kd_kategori' => $kategori,
			'estimasi_stok' => $estimasi_stok,
			'hrg_beli' => $hrg_modal,
			'modal_per_porsi' => $modal_per_porsi,
		);
		$this->db->where('kd_barang', $kode);
		$this->db->update('tabel_barang', $data);

		$q_rinci_menu = $this->db->query("SELECT * FROM tabel_rinci_menu WHERE kode_bahan='$kode'");
		foreach ($q_rinci_menu->result() as $key) {
			$menu = $key->kode_menu;
			$q_menu = $this->db->query("SELECT * FROM tabel_rinci_menu WHERE kode_bahan='$kode'");
			$jum = $this->db->query("SELECT SUM(a.modal_per_porsi) AS tot_mod, b.kode_menu FROM tabel_barang AS a JOIN tabel_rinci_menu AS b ON a.kd_barang=b.kode_bahan WHERE kode_menu='$menu'");
			$x = $jum->row_array();
			$harga_modal = $x['tot_mod'];
			$n_menu = $x['kode_menu'];
			$data = $this->db->query("UPDATE tabel_menu SET harga_modal='$harga_modal' WHERE kode_menu='$n_menu'");
		};
		$this->db->trans_complete();
		echo $this->session->set_flashdata('msg', 'Produk ' . $kode . ' berhasil diedit');
		redirect('gudang/barang/', 'refresh');
	}

	public function stok() {
		$data['tgl'] = date_indo(date('Y-m-d'));
		$kat = $this->input->get('category');
		$sort = $this->input->get('sort_stok');
		$data['kategori'] = $this->gudang_model->getKategory();
		if ($kat != "wow" && $sort) {
			if ($sort == "empty") {
				$data['stok'] = $this->gudang_model->getStokEmpty($kat);
			} elseif ($sort == "more") {
				$data['stok'] = $this->gudang_model->getStokMore($kat);
			} else {
				$data['stok'] = $this->gudang_model->getStokSort($kat);
			}
		} elseif ($kat == "wow" && $sort == "all") {
			$data['stok'] = $this->gudang_model->getStokAll();
		} elseif ($kat == "wow" && $sort == "more") {
			$data['stok'] = $this->gudang_model->getStok();
		} elseif ($kat == "wow" && $sort == "empty") {
			$data['stok'] = $this->gudang_model->getStokAllEmpty();
		} else {
			$data['stok'] = $this->gudang_model->getStok();
		}
		$data['sort'] = $sort;
		$data['kat'] = $kat;
		$this->load->view('header', $data);
		$this->load->view('gudang/stok');

	}

	public function stok_min() {
		$data['tgl'] = date('d M Y');
		$data['stok'] = $this->gudang_model->getStokMin();
		$this->load->view('header', $data);
		$this->load->view('gudang/stok_min');
	}

	public function edit_stok() {
		$this->load->view('header');
		$this->load->view('gudang/edit_stok');
	}

	public function json_edit_stok() {
		if ($this->input->is_ajax_request()) {
			$this->gudang_model->getStokMaudiEdit();
		} else {
			redirect('gudang/edit-stok/', 'refresh');
		}
	}

	public function simpan_edit_stok() {
		$kode = $this->input->post('kd_barang');
		$nama = $this->input->post('nm_barang');
		$stok = $this->input->post('stok');
		$sebelumnya = $this->input->post('sebelumnya');
		$stok_min = $this->input->post('stok_min');
		$user = $this->session->userdata('ses_username');
		if ($stok > $sebelumnya) {
			$masuk = $stok - $sebelumnya;
			$keluar = "0";
			$publish = $this->input->post('publish');
			$keterangan = "Penambahan Stok";
		} else {
			$masuk = "0";
			$keluar = $sebelumnya - $stok;
			$publish = "0";
			$keterangan = "Pengurangan Stok";
		}
		$data_stok = array(
			'stok' => $stok,
			'stok_min' => $stok_min,
			'tgl_perubahan' => date('d-m-Y H:i:s'),
			'ket' => $keterangan,
			'publish' => $publish,
		);
		$kartu_stok = array(
			'kode_toko' => "SS001",
			'kode_barang' => $kode,
			'waktu' => date('Y-m-d'),
			'jam' => date('H:i:s'),
			'sebelumnya' => $sebelumnya,
			'masuk' => $masuk,
			'keluar' => $keluar,
			'saldo' => $stok,
			'keterangan' => $keterangan,
			'user' => $user,
			'publish' => $publish,
		);
		$this->db->where('kd_barang', $kode);
		$this->db->update('tabel_stok_toko', $data_stok);
		$this->db->insert('tabel_kartu_stok', $kartu_stok);
		echo $this->session->set_flashdata('msg', 'Stok ' . $nama . ' berhasil diedit');
		redirect('gudang/edit-stok/', 'refresh');
	}

	public function pembelian_start() {
		$ymd = date('ymd');
		$tgl_now = date('Y-m-d');
		$id_user = $this->session->userdata('ses_username');
		$nofaktur = $this->gudang_model->getNoFakturPembelian($ymd);
		$data = array(
			'no_faktur_pembelian' => $nofaktur,
			'tgl_pembelian' => $tgl_now,
			'id_user' => $id_user,
		);
		$this->db->insert('tabel_pembelian', $data);
		redirect('gudang/pembelian/' . $nofaktur, 'refresh');
	}

	public function pembelian() {
		$noresi = $this->uri->segment(3);
		$username = $this->session->userdata('ses_username');
		$data_faktur = $this->gudang_model->getDataPembelian($noresi, $username)->row();
		if ($data_faktur) {
			$data['tgl'] = date('d-M-Y');
			$data['faktur'] = $data_faktur;
			$data['supplier'] = $this->gudang_model->getSupplier();
			$this->load->view('header', $data);
			$this->load->view('gudang/pembelian');
		} else {
			$this->load->view('error404');
		}
	}

	public function get_detail_produk() {
		$idbarang = $this->input->post('idbarang');
		$data = $this->gudang_model->get_detail_produk($idbarang);
		echo json_encode($data);
	}

	public function add_list_pembelian() {
		$nofaktur = $this->input->post('nofaktur');
		$idbarang = $this->input->post('idbarang');
		$nm_barang = $this->input->post('nm_barang');
		$jumlah = $this->input->post('jumlah');
		$harga_beli = $this->input->post('harga_beli');
		$satuan = $this->input->post('satuan');
		$subtotal = (int) $harga_beli * (int) $jumlah;

		$produk = $this->gudang_model->getbarang($idbarang);

		if ($produk->num_rows() > 0) {
			$i = $produk->row_array();
			$input = array(
				'no_faktur_pembelian' => $nofaktur,
				'kd_barang' => $i['kd_barang'],
				'nm_barang' => $nm_barang,
				'jumlah' => $jumlah,
				'satuan' => $satuan,
				'harga' => $harga_beli,
				'sub_total_beli' => $subtotal,
			);
			$data = $this->db->insert('tabel_rinci_pembelian', $input);
			echo json_encode($data);
		} else {
			echo "Produk tidak tersedia";
		}
	}

	public function data_list_pembelian() {
		$nofak = $this->uri->segment(3);
		$data = $this->gudang_model->data_list_pembelian($nofak);
		echo json_encode($data);
	}

	public function hapus_item_beli() {
		$nofaktur = $this->input->post('nofaktur');
		$idbarang = $this->input->post('idbarang');
		$data = $this->db->query("DELETE FROM tabel_rinci_pembelian WHERE no_faktur_pembelian='$nofaktur' AND kd_barang='$idbarang'");
		echo json_encode($data);
	}

	public function simpan_edit_jumlah_beli() {
		$nofaktur_e = $this->input->post('nofaktur_e');
		$idbarang_e = $this->input->post('idbarang_e');
		$jumlah_e = $this->input->post('jumlah_e');
		$harga_e = $this->input->post('harga_e');
		$subtot_sekarang = (int) $jumlah_e * (int) $harga_e;
		$data = $this->db->query("UPDATE tabel_rinci_pembelian SET jumlah='$jumlah_e', sub_total_beli='$subtot_sekarang' WHERE kd_barang='$idbarang_e' AND no_faktur_pembelian='$nofaktur_e'");
		echo json_encode($data);
	}

	public function pembelian_selesai() {
		$id_user = $this->session->userdata('ses_username');
		$nofaktur = $this->input->post('faktur_beli');
		$total_pembelian = $this->input->post('tot_harga');
		$kd_supplier = "SUPP";
		$kd_toko = "SS001";
		$waktu = date('Y-m-d');
		$jam = date('H:i:s');
		$ket = "Pembelian " . $nofaktur;
		$user = $this->session->userdata('ses_username');
		$publish = "1";
		$data_faktur = $this->gudang_model->getPembelianSelesai($nofaktur, $id_user)->row();
		$list_produk = $this->gudang_model->getProdukDibeli($nofaktur)->result();

		if ($data_faktur && $list_produk) {
			foreach ($list_produk as $key) {
				$kd_barang_item = $key->kd_barang;
				$jumlah_item = $key->jumlah;
				$cek_stok = $this->gudang_model->getStokBeli($kd_barang_item);
				$cek_porsi = $this->gudang_model->getPorsi($kd_barang_item);
				$i = $cek_stok->row_array();
				$x = $cek_porsi->row_array();
				$stok_sekarang = $i['stok'];
				$est_porsi = $x['estimasi_stok'];
				$stok_porsi = (int) $jumlah_item * (int) $est_porsi;
				$stok_baru = (int) $stok_sekarang + (int) $stok_porsi;
				$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_baru' WHERE kd_barang='$kd_barang_item'");
				$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kd_barang_item','$waktu','$jam','$stok_sekarang','0','$stok_porsi','$stok_baru','$ket','$user','$publish')");
			};
			$this->db->query("UPDATE tabel_pembelian SET total_pembelian='$total_pembelian', selesai='1', kd_supplier='$kd_supplier' WHERE no_faktur_pembelian='$nofaktur'");
			echo $this->session->set_flashdata('msg', 'Pembelian Sukses');
			redirect('/gudang/stok/', 'refresh');
		} else {
			echo $this->session->set_flashdata('error', 'Pembelian Gagal');
			redirect('gudang/pembelian/' . $nofaktur, 'refresh');
		}
	}

	public function menu() {
		$data['bahan_utama'] = $this->gudang_model->getBahanUtama();
		$data['bahan_tambahan'] = $this->gudang_model->getBahanTambahan();
		$data['menu'] = $this->gudang_model->getDataMenu();
		$data['paket'] = $this->gudang_model->getDetailMenu();
		$data['no'] = 1;
		$this->load->view('header', $data);
		$this->load->view('gudang/menu');
	}

	public function simpan_data_menu() {
		$kode_menu = $this->input->post('kode_menu', TRUE);
		$nama_menu = $this->input->post('nama_menu', TRUE);
		$bahan_utama = $this->input->post('bahan_utama', TRUE);
		$bahan_tambahan = $this->input->post('bahan_tambahan', TRUE);
		$harga_jual = str_replace(".", "", $this->input->post('harga_jual', TRUE));
		$cek_kode = $this->gudang_model->cekKodeMenu($kode_menu);
		if ($cek_kode->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Kode ' . $kode_menu . ' sudah terdaftar, silahkan pakai kode lain');
			redirect('gudang/menu', 'refresh');
		} else {
			$this->gudang_model->save_menu($kode_menu, $nama_menu, $bahan_utama, $bahan_tambahan, $harga_jual);
		}
		echo $this->session->set_flashdata('msg', 'Menu ' . $nama_menu . ' berhasil diinput');
		redirect('gudang/menu', 'refresh');
	}

	public function get_bahan_by_menu() {
		$kode_menu = $this->input->post('kode_menu');
		$data = $this->gudang_model->get_bahan_by_menu($kode_menu)->result();
		foreach ($data as $result) {
			$value[] = $result->kd_barang;
		}
		echo json_encode($value);
	}

	public function simpan_edit_menu() {
		$kode_menu = $this->input->post('kode_menu_e', TRUE);
		$nama_menu = $this->input->post('nama_menu_e', TRUE);
		$bahan_utama = $this->input->post('bahan_utama_e', TRUE);
		$bahan_tambahan = $this->input->post('bahan_tambahan_e', TRUE);
		$harga_jual = str_replace(".", "", $this->input->post('harga_jual_e', TRUE));
		$this->gudang_model->save_edit_menu($kode_menu, $nama_menu, $bahan_utama, $bahan_tambahan, $harga_jual);
		echo $this->session->set_flashdata('msg', 'Menu berhasil diedit');
		redirect('gudang/menu', 'refresh');
	}

	public function hapus_menu() {
		$kode_menu = $this->input->post('kode_menu_h', TRUE);
		$this->gudang_model->delete_menu($kode_menu);
		echo $this->session->set_flashdata('msg', 'Menu berhasil dihapus');
		redirect('gudang/menu', 'refresh');
	}

	public function bahan_rusak() {
		$this->load->view('header');
		$this->load->view('gudang/bahan_rusak');
	}

	public function get_detail_bahan() {
		$kd_bahan = $this->input->post('kd_bahan');
		$data = $this->gudang_model->get_detail_bahan($kd_bahan);
		echo json_encode($data);
	}

	public function simpan_bahan_rusak() {
		$kd_bahan = $this->input->post('kd_bahan');
		$jum_rusak = $this->input->post('rusak');
		$ket = $this->input->post('ket');
		$cek_stok = $this->gudang_model->cekStok($kd_bahan);
		$kd_toko = "SS001";
		$waktu = date('Y-m-d');
		$jam = date('H:i:s');
		$user = $this->session->userdata('ses_username');
		if ($cek_stok->num_rows() > 0) {
			$q = $cek_stok->row_array();
			$stok_sekarang = $q['stok'];
			if ($jum_rusak > $stok_sekarang) {
				echo $this->session->set_flashdata('error', 'Input jumlah barang rusak melebihi jumlah stok');
				redirect('gudang/bahan-rusak', 'refresh');
			} else {
				$stok_sekarang = (int) $stok_sekarang - (int) $jum_rusak;
				$this->db->query("UPDATE tabel_stok_toko SET stok='$stok_sekarang' WHERE kd_barang='$kd_bahan'");
				$this->db->query("INSERT INTO tabel_kartu_stok (kode_toko,kode_barang,waktu,jam,sebelumnya,keluar,masuk,saldo,keterangan,user,publish) VALUES ('$kd_toko','$kd_bahan','$waktu','$jam','$stok_sekarang','$jum_rusak','0','$stok_sekarang','$ket','$user','0')");
				echo $this->session->set_flashdata('msg', 'Entry sukses');
				redirect('gudang/bahan-rusak', 'refresh');
			}
		} else {
			echo $this->session->set_flashdata('error', 'Kode ' . $kd_bahan . ' tidak terdaftar');
			redirect('gudang/bahan-rusak', 'refresh');
		}
	}

}

/* End of file Gudang.php */
/* Location: ./application/controllers/Gudang.php */