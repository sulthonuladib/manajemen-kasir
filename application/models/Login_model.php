<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function cek_user($username, $password_hash) {
		$query = $this->db->query("SELECT * FROM tabel_user WHERE id_user='$username' AND password='$password_hash' LIMIT 1");
		return $query;
	}

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */