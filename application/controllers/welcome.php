<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');

		$data['nav'] = 'home';
		$data['account'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for welcome controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'home';
		$data['header'] = 'Regent Street Cinema';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/welcome_message');
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */