<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');

		$data['nav'] = 'info';
		$data['account'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for information controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/info
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'info';
		$data['title'] = 'Information';
		$data['header'] = 'Information';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/info/info');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Map page for information controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/info/map
	 * 
	 * @access public
	 * @return void
	 */
	public function map() {
		$data['page_id'] = 'map';
		$data['title'] = 'Map';
		$data['header'] = 'Map';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/info/map');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Contact page for information controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/info/contact
	 * 
	 * @access public
	 * @return void
	 */
	public function contact() {
		$data['page_id'] = 'contact';
		$data['title'] = 'Contact Us';
		$data['header'] = 'Contact Us';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/info/contact');
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file info.php */
/* Location: ./application/controllers/info.php */