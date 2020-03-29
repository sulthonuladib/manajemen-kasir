<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('login_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('user_agent');
	}

	public function index() {
		$this->load->view('v_login');
	}

	public function auth() {
		$username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
		$password_hash = md5($password);
		$tgl = date('Y-m-d H:i:s');
		$browser = $this->agent->browser() . ' ' . $this->agent->version();
		$os = $this->agent->platform();
		$ip = $this->input->ip_address();

		$cek_user = $this->login_model->cek_user($username, $password_hash);

		if ($cek_user->num_rows() > 0) {
			$data = $cek_user->row_array();
			$username = $data['id_user'];
			$nama = $data['nm_user'];
			$akses = $data['akses'];
			$this->session->set_userdata('masuk', TRUE);
			$this->session->set_userdata('akses', $akses);
			$this->session->set_userdata('ses_username', $username);
			$this->session->set_userdata('ses_nama', $nama);
			$this->db->query("INSERT INTO tabel_agent (user,tgl,browser,os,ip) VALUES ('$username','$tgl','$browser','$os','$ip')");
			echo $this->session->set_flashdata('msg', 'Selamat Datang, ' . $nama . ' ;)');
			redirect('dashboard/', 'refresh');
		} else {
			$url = base_url();
			echo $this->session->set_flashdata('msg', 'Username atau Password salah! :(');
			redirect($url);
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */