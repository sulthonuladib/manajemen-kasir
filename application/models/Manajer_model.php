<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajer_model extends CI_Model {

	public function getDataToko() {
		$this->db->limit(1);
		return $this->db->get('tabel_toko');
	}

	public function getUser() {
		return $this->db->get('tabel_user');
	}

	public function cekUsername($username) {
		return $this->db->query("SELECT id_user FROM tabel_user WHERE id_user='$username'");
	}

	public function getDataBarang($kd_barang) {
		$this->db->where('kd_barang', $kd_barang);
		return $this->db->get('tabel_barang');
	}

	public function getListKartuStok($kd_barang) {
		$this->db->where('kode_barang', $kd_barang);
		return $this->db->get('tabel_kartu_stok');
	}

	public function getDataMutasi() {
		$this->db->join('tabel_barang AS b', 'a.kd_barang = b.kd_barang', 'left');
		return $this->db->get('tabel_mutasi AS a');
	}

}

/* End of file Manajer_model.php */
/* Location: ./application/models/Manajer_model.php */