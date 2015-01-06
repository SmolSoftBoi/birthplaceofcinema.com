<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Request method.
	 * 
	 * @var string
	 * @access private
	 */
	private $request_method;

	public function __construct() {
		parent::__construct();
		$this->load->model('data_model');

		$this->request_method = $this->input->server('REQUEST_METHOD');
	}

	/**
	 * Favorites API.
	 * 
	 * @access public
	 * @param string $resource
	 * @return void
	 */
	public function favorites($resource) {
		switch(strtolower($resource)) {
			/**
			 * Adds a film or event to the user's favourites.
			 */
			case 'add':
				$user_id = $this->session->userdata('user_id');
				$filmevent_id = $this->input->get_post('filmevent_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);
				if ($filmevent_id === FALSE) show_error('Film or event ID not set.', 404);

				$favorite_rels_item['user_id'] = $user_id;
				$favorite_rels_item['filmevent_id'] = $filmevent_id;

				$this->db->trans_start();
				$this->data_model->create_favorite_rels_item($favorite_rels_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to add to favorites.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			/**
			 * Removes a film or event from the user's favourites.
			 */
			case 'remove':
				$user_id = $this->session->userdata('user_id');
				$filmevent_id = $this->input->get_post('filmevent_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);
				if ($filmevent_id === FALSE) show_error('Film or event ID not set.', 404);

				$this->db->trans_start();
				$this->data_model->delete_favorite_rels_item($user_id, $filmevent_id);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to remove from favorites.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			/**
			 * Subscribes a user to the favourites emails.
			 */
			case 'subscribe':
				$user_id = $this->session->userdata('user_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);

				$user_item['favorites'] = 1;

				$this->db->trans_start();
				$this->data_model->update_user_item($user_id, $user_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to subscribe to favourites.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			/**
			 * Unsubscribes a user from the favourites emails.
			 */
			case 'unsubscribe':
				$user_id = $this->session->userdata('user_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);

				$user_item['favorites'] = 0;

				$this->db->trans_start();
				$this->data_model->update_user_item($user_id, $user_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to unsubscribe from favorites.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			default:
				show_error('Unsupported resource.', 404);
				break;
		}
	}

	/**
	 * Films and events API.
	 * 
	 * @access public
	 * @param string $resource
	 * @return void
	 */
	public function filmsevents($resource) {
		switch(strtolower($resource)) {
			/**
			 * Film or event times HTML.
			 */
			case 'filmeventtimeshtml':
				$filmevent_id = $this->input->get_post('filmevent_id');
				$date = $this->input->get_post('date');

				if ($filmevent_id === FALSE) show_error('Film or event ID not set.', 404);
				if ($date === FALSE) show_error('Date not set.', 404);

				$filmevent_times = $this->data_model->search_filmevent_times(array(
					'filmevent_id' => $filmevent_id
				), array(
					'strict' => array(
						'filmevent_id'
					)
				));

				if ($this->data_model->search_rows_count() > 0) {
					$check = array();

					$i = 0;
					foreach ($filmevent_times as $filmevent_time_item) {
						$datetimes[$i]['date'] = strtotime(date('Y-m-d', strtotime($filmevent_time_item['datetime'])));
						$datetimes[$i]['time'] = strtotime(date('H:i:s', strtotime($filmevent_time_item['datetime'])));
						$i++;
					}
					$i = 0;
					$i = 0;
					foreach ($datetimes as $datetime) {
						if ($date == $datetime['date']) {
							if ( ! in_array($datetime['time'], $check)) {
								$times[$i]['time_value'] = $datetime['time'];
								$times[$i]['time_human'] = date('g:i a', $datetime['time']);
								$check[$i] = $datetime['time'];
								$i++;
							}
						}
					}

					$output = '';
					foreach ($times as $time) {
						$output .= '<option value="' . $time['time_value'] . '">' . $time['time_human'] . '</option>';
					}

					echo $output;
				} else {
					show_error('No times available.', 404);
				}

				break;
			/**
			 * Pay for a booking of a film or event.
			 */
			case 'pay':
				$user_id = $this->session->userdata('user_id');
				$token_id = $this->input->get_post('token_id');
				$filmevent_id = $this->input->get_post('filmevent_id');
				$date = $this->input->get_post('date');
				$time = $this->input->get_post('time');
				$adult = $this->input->get_post('adult');
				$child = $this->input->get_post('child');
				$student = $this->input->get_post('student');

				if ($user_id === FALSE) show_error('User not signed in.', 404);
				if ($token_id === FALSE) show_error('Stripe token ID not set.', 404);
				if ($filmevent_id === FALSE) show_error('Film or event ID not set.', 404);
				if ($date === FALSE || $time === FALSE) show_error('Date or time not set.', 404);
				if ($adult === FALSE || $child === FALSE || $student === FALSE) show_error('Quantities not set.', 404);

				$filmevent_time_item = $this->data_model->search_filmevent_times(array(
					'filmevent_id' => $filmevent_id,
					'datetime'     => date('Y-m-d', $date) . ' ' . date('H:i:s', $time)
				), array(
					'strict' => array(
						'filmevent_id',
						'datetime'
					),
					'ands' => array(
						'filmevent_id',
						'datetime'
					)
				));

				$booked_filmevent_item['filmevent_time_id'] = $filmevent_time_item[0]['filmevent_time_id'];
				$booked_filmevent_item['user_id'] = $user_id;
				$booked_filmevent_item['adult_qty'] = $adult;
				$booked_filmevent_item['child_qty'] = $child;
				$booked_filmevent_item['student_qty'] = $student;
				$booked_filmevent_item['total_price'] = ($adult * 10.00) + ($child * 7.00) + ($student * 8.00);
				$booked_filmevent_item['stripe_token_id'] = $token_id;

				$this->db->trans_start();
				$booked_filmevent_id = $this->data_model->create_booked_filmevent_item($booked_filmevent_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to create booking.', 500);
				}

				$booked_filmevent_item = $this->data_model->read_booked_filmevent_item($booked_filmevent_id);

				if ($booked_filmevent_item['total_qty'] == 1) {
					$email['subject'] = $booked_filmevent_item['title'] . ' Ticket';
				} else {
					$email['subject'] = $booked_filmevent_item['title'] . ' Tickets';
				}

				$email['booked_filmevent_item'] = $booked_filmevent_item;

				$message = $this->load->view('email/templates/header', $email, TRUE);
				$message .= $this->load->view('mobile/filmsevents/ticket', $email, TRUE);
				$message .= $this->load->view('email/templates/footer', $email, TRUE);

				$message_alt = $booked_filmevent_item['title'] . "\r\n"
				             . date('l, j F Y', strtotime($booked_filmevent_item['datetime'])) . ' ' . date('g:i a', strtotime($booked_filmevent_item['datetime'])) . "\r\n";
				if ($booked_filmevent_item['adult_qty'] > 0) {
					if ($booked_filmevent_item['adult_qty'] == 1) {
						$message_alt .= '1 Adult'  . "\r\n";
					} else {
						$email['message'] .= $booked_filmevent_item['adult_qty'] . ' Adults' . "\r\n";
					}
				}
				if ($booked_filmevent_item['child_qty'] > 0) {
					if ($booked_filmevent_item['child_qty'] == 1) {
						$message_alt .= '1 Child'  . "\r\n";
					} else {
						$email['message'] .= $booked_filmevent_item['child_qty'] . ' Children' . "\r\n";
					}
				}
				if ($booked_filmevent_item['student_qty'] > 0) {
					if ($booked_filmevent_item['student_qty'] == 1) {
						$message_alt .= '1 Student'  . "\r\n";
					} else {
						$email['message'] .= $booked_filmevent_item['student_qty'] . ' Students' . "\r\n";
					}
				}

				$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
				$this->email->to($this->session->userdata('user'));
				$this->email->subject($email['subject']);
				$this->email->message($message);
				$this->email->set_alt_message($message_alt);
				$this->email->send();

				$this->email->clear();

				$email['subject'] = 'Your ';
				if ($booked_filmevent_item['type_slug'] == 'film') $email['subject'] .= 'Film ';
				if ($booked_filmevent_item['type_slug'] == 'event') $email['subject'] .= 'Event ';
				$email['subject'] .= 'Ticket Receipt #' . $booked_filmevent_id;

				$email['message'] = '<h2>Receipt</h2>'
				                  . '<p><strong>Billed To:</strong><br>'
				                  . $this->session->userdata('user') . '<br>'
				                  . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '</p>'
				                  . '<p><strong>Ticket ID:</strong> ' . $booked_filmevent_id . '</p>'
				                  . '<p><strong>Receipt Date:</strong> ' . date('l, j F Y', strtotime($booked_filmevent_item['c_date'])) . '</p>'
				                  . '<p><strong>Order Total:</strong> £' . $booked_filmevent_item['total_price'] . '</p>'
				                  . '<table><thead><tr><th>Ticket</th><th>Price</th></tr></thead><tbody><tr>'
				                  . '<td>' . $booked_filmevent_item['title'] . '<br><small>';
				if ($booked_filmevent_item['total_qty'] == 1) {
					$email['message'] .= '1 Ticket';
				} else {
					$email['message'] .= $booked_filmevent_item['total_qty'] . ' Tickets';
				}
				$email['message'] .= '</td>'
				                   . '<td>£' . $booked_filmevent_item['total_price'] . '</td>'
				                   . '</tr></tbody><tfoot><tr><td>Order Total:</td><td>£' . $booked_filmevent_item['total_price'] . '</td></tr></tfoot></table>';

				$message = $this->load->view('email/templates/header', $email, TRUE);
				$message .= $this->load->view('email/default', $email, TRUE);
				$message .= $this->load->view('email/templates/footer', $email, TRUE);

				$message_alt = 'Receipt' . "\r\n"
				             . 'Billed To:' . "\r\n"
				             . $this->session->userdata('user') . "\r\n"
				             . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . "\r\n"
				             . 'Ticket ID: ' . $booked_filmevent_id . "\r\n"
				             . 'Receipt Date: ' . date('l, j F Y', strtotime($booked_filmevent_item['c_date'])) . "\r\n"
				             . 'Order Total: £' . $booked_filmevent_item['total_price'] . "\r\n";

				$this->email->from('blackhole@' . domain(base_url()), 'Regent Street Cinema');
				$this->email->to($this->session->userdata('user'));
				$this->email->subject($email['subject']);
				$this->email->message($message);
				$this->email->set_alt_message($message_alt);
				$this->email->send();

				echo json_encode(array(
					'success' => TRUE,
					'booked_filmevent_id' => $booked_filmevent_id
				));

				break;
			default:
				show_error('Unsupported resource.', 404);
				break;
		}
	}

	/**
	 * Game API.
	 *
	 * @access public
	 * @param string $resource
	 * @return void
	 */
	public function game($resource) {
		switch(strtolower($resource)) {
			/**
			 * Sets cookie.
			 */
			case 'set':
				$question_id = $this->input->get_post('question_id');

				if ($question_id === FALSE) show_error('Question ID not set.', 404);

				$cookie = array(
					'name'   => 'question_' . $question_id,
					'value'  => 'correct',
					'expire' => intval($this->config->item('csrf_expire'))
				);
				$this->input->set_cookie($cookie);

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			default:
				show_error('Unsupported resource.', 404);
				break;
		}
	}

	/**
	 * Newsletter API.
	 * 
	 * @access public
	 * @param string $resource
	 * @return void
	 */
	public function newsletter($resource) {
		switch(strtolower($resource)) {
			/**
			 * Subscribes a user to the newsletter emails.
			 */
			case 'subscribe':
				$user_id = $this->session->userdata('user_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);

				$user_item['newsletter'] = 1;

				$this->db->trans_start();
				$this->data_model->update_user_item($user_id, $user_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to subscribe to newsletter.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			/**
			 * Unsubscribes a user from the newsletter emails.
			 */
			case 'unsubscribe':
				$user_id = $this->session->userdata('user_id');

				if ($user_id === FALSE) show_error('User not signed in.', 404);

				$user_item['newsletter'] = 0;

				$this->db->trans_start();
				$this->data_model->update_user_item($user_id, $user_item);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE) {
					show_error('Unable to unsubscribe from newsletter.', 500);
				}

				echo json_encode(array(
					'success' => TRUE
				));

				break;
			default:
				show_error('Unsupported resource.', 404);
				break;
		}
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */