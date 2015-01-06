<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->auth_model->verify_session('admin');
	}

	/**
	 * Index page for dashboard controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['session'] = $this->session->all_userdata();
		$data['nav'] = 'dashboard';

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/dashboard');
		$this->load->view('web/admin/templates/footer', $data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */