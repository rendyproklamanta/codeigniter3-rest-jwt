<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* On your database, open a SQL terminal paste this and execute: */
// CREATE TABLE IF NOT EXISTS `users` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `username` varchar(255) NOT NULL DEFAULT '',
//   `email` varchar(255) NOT NULL DEFAULT '',
//   `password` varchar(255) NOT NULL DEFAULT '',
//   `avatar` varchar(255) DEFAULT 'default.jpg',
//   `created_at` datetime NOT NULL,
//   `updated_at` datetime DEFAULT NULL,
//   `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
//   `is_confirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
//   `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
//   PRIMARY KEY (`id`)
// );
// CREATE TABLE IF NOT EXISTS `ci_sessions` (
//   `id` varchar(40) NOT NULL,
//   `ip_address` varchar(45) NOT NULL,
//   `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
//   `data` blob NOT NULL,
//   PRIMARY KEY (id),
//   KEY `ci_sessions_timestamp` (`timestamp`)
// );

/**
 * User class.
 * 
 * @extends REST_Controller
 */
require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Authorization_Token');
		if (!$this->input->is_ajax_request()) {
			$this->load->library('Authorization_Middleware');
		}
		$this->load->model('user_model');
	}

	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function users_post()
	{

		// set validation rules
		// $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		// $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		// $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		// $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');

		if ($this->form_validation->run() === false) {
			$res = [
				'success' => false,
				'message' => 'Validation rules violated',
			];
			die($this->response($res, REST_Controller::HTTP_OK));
		} else {

			// set variables from the form
			$body = $this->input->post();

			if ($body) {
				$register = $this->user_model->user_create($body);

				if ($register) {
					// user creation ok
					$token_data['username'] = $body->username;
					$tokenData = $this->authorization_token->generateToken($token_data);

					$res = [
						'success' => true,
						'token' => $tokenData,
					];
					die($this->response($res, REST_Controller::HTTP_OK));
				}
			}

			$res = [
				'success' => false,
				'message' => 'There was a problem creating your new account. Please try again.',
			];
			die($this->response($res, REST_Controller::HTTP_OK));
		}
	}
}
