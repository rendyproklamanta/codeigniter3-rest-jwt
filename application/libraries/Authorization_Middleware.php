<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Authorization_Middleware extends REST_Controller
{
    public function __construct()
	{
		$this->load->library('Authorization_Token');

		$headers = $this->input->request_headers();
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
			if (!$decodedToken['status']) {
				$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
			}
		}
		if (isset($headers['x-api-key'])) {
			if ($headers['x-api-key'] !== '123') {
				$this->response(['Authentication failed'], REST_Controller::HTTP_OK);
			}
		}
	}
}