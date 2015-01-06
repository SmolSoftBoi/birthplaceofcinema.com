<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nameseat extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data['nav'] = 'nameseat';
		$data['account'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for name a seat controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/nameseat
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'nameseat';
		$data['title'] = 'Name a Seat';
		$data['header'] = 'Name a Seat';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/nameseat/nameseat');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Seat map page for name a seat controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/nameseat/seatmap
	 * 
	 * @access public
	 * @return void
	 */
	public function seatmap() {
		$data['page_id'] = 'seatmap';
		$data['title'] = 'Seat Map';
		$data['header'] = 'Seat Map';
		$data['back'] = TRUE;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/nameseat/seatmap');
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Request seat page for name a seat controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/nameseat/requestseat/(:any)
	 * 
	 * @access public
	 * @return void
	 */
	public function requestseat($seat) {
		if (is_null($seat)) show_404();

		$data['page_id'] = 'requestseat';
		$data['title'] = 'Request Seat';
		$data['header'] = 'Request Seat';
		$data['back'] = TRUE;

		$data['seat'] = $seat;

		$data['default']['first_name'] = '';
		$data['default']['last_name'] = '';
		$data['default']['email'] = '';

		if ($this->session->all_userdata() !== FALSE) {
			$data['default']['first_name'] = $this->session->userdata('first_name');
			$data['default']['last_name'] = $this->session->userdata('last_name');
			$data['default']['email'] = $this->session->userdata('user');
		}

		if ($this->form_validation->run('nameseat/requestseat') !== FALSE) {
			$email['subject'] = 'Request a Seat';
			$email['message'] = '<table><tbody>'
			                  . '<tr><th>Seat</th><td>' . $seat . '</td></tr>'
			                  . '<tr><th>Title</th><td>' . $this->input->post('title') . '</td></tr>'
			                  . '<tr><th>First Name</th><td>' . $this->input->post('first_name') . '</td></tr>'
			                  . '<tr><th>Last Name</th><td>' . $this->input->post('last_name') . '</td></tr>'
			                  . '<tr><th>Address</th><td>' . $this->input->post('address') . '</td></tr>'
			                  . '<tr><th>Phone</th><td>' . $this->input->post('phone') . '</td></tr>'
			                  . '<tr><th>Email</th><td>' . $this->input->post('email') . '</td></tr>'
			                  . '<tr><th>Name or Message</th><td>' . $this->input->post('message') . '</td></tr>'
			                  . '</tbody></table>';

			$message = $this->load->view('email/templates/header', $email, TRUE);
			$message .= $this->load->view('email/default', $email, TRUE);
			$message .= $this->load->view('email/templates/footer', $email, TRUE);

			$message_alt = 'Seat: ' . $seat . "\r\n"
			             . 'Title: ' . $this->input->post('title') . "\r\n"
			             . 'First Name: ' . $this->input->post('first_name') . "\r\n"
			             . 'Last Name: ' . $this->input->post('last_name') . "\r\n"
			             . 'Address: ' . $this->input->post('address') . "\r\n"
			             . 'Phone: ' . $this->input->post('phone') . "\r\n"
			             . 'Email: ' . $this->input->post('email') . "\r\n"
			             . 'Name or Person: ' . $this->input->post('message') . "\r\n";

			$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
			$this->email->reply_to($this->input->post('email'), $this->input->post('first_name') . ' ' . $this->input->post('last_name'));
			$this->email->to('a.nayar@my.westminster.ac.uk', 'a.bukhari@my.westminster.ac.uk', 'kristian.matthews@my.westminster.ac.uk', 'm.fasihpour@my.westminster.ac.uk');
			$this->email->subject($email['subject']);
			$this->email->message($message);
			$this->email->set_alt_message($message_alt);
			$this->email->send();

			redirect('nameseat');
		}

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/nameseat/requestseat', $data);
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file nameseat.php */
/* Location: ./application/controllers/nameseat.php */