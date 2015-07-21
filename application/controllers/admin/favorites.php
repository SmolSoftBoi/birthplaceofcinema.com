<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorites extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->auth_model->verify_session('admin');
		$this->load->helper(array('domain', 'typography'));
		$this->load->model('data_model');

		$data['nav'] = 'favorites';
		$this->load->vars($data);
	}

	/**
	 * Index page for favourites controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/favorites
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['title'] = 'Favourites';

		$users = $this->data_model->search_users(array(
			'favorites' => TRUE
		));

		if ($this->data_model->search_rows_count() > 0) {
			$data['users'] = TRUE;
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/favorites/favorites', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Send page for favourites controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/favorites/send
	 * 
	 * @access public
	 * @return void
	 */
	public function send() {
		$data['title'] = 'Favourites';

		$users = $this->data_model->search_users(array(
			'favorites' => TRUE
		));

		if ($this->data_model->search_rows_count() > 0) {
			$data['users'] = TRUE;

			foreach ($users as $user_item) {
				$email['subject'] = 'Favourites';

				$type_item = $this->data_model->search_filmevent_types(array(
					'slug' => 'film'
				));

				$films = $this->data_model->search_favorite_rels(array(
					'filmsevents.filmevent_type_id' => $type_item[0]['filmevent_type_id'],
					'user_id' => $user_item['user_id']
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
						$i++;
					}

					$email['films'] = $films;
				}

				$type_item = $this->data_model->search_filmevent_types(array(
					'slug' => 'event'
				));

				$events = $this->data_model->search_favorite_rels(array(
					'filmsevents.filmevent_type_id' => $type_item[0]['filmevent_type_id'],
					'user_id' => $this->session->userdata('user_id')
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
						$i++;
					}
				
					$email['events'] = $events;
				}

				$message = $this->load->view('email/templates/header', $email, TRUE);
				$message .= $this->load->view('mobile/filmsevents', $email, TRUE);
				$message .= $this->load->view('email/templates/footer', $email, TRUE);

				$message_alt = 'Films' . "\r\n";
				if (isset($email['films'])) foreach ($email['films'] as $film_item) {
					$message_alt .= $film_item['title'] . "\r\n"
					              . $film_item['description'] . "\r\n"
					              . 'Book Tickets:' . "\r\n"
					              . '{unwrap}' . site_url('filmsevents/' . $film_item['slug'] . '/book') . "\r\n";
				}
				$message_alt .= 'Events' . "\r\n";
				if (isset($email['events'])) foreach ($email['events'] as $event_item) {
					$message_alt .= $event_item['title'] . "\r\n"
					              . $event_item['description'] . "\r\n"
					              . 'Book Tickets:' . "\r\n"
					              . '{unwrap}' . site_url('filmsevents/' . $event_item['slug'] . '/book') . "\r\n";
				}

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
					$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
					$this->email->to($emails[0]['email']);
					$this->email->subject($email['subject']);
					$this->email->message($message);
					$this->email->set_alt_message($message_alt);
					$this->email->send();

					$this->email->clear();
				}
			}

			$data['sent'] = TRUE;
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/favorites/favorites', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}
}

/* End of file favorites.php */
/* Location: ./application/controllers/admin/favorites.php */