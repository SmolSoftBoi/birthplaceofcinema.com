<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->auth_model->verify_session('admin');
		$this->load->helper(array('domain', 'form'));
		$this->load->library('form_validation');
		$this->load->model('data_model');

		$data['nav'] = 'newsletter';
		$this->load->vars($data);
	}

	/**
	 * Index page for newsletter controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/newsletter
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['title'] = 'Newsletter';

		$users = $this->data_model->search_users(array(
			'newsletter' => TRUE
		));

		if ($this->data_model->search_rows_count() > 0) {
			$i = 0;
			foreach ($users as $user_item) {
				$emails = $this->data_model->search_emails(array(
					'user_id' => $user_item['user_id'],
					'default' => TRUE
				), array(
					'strict' => array(
						'user_id',
						'default'
					),
					'ands' => array(
						'user_id',
						'default'
					)
				));

				if ($this->data_model->search_rows_count() > 0) {
					$data['users'][$i] = $emails[0]['email'];
					$i++;
				}
			}
		}

		if ($this->form_validation->run('admin/newsletter') !== FALSE) {
			$email['subject'] = $this->input->post('subject');
			$email['message'] = $this->input->post('message');

			$message = $this->load->view('email/templates/header', $email, TRUE);
			$message .= $this->load->view('email/default', $email, TRUE);
			$message .= $this->load->view('email/templates/footer', $email, TRUE);

			$message_alt = $this->input->post('message');

			$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
			$this->email->to('');
			$this->email->bcc($data['users']);
			$this->email->subject($this->input->post('subject'));
			$this->email->message($message);
			$this->email->set_alt_message($message_alt);
			$this->email->send();

			$data['sent'] = TRUE;
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/newsletter/newsletter', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}
}

/* End of file newsletter.php */
/* Location: ./application/controllers/newsletter.php */