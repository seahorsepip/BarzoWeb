<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    const CLIENT_ID = 'Bar';
    const CLIENT_SECRET = '8e6ebc1f-26db-4c0d-b773-35155cd3fc5f';
    const SCOPE = 'bar';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function index($page = 'index')
    {
        if (!file_exists(APPPATH . 'views/login/' . $page . '.php')) {
            show_404();
        }

        $data['controller_origin'] = "login";

        $this->load->library('MenuLib');
        $data['menu'] = $this->menulib->getMenuAsArray();

        if (!empty($this->input->post('username')) || !empty($this->input->post('password'))) {
            if (!(!empty($this->input->post('username')) && !empty($this->input->post('password')))) {
                $data['warning'] = 'Please fill in a username and password.';
            } else {
                $data['error'] = $this->handleLogin();
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('login/index', $data);
        $this->load->view('templates/footer');
    }

    public function logout(){
        clearToken();
        redirect('/login');
    }

    private function handleLogin()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://maatwerk.works/oauth/token",
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

        return 'why the fuck did it get here';
    }

    private function getHeaders()
    {
        return array(
            "content-type: application/x-www-form-urlencoded",
            "authorization: Basic " . $this->getBase64Client()
            );
    }

    private function getBase64Client()
    {
        return base64_encode(self::CLIENT_ID . ":" . self::CLIENT_SECRET);
    }

    private function getBody()
    {
        $body = 'grant_type=password';
        $body .= "&username=" . $this->input->post('username');
        $body .= "&password=" . $this->input->post('password');
        $body .= "&scope=" . self::SCOPE;
        return $body;
    }

    private function handleResponse($response)
    {
        $json = json_decode($response, true);
        if ($json != null) {
            if(isset($json['error'])) {
                if ($json['error'] === 'invalid_grant') {
                    return 'Incorrect username/password combination.';
                }
                return $json['error'];
            }
            $this->session->set_userdata($json);
            $this->session->set_userdata('refresh_before', time() + $json['expires_in'] - 2000);
            $this->session->unset_userdata('expires_in');
            redirect(base_url() . 'pubs');
        }
    }
}