<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Form Validation
|--------------------------------------------------------------------------
*/
$config = array(
	'auth/index' => array(
		array(
			'field' => 'user',
			'label' => 'Email',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'pass',
			'label' => 'Password',
			'rules' => 'required'
		)
	),
	'auth/signup' => array(
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'user',
			'label' => 'Email',
			'rules' => 'required|valid_email|is_unique[`emails`.`email`]'
		),
		array(
			'field' => 'pass1',
			'label' => 'Password',
			'rules' => 'required'
		),
		array(
			'field' => 'pass2',
			'label' => 'Password',
			'rules' => 'required|matches[pass1]'
		)
	),
	'nameseat/requestseat' => array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		),
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required|alpha'
		),
		array(
			'field' => 'address',
			'label' => 'Address',
			'rules' => 'required'
		),
		array(
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'required'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email'
		),
		array(
			'field' => 'message',
			'label' => 'Name or Message',
			'rules' => 'required|max_length[40]'
		)
	),
	'admin/filmsevents/add' => array(
		array(
			'field' => 'type',
			'label' => 'Type',
			'rules' => 'required|alpha_dash'
		),
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		),
		array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'required|alpha_dash'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required'
		)
	),
	'admin/filmsevents/edit' => array(
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		),
		array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'required|alpha_dash'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required'
		)
	),
	'admin/filmsevents/addtime' => array(
		array(
			'field' => 'date',
			'label' => 'Date',
			'rules' => 'required'
		),
		array(
			'field' => 'time',
			'label' => 'Time',
			'rules' => 'required'
		)
	),
	'admin/filmsevents/edittime' => array(
		array(
			'field' => 'date',
			'label' => 'Date',
			'rules' => 'required'
		),
		array(
			'field' => 'time',
			'label' => 'Time',
			'rules' => 'required'
		)
	),
	'admin/filmsevents/addtrailer' => array(
		array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'required|alpha_dash'
		),
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		)
	),
	'admin/filmsevents/edittrailer' => array(
		array(
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'required|alpha_dash'
		),
		array(
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required'
		)
	),
	'admin/newsletter' => array(
		array(
			'field' => 'subject',
			'label' => 'Subject',
			'rules' => 'required'
		),
		array(
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'required'
		)
	)
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */