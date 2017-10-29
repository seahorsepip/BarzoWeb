<?php

class Pubs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPubs() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            //TODO: Change when in production to production values
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
    
    public function getPubById($id){
        //TODO: API implementation
        $json = '{
            "id": "529a096c-57fb-416c-859b-be39aa862472",
            "name": "Feestfabriek Eindhoven",
            "description": "Shots! Shots! Shots!",
            "photos": {
              "profile_image": "https:\/\/res.cloudinary.com\/ixbitz\/image\/upload\/v1509291345\/436ab343a8ea01c7ea0b2c8dbee1bded_y2cntq.jpg",
              "images": [
                "https:\/\/res.cloudinary.com\/ixbitz\/image\/upload\/v1509291345\/436ab343a8ea01c7ea0b2c8dbee1bded_y2cntq.jpg",
                "http:\/\/res.cloudinary.com\/ixbitz\/image\/upload\/v1509290844\/sample.jpg"
              ]
            },
            "location": "Stratumseind 56 5611EP Eindhoven",
            "createdAt": "2017-10-29T13:22:53.823Z",
            "updatedAt": "2017-10-29T13:22:56.237Z"
          }';

        return json_decode($json, true);
    }
}