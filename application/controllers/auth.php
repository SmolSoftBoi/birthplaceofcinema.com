<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * User verification result.
	 * 
	 * @var array|boolean
	 * @access private
	 */
	private $result;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library(array('form_validation', 'session'));
		$this->load->model('auth_model');

		$data['back'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for auth controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/auth
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		if ($this->session->userdata('user') !== FALSE) redirect($this->auth_model->get_url());

		if ($this->form_validation->run() !== FALSE) {
			$this->result = $this->auth_model->verify_user($this->input->post('user'), $this->input->post('pass'));

			if ($this->result !== FALSE) {
				$this->session->set_userdata('user', $this->input->post('user'));
				if (is_array($this->result)) $this->session->set_userdata($this->result);

				redirect($this->auth_model->get_url());
			}
		}

		$this->signin();
	}

	/**
	 * Sign in page for auth controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/auth/signin
	 * 
	 * @access public
	 * @return void
	 */
	public function signin() {
		if ($this->session->userdata('user') !== FALSE) redirect($this->auth_model->get_url());

		$data['page_id'] = 'auth-signin';
		$data['title'] = 'Sign In';
		$data['header'] = 'Sign In';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/auth/signin');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Sign out page for auth controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/auth/signout
	 * 
	 * @access public
	 * @return void
	 */
	public function signout() {
		$this->session->sess_destroy();

		redirect('auth');
	}

	/**
	 * Sign up page for auth controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/auth/signup
	 * 
	 * @access public
	 * @return void
	 */
	public function signup() {
		if ($this->session->userdata('user') !== FALSE) redirect($this->auth_model->get_url());

		$config['upload_path'] = './media/users/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->form_validation->run() !== FALSE) {
			if ( ! $this->upload->do_upload()) {
				$data['error'] = $this->upload->display_errors();
			} else {
				$data['upload'] = $this->upload->data();

				$user_media_loc = $data['upload']['file_name'];
			}

			$auth = $this->auth_model->auth_gen($this->input->post('user'), $this->input->post('pass1'), array(
				'user' => array(
					'first_name'     => $this->input->post('first_name'),
					'last_name'      => $this->input->post('last_name'),
					'user_media_loc' => $user_media_loc
				)
			));

			if ($auth !== FALSE) {
				redirect($this->auth_model->get_url());
			}
		}

		$data['page_id'] = 'auth-signup';
		$data['title'] = 'Sign Up';
		$data['header'] = 'Sign Up';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/auth/signup');
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file auth.php */
/* Location: ./application/helpers/auth.php */