<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Heritage extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');

		$data['nav'] = 'heritage';
		$data['account'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for heritage controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/heritage
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'heritage';
		$data['title'] = 'Heritage';
		$data['header'] = 'Heritage';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/heritage/heritage');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Timeline page for heritage controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/heritage/timeline
	 * 
	 * @access public
	 * @return void
	 */
	public function timeline() {
		$data['page_id'] = 'timeline';
		$data['title'] = 'Timeline';
		$data['header'] = 'Timeline';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/heritage/timeline');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Artefacts page for heritage controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/heritage/artefacts
	 * 
	 * @access public
	 * @return void
	 */
	public function artefacts() {
		$data['page_id'] = 'artefacts';
		$data['title'] = 'Artefacts';
		$data['header'] = 'Artefacts';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/heritage/artefacts');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Game page for heritage controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/heritage/game
	 * 
	 * @access public
	 * @return void
	 */
	public function game() {
		$data['page_id'] = 'game';
		$data['title'] = 'Game';
		$data['header'] = 'Game';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/heritage/game');
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file heritage.php */
/* Location: ./application/controllers/heritage.php */