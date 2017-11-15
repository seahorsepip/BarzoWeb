<?php

class Pubs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPubs() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            //TODO: Change when in production to production values
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://maatwerk.works/api/bars",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 91c3da4c-7c5a-258f-2c16-bb8bcd836129"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //TODO: Handle error
            //echo "cURL Error #:" . $err;
        } else {
            //http://docs.php.net/json_decode
            return json_decode($response, TRUE);
        }
    }

    public function getPubById($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => "http://maatwerk.works/api/bars/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: a0764d30-3065-9d64-3030-6b5e386eb0aa"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //TODO: Handle error
            //echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }
}
