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
            $data['controller_origin'] = "pubs/create";

            if ($this->input->method(TRUE) == 'POST' && isset($_REQUEST)) {

                if (empty($this->input->post('bar_name', TRUE)) || empty($this->input->post('bar_description', TRUE)) || empty($this->input->post('bar_address', TRUE)) || empty($this->input->post('bar_zipcode', TRUE)) || empty($this->input->post('bar_city', TRUE))) {
                    $data['warning'] = 'Please fill in every field!';
                } else {

                    //Image handling
                    //TODO: Check if images are uploaded
                    $array = array(
                        "profile_image" => isset($_FILES['bar_profileimage']) ? $this->uploadCloudImage($_FILES['bar_profileimage'])['url'] : "",
                        "images" => array()
                    );

                    //Fix array cuz it's fucked up otherwise
                    if (isset($_FILES['bar_images'])){
                        $images = $this->fixFuckingArray($_FILES['bar_images']);

                        foreach ($images as $key => $image) {
                            array_push($array['images'], $this->uploadCloudImage($image)['url']);
                        }
                    }

                    //echo json_encode($array, JSON_UNESCAPED_SLASHES);
                    $data['error'] = $this->handleCreate($array);
                    redirect(base_url() . 'pubs');

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

    private function handleCreate($photos){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:3000/api/bars",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($this->getBody($photos)),
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

    private function getBody($photos)
    {
        /*$body = "name=" . $this->input->post('bar_name');
        $body .= "&description=" . $this->input->post('bar_description');
        $body .= "&location=" . $this->input->post('bar_address') . " " . $this->input->post('bar_zipcode') . " " . $this->input->post('bar_city');
        //$body .= "&photos=" . $photos;
        $body .= "&scope=" . self::SCOPE;*/

        $body = array(
            'name' => $this->input->post('bar_name', TRUE),
            'description' => $this->input->post('bar_description', TRUE),
            'city' => $this->input->post('bar_city', TRUE),
            'zipcode' => $this->input->post('bar_zipcode', TRUE),
            'address' => $this->input->post('bar_address', TRUE),
            'photos' => json_encode($photos, JSON_UNESCAPED_SLASHES),
            'scope' => self::SCOPE
        );
        return $body;
    }

    private function handleResponse($response)
    {
        $json = json_decode($response, true);
        if ($json != null) {
            if(isset($json['error'])) {
                return $json;
            }
            redirect(base_url() . 'pubs');
        }
    }

    private function uploadCloudImage($file){
        set_time_limit(60);
        require_once APPPATH . 'libraries/Cloudinary.php';
        require_once APPPATH . 'libraries/Uploader.php';
        require_once APPPATH . 'libraries/Api.php';

        \Cloudinary::config(array(
            "cloud_name" => "ixbitz",
            "api_key" => "293537726683591",
            "api_secret" => "bwzH6FrhaUq2kCHpbbPoxZr0IE8"
        ));
        $uploaded_file = \Cloudinary\Uploader::upload($file["tmp_name"]);

        return $uploaded_file;
    }

    private function fixFuckingArray($bar_image){
        $imagesarray = array();
        //Check if images are uploaded, and whether they produced an error
        if(count($bar_image['name']) > 0) {
            //Loop through each file
            for ($i = 0; $i < count($bar_image['name']); $i++) {
                if ($bar_image['error'][$i] == 0) {
                    //All gucci
                    $name = $bar_image['name'][$i];
                    $type = $bar_image['type'][$i];
                    $tmp_name = $bar_image['tmp_name'][$i];
                    $error = $bar_image['error'][$i];
                    $size = $bar_image['size'][$i];

                    $imgarray = array(
                        'name' => $name,
                        'type' => $type,
                        'tmp_name' => $tmp_name,
                        'error' => $error,
                        'size' => $size
                    );
                    array_push($imagesarray, $imgarray);
                }

            }
        }
        return $imagesarray;
    }
}