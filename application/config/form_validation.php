<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'login' => array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|max_length[30]'
			),
			array(
				'field' => 'email',
				'label' => 'Email Address',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			)
		)
	);