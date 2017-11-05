<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pubs extends CI_Controller {

    const CLIENT_ID = 'Bar';
    const CLIENT_SECRET = '8e6ebc1f-26db-4c0d-b773-35155cd3fc5f';
    const SCOPE = 'bar';

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
            show_404();
        }

        if (getToken() != null && !empty(getToken())){
            //Logged in, show create view
            $this->load->library('MenuLib');
            $data['menu'] = $this->menulib->getMenuAsArray();
            $data['controller_origin'] = "pubs";

            if ($this->input->method(TRUE) == 'POST' && isset($_REQUEST)) {
                //TODO: Dit kan sws beter, even checken hoe en wat
                if (empty($this->input->post('bar_name')) || empty($this->input->post('bar_description')) || empty($this->input->post('bar_address')) || empty($this->input->post('bar_zipcode')) || empty($this->input->post('bar_city'))) {
                    $data['warning'] = 'Please fill in every field!';
                } else {
                    $data['error'] = $this->handleCreate();
                }
            }

            $this->load->view('templates/header', $data);
            $this->load->view('pubs/create', $data);
            $this->load->view('templates/footer');
        }else{
            //Not logged in, redirect to login page
            redirect('/login');
        }
    }

    private function handleCreate(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://maatwerk.works/api/bars",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $this->getBody(),
            CURLOPT_HTTPHEADER => $this->getHeaders(),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $this->handleResponse($response);
        }
    }

    private function getHeaders()
    {
        return array(
            "content-type: application/x-www-form-urlencoded",
            "authorization: Bearer " . getToken()
        );
    }

    private function getBase64Client()
    {
        return base64_encode(self::CLIENT_ID . ":" . self::CLIENT_SECRET);
    }

    private function getBody()
    {
        $body = "name=" . $this->input->post('bar_name');
        $body .= "&description=" . $this->input->post('bar_description');
        $body .= "&location=" . $this->input->post('bar_city');
        $body .= "&scope=" . self::SCOPE;
        return $body;
    }

    private function handleResponse($response)
    {
        $json = json_decode($response, true);
        if ($json != null) {
            if(isset($json['error'])) {
                return $json['error'];
            }
            redirect(base_url() . 'pubs');
        }
    }
}