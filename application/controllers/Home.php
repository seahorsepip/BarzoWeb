<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index($page = 'index') {
        if (!file_exists(APPPATH . 'views/home/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        //Initialize custom menu class
        $this->load->library('MenuLib');

        $data['controller_origin'] = "home";

        $data['menu'] = $this->menulib->getMenuAsArray();

        $this->load->view('templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
}