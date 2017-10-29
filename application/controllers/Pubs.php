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

        $data['controller_origin'] = "pubs";

        //Initialize & pass custom menu class
        $this->load->library('MenuLib');
        $data['menu'] = $this->menulib->getMenuAsArray();

        $this->load->model('Pubs_model');
        //TODO: It doesn't like this, fix array maybe?
        $data['pubs'] = $this->Pubs_model->getAllPubs();



        $this->load->view('templates/header', $data);
        $this->load->view('pubs/index', $data);
        $this->load->view('templates/footer');
    }

    //TODO: Needs polishing! Using proper CI techniques
    public function pub($id){
        $data['controller_origin'] = "pubs";

        //Initialize & pass custom menu class
        $this->load->library('MenuLib');
        $data['menu'] = $this->menulib->getMenuAsArray();

        //Load pub by ID
        $this->load->model('Pubs_model');
        $data['pub'] = $this->Pubs_model->getPubById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('pubs/pub', $data);
        $this->load->view('templates/footer');
    }
}