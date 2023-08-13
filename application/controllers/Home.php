<?php

/**
 * Class Home
 */
class Home extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'home';
        $data['content'] = 'home/pages/home';

        $this->load->view('home/template', $data);
    }
}