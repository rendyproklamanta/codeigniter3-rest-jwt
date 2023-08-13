<?php

/**
 * Class User
 */
class User extends CI_Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        $data['content'] = 'user/pages/create';

        $this->load->view('user/template', $data);
    }
}