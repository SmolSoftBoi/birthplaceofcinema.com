<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filmsevents extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
		$this->auth_model->verify_session('admin');
		$this->load->model('data_model');
		$this->load->library(array('form_validation', 'upload'));
		$this->load->helper(array('date', 'form', 'typography'));

		$data['nav'] = 'filmsevents';
		$this->load->vars($data);
	}

	/**
	 * Index page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		$data['title'] = 'Films & Events';

		if ($this->data_model->rows_count_filmsevents() > 0) {
			$data['filmsevents'] = $this->data_model->read_filmsevents();
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/filmsevents', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Add page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/add
	 * 
	 * @access public
	 * @return void
	 */
	public function add() {
		$data['title'] = 'Add Film or Event';

		$config['upload_path'] = './media/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->form_validation->run('admin/filmsevents/add') !== FALSE) {
			$config['file_name'] = $this->input->post('slug') . '-poster';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_poster')) {
				$data['error_poster'] = $this->upload->display_errors();
			} else {
				$data['upload_poster'] = $this->upload->data();

				$filmevent_item['poster_media_loc'] = $data['upload_poster']['file_name'];
			}

			$config['file_name'] = $this->input->post('slug') . '-promo-iphone';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_promo_iphone')) {
				$data['error_promo_iphone'] = $this->upload->display_errors();
			} else {
				$data['upload_promo_iphone'] = $this->upload->data();

				$filmevent_item['promo_iphone_media_loc'] = $data['upload_promo_iphone']['file_name'];
			}

			$config['file_name'] = $this->input->post('slug') . '-promo-ipad';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_promo_ipad')) {
				$data['error_promo_ipad'] = $this->upload->display_errors();
			} else {
				$data['upload_promo_ipad'] = $this->upload->data();

				$filmevent_item['promo_ipad_media_loc'] = $data['upload_promo_ipad']['file_name'];
			}

			$type_item = $this->data_model->search_filmevent_types(array(
				'slug' => $this->input->post('type')
			));
				
			$filmevent_item['filmevent_type_id'] = $type_item[0]['filmevent_type_id'];
			$filmevent_item['title'] = $this->input->post('title');
			$filmevent_item['slug'] = $this->input->post('slug');
			$filmevent_item['description'] = $this->input->post('description');
				
			$this->db->trans_start();
			$filmevent_id = $this->data_model->create_filmevent_item($filmevent_item);
			$this->db->trans_complete();
				
			redirect('admin/filmsevents/edit/' . $filmevent_id);
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/add');
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Edit page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/edit/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function edit($id) {
		$config['upload_path'] = './media/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->form_validation->run('admin/filmsevents/edit') === FALSE) {
			$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);
		} else {
			$config['file_name'] = $this->input->post('slug') . '-poster';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_poster')) {
				$data['error_poster'] = $this->upload->display_errors();
			} else {
				$data['upload_poster'] = $this->upload->data();

				$filmevent_item['poster_media_loc'] = $data['upload_poster']['file_name'];
			}

			$config['file_name'] = $this->input->post('slug') . '-promo-iphone';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_promo_iphone')) {
				$data['error_promo_iphone'] = $this->upload->display_errors();
			} else {
				$data['upload_promo_iphone'] = $this->upload->data();

				$filmevent_item['promo_iphone_media_loc'] = $data['upload_promo_iphone']['file_name'];
			}

			$config['file_name'] = $this->input->post('slug') . '-promo-ipad';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_promo_ipad')) {
				$data['error_promo_ipad'] = $this->upload->display_errors();
			} else {
				$data['upload_promo_ipad'] = $this->upload->data();

				$filmevent_item['promo_ipad_media_loc'] = $data['upload_promo_ipad']['file_name'];
			}

			$filmevent_item['title'] = $this->input->post('title');
			$filmevent_item['slug'] = $this->input->post('slug');
			$filmevent_item['description'] = $this->input->post('description');

			$this->db->trans_start();
			$this->data_model->update_filmevent_item($id, $filmevent_item);
			$this->db->trans_complete();

			$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);
		}

		$data['title'] = 'Edit ' . $data['filmevent_item']['title'];

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/edit', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Delete page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/delete/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function delete($id) {
		$this->db->trans_start();
		$this->data_model->delete_filmevent_item($id);
		$this->db->trans_complete();

		redirect('admin/filmsevents');
	}

	/**
	 * Times page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/times/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function times($id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);

		$filmevent_times = $this->data_model->search_filmevent_times(array(
			'filmevent_id' => $data['filmevent_item']['filmevent_id']
		), array(
			'strict' => array(
				'filmevent_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) {
			$data['filmevent_times'] = $filmevent_times;
		}

		$data['title'] = 'Edit ' . $data['filmevent_item']['title'] . ' Times';

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/times', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Add time page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/addtime/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function addtime($id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);

		$data['title'] = 'Add ' . $data['filmevent_item']['title'] . ' Time';

		if ($this->form_validation->run('admin/filmsevents/addtime') !== FALSE) {
			$filmevent_time_item['filmevent_id'] = $id;
			$filmevent_time_item['datetime'] = date('Y-m-d H:i:s', strtotime($this->input->post('date') . ' ' . $this->input->post('time')));

			$this->db->trans_start();
			$filmevent_time_id = $this->data_model->create_filmevent_time_item($filmevent_time_item);
			$this->db->trans_complete();

			redirect('admin/filmsevents/edittime/' . $id . '/' . $filmevent_time_id);
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/addtime', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Edit time page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/edittime/(:num)
	 * 
	 * @access public
	 * @param int $filmevent_id
	 * @param int $time_id
	 * @return void
	 */
	public function edittime($filmevent_id, $filmevent_time_id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($filmevent_id);

		$data['title'] = 'Edit ' . $data['filmevent_item']['title'] . ' Time';

		if ($this->form_validation->run('admin/filmsevents/edittime') === FALSE) {
			$data['filmevent_time_item'] = $this->data_model->read_filmevent_time_item($filmevent_time_id);
		} else {
			$filmevent_time_item['datetime'] = date('Y-m-d H:i:s', strtotime($this->input->post('date') . ' ' . $this->input->post('time')));

			$this->db->trans_start();
			$this->data_model->update_filmevent_time_item($filmevent_time_id, $filmevent_time_item);
			$this->db->trans_complete();

			$data['filmevent_time_item'] = $this->data_model->read_filmevent_time_item($filmevent_time_id);
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/edittime', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Delete time page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/deletetime/(:num)
	 * 
	 * @access public
	 * @param int $filmevent_id
	 * @param int $time_id
	 * @return void
	 */
	public function deletetime($filmevent_id, $filmevent_time_id) {
		$this->db->trans_start();
		$this->data_model->delete_filmevent_time_item($filmevent_time_id);
		$this->db->trans_complete();

		redirect('admin/filmsevents/times/' . $filmevent_id);
	}

	/**
	 * Trailers page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/trailers/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function trailers($id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);

		$film_trailers = $this->data_model->search_film_trailers(array(
			'filmevent_id' => $data['filmevent_item']['filmevent_id']
		), array(
			'strict' => array(
				'filmevent_id'
			)
		));

		if ($this->data_model->search_rows_count() > 0) {
			$data['film_trailers'] = $film_trailers;
		}

		$data['title'] = 'Edit ' . $data['filmevent_item']['title'] . ' Trailers';

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/trailers', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Add trailer page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/addtrailer/(:num)
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function addtrailer($id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($id);

		$data['title'] = 'Add ' . $data['filmevent_item']['title'] . ' Trailer';

		$config['upload_path'] = './media/';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->form_validation->run('admin/filmsevents/addtrailer') !== FALSE) {
			$config['allowed_types'] = 'mov';
			$config['file_name'] = $data['filmevent_item']['slug'] . '-' . $this->input->post('slug') . '-trailer';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_trailer')) {
				$data['error_trailer'] = $this->upload->display_errors();
			} else {
				$data['upload_trailer'] = $this->upload->data();

				$film_trailer_item['trailer_media_loc'] = $data['upload_trailer']['file_name'];
			}

			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $data['filmevent_item']['slug'] . '-' . $this->input->post('slug') . '-placeholder';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_placeholder')) {
				$data['error_placeholder'] = $this->upload->display_errors();
			} else {
				$data['upload_placeholder'] = $this->upload->data();

				$film_trailer_item['placeholder_media_loc'] = $data['upload_placeholder']['file_name'];
			}

			$film_trailer_item['filmevent_id'] = $id;
			$film_trailer_item['title'] = $this->input->post('title');
			$film_trailer_item['slug'] = $this->input->post('slug');

			$this->db->trans_start();
			$film_trailer_id = $this->data_model->create_film_trailer_item($film_trailer_item);
			$this->db->trans_complete();

			redirect('admin/filmsevents/edittrailer/' . $id . '/' . $film_trailer_id);
		}

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/addtrailer', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Edit trailer page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/edittrailer/(:num)
	 * 
	 * @access public
	 * @param int $filmevent_id
	 * @param int $film_trailer_id
	 * @return void
	 */
	public function edittrailer($filmevent_id, $film_trailer_id) {
		$data['filmevent_item'] = $this->data_model->read_filmevent_item($filmevent_id);

		$config['upload_path'] = './media/';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '128000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->form_validation->run('admin/filmsevents/edittrailer') === FALSE) {
			$data['film_trailer_item'] = $this->data_model->read_film_trailer_item($film_trailer_id);
		} else {
			$config['allowed_types'] = 'mov';
			$config['file_name'] = $data['filmevent_item']['slug'] . '-' . $this->input->post('slug') . '-trailer';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_trailer')) {
				$data['error_trailer'] = $this->upload->display_errors();
			} else {
				$data['upload_trailer'] = $this->upload->data();

				$film_trailer_item['trailer_media_loc'] = $data['upload_trailer']['file_name'];
			}

			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $data['filmevent_item']['slug'] . '-' . $this->input->post('slug') . '-placeholder';

			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('userfile_placeholder')) {
				$data['error_placeholder'] = $this->upload->display_errors();
			} else {
				$data['upload_placeholder'] = $this->upload->data();

				$film_trailer_item['placeholder_media_loc'] = $data['upload_placeholder']['file_name'];
			}

			$film_trailer_item['title'] = $this->input->post('title');
			$film_trailer_item['slug'] = $this->input->post('slug');

			$this->db->trans_start();
			$this->data_model->update_film_trailer_item($film_trailer_id, $film_trailer_item);
			$this->db->trans_complete();

			$data['film_trailer_item'] = $this->data_model->read_film_trailer_item($film_trailer_id);
		}

		$data['title'] = 'Edit ' . $data['filmevent_item']['title'] . ' ' . $data['film_trailer_item']['title'];

		$this->load->view('web/admin/templates/header', $data);
		$this->load->view('web/admin/filmsevents/edittrailer', $data);
		$this->load->view('web/admin/templates/footer', $data);
	}

	/**
	 * Delete trailer page for films and events controller.
	 * 
	 * Maps to the following URL: birthplaceofcinema.com/admin/filmsevents/deletetrailer/(:num)
	 * 
	 * @access public
	 * @param int $filmevent_id
	 * @param int $film_trailer_id
	 * @return void
	 */
	public function deletetrailer($filmevent_id, $film_trailer_id) {
		$this->db->trans_start();
		$this->data_model->delete_film_trailer_item($film_trailer_id);
		$this->db->trans_complete();

		redirect('admin/filmsevents/trailers/' . $filmevent_id);
	}
}

/* End of file films.php */
/* Location: ./application/controllers/admin/filmsevents.php */