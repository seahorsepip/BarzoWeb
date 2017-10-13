<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pubs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index($page = 'index') {
        if (!file_exists(APPPATH . 'views/pubs/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['segment'] = "pubs/";

        $data['menu'] = array(
            'home' => 'Home',
            'pubs' => 'Pubs/Bars',
            'quiz' => 'Quiz',
            'contact' => 'Contact'
        );

        $this->load->view('pubs/index', $data);
    }
}