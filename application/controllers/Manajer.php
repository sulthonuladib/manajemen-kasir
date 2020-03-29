<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajer extends CI_Controller {

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
		$this->load->model('manajer_model');
		$this->load->helper('random');
	}

	public function toko() {
		$data['toko'] = $this->manajer_model->getDataToko()->row();
		$this->load->view('header', $data, FALSE);
		$this->load->view('manajer/toko');
	}

	public function simpan_data_toko() {
		$nama = $this->input->post('nm_toko');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$fax = $this->input->post('fax');
		$data = array(
			'nm_toko' => $nama,
			'almt_toko' => $alamat,
			'tlp_toko' => $telp,
			'fax_toko' => $fax,
		);
		$this->db->where('kd_toko', 'SS001');
		$this->db->update('tabel_toko', $data);
		echo $this->session->set_flashdata('msg', 'Data berhasil disimpan');
		redirect('manajer/toko/', 'refresh');
	}

	public function user() {
		$data['user'] = $this->manajer_model->getUser();
		$this->load->view('header', $data, FALSE);
		$this->load->view('manajer/user');
	}

	public function simpan_user() {
		$username = $this->input->post('id_user');
		$nama = $this->input->post('nm_user');
		$password = $this->input->post('password');
		$akses = $this->input->post('akses');
		$cek_user = $this->manajer_model->cekUsername($username);

		if ($cek_user->num_rows() > 0) {
			echo $this->session->set_flashdata('error', 'Username ' . $username . ' sudah terdaftar :(');
			redirect('manajer/user/', 'refresh');
		} else {
			$data = array(
				'id_user' => $username,
				'nm_user' => $nama,
				'password' => md5($password),
				'akses' => $akses,
				'kd_toko' => "SS001",
			);
			$this->db->insert('tabel_user', $data);
			echo $this->session->set_flashdata('msg', 'User ' . $username . ' berhasil ditambah');
			redirect('manajer/user/', 'refresh');
		}
	}

	public function simpan_user_edit() {
		$username = $this->input->post('id_user_e');
		$nama = $this->input->post('nm_user_e');
		$password = $this->input->post('password_e');
		$akses = $this->input->post('akses_e');
		if ($password) {
			$data = array(
				'password' => md5($password),
				'nm_user' => $nama,
				'akses' => $akses,
			);
			$this->db->where('id_user', $username);
			$this->db->update('tabel_user', $data);
		} else {
			$data = array(
				'nm_user' => $nama,
				'akses' => $akses,
			);
			$this->db->where('id_user', $username);
			$this->db->update('tabel_user', $data);
		}

		echo $this->session->set_flashdata('msg', 'Data user ' . $username . ' berhasil diedit');
		redirect('manajer/user/', 'refresh');
	}

	public function hapus_user() {
		$id = urldecode($this->uri->segment(3));
		$this->db->where('id_user', $id);
		$this->db->delete('tabel_user');
		echo $this->session->set_flashdata('msg', 'User ' . $id . ' berhasil dihapus');
		redirect('manajer/user/', 'refresh');
	}

	public function kartu_stok() {
		$this->load->view('header');
		$this->load->view('manajer/kartu_stok');
	}

	public function view_kartu_stok() {
		$kd_barang = $this->input->post('kd_barang');
		$data['barang'] = $this->manajer_model->getDataBarang($kd_barang)->row();
		$data['list'] = $this->manajer_model->getListKartuStok($kd_barang);
		$this->load->view('header', $data);
		$this->load->view('manajer/view_kartu_stok');
	}

	public function mutasi() {
		$data['no'] = 1;
		$data['mutasi'] = $this->manajer_model->getDataMutasi();
		$this->load->view('header', $data, FALSE);
		$this->load->view('manajer/mutasi');
	}

}

/* End of file manajer.php */
/* Location: ./application/controllers/manajer.php */