<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pubs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
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
        $data['pubs'] = $this->Pubs_model->getAllPubs();

        //$token = getToken();
        //$header = "authorization: Bearer " . $token;

        $this->load->view('templates/header', $data);
        $this->load->view('pubs/index', $data);
        $this->load->view('templates/footer');
    }

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

    public function create($page = 'create'){
        if (!file_exists(APPPATH . 'views/pubs/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['controller_origin'] = "pubs";

        if (getToken() != null && !empty(getToken())){
            //Logged in, show create view
            $this->load->library('MenuLib');
            $data['menu'] = $this->menulib->getMenuAsArray();

            $this->load->view('templates/header', $data);
            $this->load->view('pubs/create', $data);
            $this->load->view('templates/footer');
        }else{
            //Not logged in, redirect to login page
            redirect('/login');
        }

    }
}