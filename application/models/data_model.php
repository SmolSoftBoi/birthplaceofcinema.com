<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {

	/**
	 * Last search's rows count.
	 * 
	 * @var int
	 * @access private
	 */
	private $rows_count;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

	/**
	 * Create booked film or event.
	 * 
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function create_booked_filmevent_item($data) {
		if ( ! isset($data['total_qty'])) $data['total_qty'] = $data['adult_qty'] + $data['child_qty'] + $data['student_qty'];
		if ( ! isset($data['c_date'])) $data['c_date'] = date('Y-m-d H:i:s', now());
		return $this->create_item('booked_filmsevents', $data);
	}

	/**
	 * Read booked film or event.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_booked_filmevent_item($id) {
		return $this->read_item('booked_filmsevents', $id);
	}

	/**
	 * Search booked films and events.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_booked_filmsevents($data, $config = array()) {
		return $this->search_items('booked_filmsevents', $data, $config);
	}

	/**
	 * Search emails.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_emails($data, $config = array()) {
		return $this->search_items('emails', $data, $config);
	}

	/**
	 * Create favorite relation item.
	 * 
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function create_favorite_rels_item($data) {
		$this->db->insert('favorite_rels', $data);
	}

	/**
	 * Read film or event.
	 * 
	 * @access public
	 * @param int $user_id
	 * @param int $filmevent_id
	 * @return array
	 */
	public function read_favorite_rels_item($user_id, $filmevent_id) {
		if ( ! $user_id || ! $filmevent_id) return FALSE;

		$this->joins('favorite_rels');

		$query = $this->db->get_where('favorite_rels', array('favorite_rels.user_id' => $user_id));
		$query = $this->db->get_where('favorite_rels', array('favorite_rels.filmevent_id' => $filmevent_id));

		return $query->row_array();
	}

	/**
	 * Delete favorite relation item.
	 * 
	 * @access public
	 * @param int $user_id
	 * @param int $filmevent_id
	 * @return void
	 */
	public function delete_favorite_rels_item($user_id, $filmevent_id) {
		$this->db->where('favorite_rels.user_id', $user_id);
		$this->db->where('favorite_rels.filmevent_id', $filmevent_id);
		return $this->db->delete('favorite_rels');
	}

	/**
	 * Search favorite relations.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_favorite_rels($data, $config = array()) {
		return $this->search_items('favorite_rels', $data, $config);
	}

	/**
	 * Create film or event item.
	 * 
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function create_filmevent_item($data) {
		if ( ! isset($data['c_date'])) $data['c_date'] = date('Y-m-d H:i:s', now());
		return $this->create_item('filmsevents', $data);
	}

	/**
	 * Read films and events.
	 * 
	 * @access public
	 * @param mixed $limit (default: FALSE)
	 * @param mixed $offset (default: FALSE)
	 * @return array
	 */
	public function read_filmsevents($limit = FALSE, $offset = FALSE) {
		return $this->read_items('filmsevents', $limit, $offset);
	}

	/**
	 * Read film or event.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_filmevent_item($id) {
		return $this->read_item('filmsevents', $id);
	}

	/**
	 * Update film or event.
	 * 
	 * @access public
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	public function update_filmevent_item($id, $data) {
		if ( ! isset($data['u_date'])) $data['u_date'] = date('Y-m-d H:i:s', now());
		return $this->update_item('filmsevents', $id, $data);
	}

	/**
	 * Delete film or event.
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function delete_filmevent_item($id) {
		return $this->delete_item('filmsevents', $id);
	}

	/**
	 * Search films and events.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_filmsevents($data, $config = array()) {
		return $this->search_items('filmsevents', $data, $config);
	}

	/**
	 * Films and events rows count.
	 * 
	 * @access public
	 * @return int
	 */
	public function rows_count_filmsevents() {
		return $this->rows_count_items('filmsevents');
	}

	/**
	 * Create film or event time.
	 * 
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function create_filmevent_time_item($data) {
		if ( ! isset($data['c_date'])) $data['c_date'] = date('Y-m-d H:i:s', now());
		return $this->create_item('filmevent_times', $data);
	}

	/**
	 * Read film or event time.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_filmevent_time_item($id) {
		return $this->read_item('filmevent_times', $id);
	}

	/**
	 * Update film or event time.
	 * 
	 * @access public
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	public function update_filmevent_time_item($id, $data) {
		if ( ! isset($data['u_date'])) $data['u_date'] = date('Y-m-d H:i:s', now());
		return $this->update_item('filmevent_times', $id, $data);
	}

	/**
	 * Delete film or event time.
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function delete_filmevent_time_item($id) {
		return $this->delete_item('filmevent_times', $id);
	}

	/**
	 * Search film and event times.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_filmevent_times($data, $config = array()) {
		return $this->search_items('filmevent_times', $data, $config);
	}

	/**
	 * Create film trailer.
	 * 
	 * @access public
	 * @param array $data
	 * @return array
	 */
	public function create_film_trailer_item($data) {
		if ( ! isset($data['c_date'])) $data['c_date'] = date('Y-m-d H:i:s', now());
		return $this->create_item('film_trailers', $data);
	}

	/**
	 * Read film trailer.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_film_trailer_item($id) {
		return $this->read_item('film_trailers', $id);
	}

	/**
	 * Update film trailer.
	 * 
	 * @access public
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	public function update_film_trailer_item($id, $data) {
		if ( ! isset($data['u_date'])) $data['u_date'] = date('Y-m-d H:i:s', now());
		return $this->update_item('film_trailers', $id, $data);
	}

	/**
	 * Delete film trailer.
	 * 
	 * @access public
	 * @param int $id
	 * @return void
	 */
	public function delete_film_trailer_item($id) {
		return $this->delete_item('film_trailers', $id);
	}

	/**
	 * Search film trailers.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_film_trailers($data, $config = array()) {
		return $this->search_items('film_trailers', $data, $config);
	}

	/**
	 * Read film or event type.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_filmevent_type_item($id) {
		return $this->read_item('filmevent_types', $id);
	}

	/**
	 * Search film and event types.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_filmevent_types($data, $config = array()) {
		return $this->search_items('filmevent_types', $data, $config);
	}

	/**
	 * Read user.
	 * 
	 * @access public
	 * @param int $id
	 * @return array
	 */
	public function read_user_item($id) {
		return $this->read_item('users', $id);
	}

	/**
	 * Update user.
	 * 
	 * @access public
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	public function update_user_item($id, $data) {
		if ( ! isset($data['u_date'])) $data['u_date'] = date('Y-m-d H:i:s', now());
		return $this->update_item('users', $id, $data);
	}

	/**
	 * Search users.
	 * 
	 * @access private
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	public function search_users($data, $config = array()) {
		return $this->search_items('users', $data, $config);
	}

	/**
	 * Last search's rows count.
	 * 
	 * @access public
	 * @return int|boolean
	 */
	public function search_rows_count() {
		if (isset($this->rows_count)) return $this->rows_count;

		return FALSE;
	}

	/**
	 * Create rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return void
	 */
	private function create_items($table, $data) {
		return $this->db->insert_batch($table, $data);
	}

	/**
	 * Create row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return int
	 */
	private function create_item($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	/**
	 * Read rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int|boolean $limit (default: FALSE)
	 * @param int|boolean $offset (default: FALSE)
	 * @return array
	 */
	private function read_items($table, $limit = FALSE, $offset = FALSE) {
		$this->joins($table);

		if ( ! $limit) return $this->db->get($table)->result_array();
		if ( ! $offset) return $this->db->get($table, $limit)->result_array();
		return $this->db->get($table, $limit, $offset)->result_array();
	}

	/**
	 * Read row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int $id
	 * @return array
	 */
	private function read_item($table, $id) {
		if ( ! $id) return FALSE;

		$this->joins($table);

		$query = $this->db->get_where($table, array($table . '.' . $this->table_id($table) => $id));

		return $query->row_array();
	}

	/**
	 * Update rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @return void
	 */
	private function update_items($table, $data) {
		return $this->db->update_batch($table, $data, $table . '.' . $this->table_id($table));
	}

	/**
	 * Update row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int $id
	 * @param array $data
	 * @return void
	 */
	private function update_item($table, $id, $data) {
		$this->db->where($table . '.' . $this->table_id($table), $id);
		return $this->db->update($table, $data);
	}

	/**
	 * Delete row in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param int $id
	 * @return void
	 */
	private function delete_item($table, $id) {
		$this->db->where($table . '.' . $this->table_id($table), $id);
		return $this->db->delete($table);
	}

	/**
	 * Search rows in table.
	 * 
	 * @access private
	 * @param string $table
	 * @param array $data
	 * @param array $config (default: array())
	 * @return array
	 */
	private function search_items($table, $data, $config = array()) {
		$config = array_merge(array(
			'first'  => TRUE,
			'strict' => FALSE,
			'ands'   => FALSE
		), $config);

		$this->joins($table);

		foreach ($data as $field => $search) {
			$and = FALSE;
			if (is_array($config['ands'])) if (in_array($field, $config['ands'])) $and = TRUE;

			if (strpos($field, '.') === FALSE) $field = $table . '.' . $field;

			if (is_array($search)) {
				if ($config['strict']) {
					$this->search_build($field, $search, $and, $config['strict'], $config['first']);
				} else {
					foreach ($search as $search_item) {
						$this->search_build($field, $search_item, $and, $config['strict'], $config['first']);
						$config['first'] = FALSE;
					}
				}
			} else {
				$this->search_build($field, $search, $and, $config['strict'], $config['first']);
				$config['first'] = FALSE;
			}
		}

		$query = $this->db->get($table);
		$this->rows_count = $query->num_rows();

		return $query->result_array();
	}

	/**
	 * Rows count in table.
	 * 
	 * @access private
	 * @param string $table
	 * @return int
	 */
	private function rows_count_items($table) {
		$query = $this->db->get($table);

		return $query->num_rows();
	}

	/**
	 * Joins.
	 * 
	 * @access private
	 * @param string $table
	 * @return void
	 */
	private function joins($table) {
		switch($table) {
			case 'booked_filmsevents':
				$this->db->select('booked_filmsevents.*, filmevent_times.datetime as datetime, filmsevents.filmevent_id as filmevent_id, filmsevents.title as title, filmsevents.poster_media_loc as poster_media_loc, filmsevents.promo_iphone_media_loc as promo_iphone_media_loc, filmsevents.promo_ipad_media_loc as promo_ipad_media_loc, filmevent_types.slug AS type_slug');
				$this->db->join('filmevent_times', 'filmevent_times.filmevent_time_id = booked_filmsevents.filmevent_time_id', 'left');
				$this->db->join('filmsevents', 'filmsevents.filmevent_id = filmevent_times.filmevent_id', 'left');
				$this->db->join('filmevent_types', 'filmevent_types.filmevent_type_id = filmsevents.filmevent_type_id', 'left');
				$this->db->group_by('booked_filmsevents.booked_filmevent_id');
				break;
			case 'favorite_rels':
				$this->db->select('favorite_rels.*, filmsevents.*');
				$this->db->join('filmsevents', 'filmsevents.filmevent_id = favorite_rels.filmevent_id', 'left');
				break;
			case 'filmsevents':
				$this->db->select('filmsevents.*, filmevent_types.slug AS type_slug');
				$this->db->join('filmevent_types', 'filmevent_types.filmevent_type_id = filmsevents.filmevent_type_id', 'left');
				$this->db->group_by('filmsevents.filmevent_id');
				break;
		}
	}

	/**
	 * Get table ID.
	 * 
	 * @access private
	 * @param string $table
	 * @return string|boolean
	 */
	private function table_id($table) {
		$table_ids = array(
			'booked_filmsevents' => 'booked_filmevent_id',
			'filmsevents'        => 'filmevent_id',
			'filmevent_times'    => 'filmevent_time_id',
			'filmevent_types'    => 'filmevent_type_id',
			'film_trailers'      => 'film_trailer_id',
			'users'              => 'user_id'
		);

		if (isset($table_ids[$table])) return $table_ids[$table];

		return FALSE;
	}

	/**
	 * Build the search.
	 * 
	 * @access private
	 * @param string $field
	 * @param string|array $search
	 * @param boolean $and
	 * @param boolean $strict
	 * @param boolean $first
	 * @return void
	 */
	private function search_build($field, $search, $and, $strict, $first) {
		if ($first || $and) {
			if (is_array($search)) {
				$this->db->where_in($field, $search);
			} else if ($strict) {
			    $this->db->where($field, $search);
			} else {
			    $this->db->like($field, $search);
			}
			return;
		}

		if (is_array($search)) {
			$this->db->where_in($field, $search);
		} else if ($strict) {
			$this->db->or_where($field, $search);
		} else {
			$this->db->or_like($field, $search);
		}
	}
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */