<?php

/**
 * Class Auth
 */
class Auth extends CI_Controller
{
    public function login()
    {
        $data['title'] = 'login';
        $data['content'] = 'auth/pages/login';
        $data['js'] = [
            'assets/core/js/login.js',
        ];

        $this->load->view('auth/template', $data);
    }
}
