<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		//validasi jika user belum login
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		}
		$this->load->model('dashboard_model');
		$this->load->helper('random');
	}

	public function index() {
		$data['toko'] = $this->dashboard_model->get_toko();
		$this->load->view('header');
		$this->load->view('dashboard', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */