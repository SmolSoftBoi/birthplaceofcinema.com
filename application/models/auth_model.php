<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->model('data_model');
		$this->load->library(array('email', 'session'));
		$this->load->helper(array('url', 'uuid'));

		if ($this->session->userdata('user') !== FALSE) {
			$data['session'] = $this->session->all_userdata();
			$this->load->vars($data);
		}
	}

	/**
	 * Verify user.
	 * 
	 * Return FALSE if user not verified.
	 * Return TRUE or array to set session userdata if user verified.
	 * 
	 * @access public
	 * @param string $user
	 * @param string $pass
	 * @return boolean|array
	 */
	public function verify_user($user, $pass) {
		$user = strtolower($user);

		$query['email'] = $this->db->get_where('emails', array(
			'email' => $user
		), 1);

		if ($query['email']->num_rows() === 1) {
			$query['user'] = $this->db->get_where('users', array(
				'user_id' => $query['email']->row()->user_id
			), 1);

			if ($query['user']->num_rows() === 1) {
				$pass = $this->encrypt_pass($pass, $query['user']->row()->salt);

				$query['user'] = $this->db->get_where('users', array(
					'user_id' => $query['user']->row()->user_id,
					'pass'    => $pass
				), 1);

				if ($query['user']->num_rows() === 1) {
					return array(
						'user_id'        => $query['user']->row()->user_id,
						'first_name'     => $query['user']->row()->first_name,
						'last_name'      => $query['user']->row()->last_name,
						'user_media_loc' => $query['user']->row()->user_media_loc
					);
				}
			}
		}

		return FALSE;
	}

	/**
	 * Verify session.
	 * 
	 * Redirect to 'auth' if session not verified.
	 * 
	 * @access public
	 * @param string $key (default: NULL)
	 * @return void
	 */
	public function verify_session($key = NULL) {
		if ($this->session->userdata('user') === FALSE) $this->redirect_auth();

		switch (strtolower($key)) {
			case 'admin':
				$user_item = $this->data_model->read_user_item($this->session->userdata('user_id'));
				if ($user_item['admin'] == FALSE) show_error('You are not an admin.', 401);
				break;
		}
	}

	/**
	 * Verify permissions.
	 * 
	 * Return array with permissions.
	 * 
	 * @access public
	 * @param array|string $keys (default: NULL)
	 * @return array|boolean
	 */
	public function verify_permissions($keys = NULL) {
		if (is_null($key)) return FALSE;

		if (is_string($keys)) {	
			$string = TRUE;
			$keys = array($keys);
		} else {
			$string = FALSE;
		}

		foreach($keys as $key) {
			$permissions[$key] = FALSE;

			if ($this->session->userdata('user') === FALSE) continue;
		}

		if ($string) {
			return $permissions[0];
		} else {
			return $permissions;
		}
	}	

	/**
	 * Auth generator.
	 * 
	 * Return FALSE if user not generated.
	 * Return TRUE or array of data if user generated.
	 * 
	 * @access public
	 * @param string $user
	 * @param string $pass
	 * @param array $data (default: array())
	 * @return boolean|array
	 */
	public function auth_gen($user, $pass, $data = array()) {
		$salt = hash('sha1', uuidgen());
		$pass = $this->encrypt_pass($pass, $salt);

		$data['user']['pass'] = $pass;
		$data['user']['salt'] = $salt;
		$data['user']['c_date'] = date('Y-m-d H:i:s');
		$data['email']['email'] = $user;
		$data['email']['default'] = 1;
		$data['email']['c_date'] = date('Y-m-d H:i:s');
		$data['email_verification']['code'] = uuidgen();
		$data['email_verification']['c_date'] = date('Y-m-d H:i:s');

		$this->db->trans_start();
		$this->db->insert('users', $data['user']);
		$data['email']['user_id'] = $this->db->insert_id();
		$this->db->insert('emails', $data['email']);
		$data['email_verification']['email_id'] = $this->db->insert_id();
		$this->db->insert('email_verification', $data['email_verification']);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) return FALSE;

		$uuid = $data['email_verification']['code'];

		$message_alt = 'Hello ' . $data['user']['first_name'] . '!' . "\r\n"
		             . 'To verifiy your email address, visit:' . "\r\n"
		             . '{unwrap}' . site_url('auth/verify/' . $uuid) . "\r\n"
		             . 'Regards,' . "\r\n"
		             . 'Regent Street Cinema';

		$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
		$this->email->to($data['email']['email']);
		$this->email->subject('Regent Street Cinema - Email Address Verification');
		$this->email->set_alt_message($message_alt);
		//$this->email->send();

		return $this->db->get_where('users', array(
			'user_id' => $data['email']['user_id']
		));
	}

	/**
	 * Encrypt pass.
	 * 
	 * Return encyrpted password.
	 * 
	 * @access private
	 * @param string $pass
	 * @param string $salt
	 * @return string
	 */
	private function encrypt_pass($pass, $salt) {
		return hash('sha512', $pass . $salt);
	}

	/**
	 * Set URL.
	 * 
	 * @access public
	 * @return void
	 */
	public function set_url() {
		$cookie = array(
			'name'   => 'url',
			'value'  => '/' . uri_string(),
			'expire' => intval($this->config->item('csrf_expire')),
			'path'   => '/auth'
		);
		$this->input->set_cookie($cookie);
	}

	/**
	 * Get URL.
	 * 
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->input->cookie($this->config->item('cookie_prefix') . 'url', TRUE);
	}

	/**
	 * Redirect auth.
	 * 
	 * @access private
	 * @param string $key (default: NULL)
	 * @return void
	 */
	private function redirect_auth($key = NULL) {
		$this->auth_model->set_url();

		if (is_null($key)) redirect('/auth');

		show_404();
	}
}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */