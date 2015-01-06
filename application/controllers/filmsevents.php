<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filmsevents extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->library('form_validation');
		$this->load->model('data_model');
		$this->load->helper('typography');

		$data['nav'] = 'filmsevents';
		$data['account'] = TRUE;
		$this->load->vars($data);
	}

	/**
	 * Index page for films & events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/filmsevents
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['page_id'] = 'filmsevents';
		$data['title'] = 'Films & Events';
		$data['header'] = 'Films & Events';
		$data['favorites'] = TRUE;

		$type_item = $this->data_model->search_filmevent_types(array(
			'slug' => 'film'
		));

		$films = $this->data_model->search_filmsevents(array(
			'filmevent_type_id' => $type_item[0]['filmevent_type_id']
		));

		if ($this->data_model->search_rows_count() > 0) {
			if ($this->session->userdata('user_id') !== FALSE) {
				
				$i = 0;
				foreach ($films as $film_item) {
					$favorite = $this->data_model->read_favorite_rels_item($this->session->userdata('user_id'), $film_item['filmevent_id']);
					if (empty($favorite)) {
						$films[$i]['favorite'] = FALSE;
					} else {
						$films[$i]['favorite'] = TRUE;
					}
					$i++;
				}
			}

			$data['films'] = $films;
		}

		$type_item = $this->data_model->search_filmevent_types(array(
			'slug' => 'event'
		));

		$events = $this->data_model->search_filmsevents(array(
			'filmevent_type_id' => $type_item[0]['filmevent_type_id']
		));

		if ($this->data_model->search_rows_count() > 0) {
			if ($this->session->userdata('user_id') !== FALSE) {
				
				$i = 0;
				foreach ($events as $event_item) {
					$favorite = $this->data_model->read_favorite_rels_item($this->session->userdata('user_id'), $event_item['filmevent_id']);
					if (empty($favorite)) {
						$events[$i]['favorite'] = FALSE;
					} else {
						$events[$i]['favorite'] = TRUE;
					}
					$i++;
				}
			}

			$data['events'] = $events;
		}

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Favorites page for films & events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/filmsevents/favorites
	 * 
	 * @access public
	 * @return void
	 */
	public function favorites() {
		$this->auth_model->verify_session();

		$data['page_id'] = 'favorites';
		$data['title'] = 'Favourites';
		$data['header'] = 'Favourites';
		$data['back'] = TRUE;

		$type_item = $this->data_model->search_filmevent_types(array(
			'slug' => 'film'
		));

		$films = $this->data_model->search_favorite_rels(array(
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
			foreach ($films as $film_item) {
				$films[$i] = $this->data_model->read_filmevent_item($film_item['filmevent_id']);
				$films[$i]['favorite'] = TRUE;
				$i++;
			}

			$data['films'] = $films;
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
				$events[$i]['favorite'] = TRUE;
				$i++;
			}

			$data['events'] = $events;
		}

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Item page for films & events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/filmsevents/(:any)
	 * 
	 * @access public
	 * @param string $slug
	 * @return void
	 */
	public function item($slug) {
		if (is_null($slug)) show_404();

		$data['page_id'] = 'filmevent';
		$data['back'] = TRUE;

		$filmevent_item = $this->data_model->search_filmsevents(array(
			'slug' => $slug
		), array(
			'strict' => array(
				'slug'
			)
		));

		if ($this->data_model->search_rows_count() === 0) show_404();

		$data['title'] = $filmevent_item[0]['title'];
		$data['header'] = $filmevent_item[0]['title'];

		$data['filmevent_item'] = $filmevent_item[0];

		$film_trailers = $this->data_model->search_film_trailers(array(
			'filmevent_id' => $data['filmevent_item']['filmevent_id'],
		), array(
			'strict' => array(
				'filmevent_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) $data['film_trailers'] = $film_trailers;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents/filmevent', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Book page for films & events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/filmsevents/(:any)/book
	 * 
	 * @access public
	 * @param string $slug
	 * @return void
	 */
	public function book($slug) {
		if (is_null($slug)) show_404();

		$this->auth_model->verify_session();

		$data['page_id'] = 'book';
		$data['back'] = TRUE;

		$filmevent_item = $this->data_model->search_filmsevents(array(
			'slug' => $slug
		), array(
			'strict' => array(
				'slug'
			)
		));

		if ($this->data_model->search_rows_count() === 0) show_404();

		$data['title'] = 'Book Tickets for ' . $filmevent_item[0]['title'];
		$data['header'] = 'Book Tickets for ' . $filmevent_item[0]['title'];

		$data['filmevent_item'] = $filmevent_item[0];

		$filmevent_times = $this->data_model->search_filmevent_times(array(
			'filmevent_id' => $filmevent_item[0]['filmevent_id']
		), array(
			'strict' => array(
				'filmevent_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) {
			$check['dates'] = array();
			$check['times'] = array();

			$i = 0;
			foreach ($filmevent_times as $filmevent_time_item) {
				$datetimes[$i]['date'] = strtotime(date('Y-m-d', strtotime($filmevent_time_item['datetime'])));
				$datetimes[$i]['time'] = strtotime(date('H:i:s', strtotime($filmevent_time_item['datetime'])));
				$i++;
			}
			$i = 0;
			foreach ($datetimes as $datetime) {
				if ( ! in_array($datetime['date'], $check['dates'])) {
					$data['dates'][$i]['date_value'] = $datetime['date'];
					$data['dates'][$i]['date_human'] = date('l, j F Y', $datetime['date']);
					$check['dates'][$i] = $datetime['date'];
					$i++;
				}
			}
			$i = 0;
			foreach ($datetimes as $datetime) {
				if ($data['dates'][0]['date_value'] === $datetime['date']) {
					if ( ! in_array($datetime['time'], $check['times'])) {
						$data['times'][$i]['time_value'] = $datetime['time'];
						$data['times'][$i]['time_human'] = date('g:i a', $datetime['time']);
						$check['times'][$i] = $datetime['time'];
						$i++;
					}
				}
			}
		}

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents/book', $data);
		$this->load->view('mobile/templates/footer', $data);
	}

	/**
	 * Ticket page for films & events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/filmsevents/ticket/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function ticket($id) {
		if (is_null($id)) show_404();

		$this->auth_model->verify_session();

		$data['page_id'] = 'ticket';
		$data['back'] = TRUE;

		$booked_filmevent_item = $this->data_model->read_booked_filmevent_item($id);

		if (empty($booked_filmevent_item)) show_404();

		if ($booked_filmevent_item['total_qty'] == 1) {
			$data['title'] = $booked_filmevent_item['title'] . ' Ticket';
			$data['header'] = $booked_filmevent_item['title'] . ' Ticket';
		} else {
			$data['title'] = $booked_filmevent_item['title'] . ' Tickets';
			$data['header'] = $booked_filmevent_item['title'] . ' Tickets';
		}

		$data['booked_filmevent_item'] = $booked_filmevent_item;

		$this->load->view('mobile/templates/header', $data);
		$this->load->view('mobile/filmsevents/ticket', $data);
		$this->load->view('mobile/templates/footer', $data);
	}
}

/* End of file filmsevents.php */
/* Location: ./application/controllers/filmsevents.php */