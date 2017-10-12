<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index($page = 'index')
    {
        if ( ! file_exists(APPPATH.'views/home/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('home/templates/header', $data);
        $this->load->view('home/'.$page, $data);
        $this->load->view('home/templates/footer', $data);
    }
}