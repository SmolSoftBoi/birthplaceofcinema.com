<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->auth_model->verify_session();
		$this->load->model('data_model');
		$this->load->library(array('form_validation', 'upload'));
		$this->load->helper(array('form', 'typography'));

		$data['back'] = TRUE;
		$data['signout'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for account controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/account
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'account';
		$data['title'] = 'Account';
		$data['header'] = 'Account';

		$user_item = $this->data_model->read_user_item($this->session->userdata('user_id'));

		$data['newsletter'] = $user_item['newsletter'];
		$data['favorites'] = $user_item['favorites'];

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/account/account', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * User image page for account controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/account/userimg
	 * 
	 * @access public
	 * @return void
	 */
	public function userimg() {
		$data['page_id'] = 'userimg';
		$data['title'] = 'Upload Profile Image';
		$data['header'] = 'Upload Profile Image';

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/account/userimg', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

/**
	 * Upload user image page for account controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/account/uploaduserimg
	 * 
	 * @access public
	 * @return void
	 */
	public function uploaduserimg() {
		$config['upload_path'] = './media/users/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();
			$this->load->vars($data);
		} else {
			$data['upload'] = $this->upload->data();

			$user_item['user_media_loc'] = $data['upload']['file_name'];

			$this->db->trans_start();
			$this->data_model->update_user_item($this->session->userdata('user_id'), $user_item);
			$this->db->trans_complete();

			redirect('account');
		}

		$this->userimg();
	}

	/**
	 * Booked films and events page for account controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/account/bookedfilmsevents
	 * 
	 * @access public
	 * @return void
	 */
	public function bookedfilmsevents() {
		$data['page_id'] = 'bookedfilmsevents';
		$data['title'] = 'Booked Films & Events';
		$data['header'] = 'Booked Films & Events';

		$type_item = $this->data_model->search_filmevent_types(array(
			'slug' => 'film'
		));

		$films = $this->data_model->search_booked_filmsevents(array(
			'filmsevents.filmevent_type_id' => $type_item[0]['filmevent_type_id'],
			'user_id' => $this->session->userdata('user_id'),
		), array(
			'strict' => array(
				'filmsevents.filmevent_type_id',
				'user_id'
			),
			'ands' => array(
				'filmsevents.filmevent_type_id',
				'user_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) {
			$i = 0;
			foreach ($films as $film_item) {
				$films[$i] = $this->data_model->read_filmevent_item($film_item['filmevent_id']);
				$films[$i]['booked_filmevent_id'] = $film_item['booked_filmevent_id'];
				$i++;
			}

			$data['films'] = $films;
		}

		$type_item = $this->data_model->search_filmevent_types(array(
			'slug' => 'event'
		));

		$events = $this->data_model->search_booked_filmsevents(array(
			'filmsevents.filmevent_type_id' => $type_item[0]['filmevent_type_id'],
			'user_id' => $this->session->userdata('user_id'),
		), array(
			'strict' => array(
				'filmsevents.filmevent_type_id',
				'user_id'
			),
			'ands' => array(
				'filmsevents.filmevent_type_id',
				'user_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) {
			$i = 0;
			foreach ($events as $event_item) {
				$events[$i] = $this->data_model->read_filmevent_item($event_item['filmevent_id']);
				$events[$i]['booked_filmevent_id'] = $event_item['booked_filmevent_id'];
				$i++;
			}

			$data['films'] = $films;
		}

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents', $data);
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */