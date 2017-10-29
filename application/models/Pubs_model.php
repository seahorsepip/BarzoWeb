<?php

class Pubs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPubs() {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "3000",
            CURLOPT_URL => "http://localhost:3000/api/bars",
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
            return json_decode($response, true);
        }
    }
    //TODO: Fix so that this shit gets pulled from API
    public function getPubById($id){
        //Assume ID == 5 for testing purposes
        if ((int)$id === 4){
            return array(
                4,
                'Karaokebar Ameezing',
                'Liedjes Zinguh! Liedjes Zinguh!',
                'Visserstraat 9',
                '4811 WH',
                'Breda'
            );
        }else if ((int)$id === 5){
            return array(5,
                'De Feestfabriek',
                'PUBBBBBBBBBBBBBBBBB!',
                'Visserstraat 7',
                '4811 WH',
                'Breda'
            );
        }else{
            return array(
                0,
                'Millertime Eindhoven',
                'Het gezelligste café op \'t stratumseind!',
                'Stratumseind 51',
                '5611 EP',
                'Eindhoven'
            );
        }
    }
}