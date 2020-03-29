<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function get_toko() {
		$query = $this->db->query("SELECT * FROM tabel_toko LIMIT 1");
		return $query->row();
	}
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */