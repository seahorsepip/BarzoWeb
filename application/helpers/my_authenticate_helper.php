<?php

/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 1-11-2017
 * Time: 02:06
 */

defined('BASEPATH') OR
    exit('No direct script access allowed');


function getToken()
{
    $CI = & get_instance();
    $CI->load->library('session');

    if (!($CI->session->userdata('refresh_before'))) return false;

    if ($CI->session->userdata('refresh_before') < time()) {
        return getRefreshedToken($CI->session->userdata('refresh_token'));
    }
    return $CI->session->userdata('access_token');
}

function clearToken()
{
    $CI = & get_instance();
    $CI->load->library('session');

    $CI->session->unset_userdata('access_token');
    $CI->session->unset_userdata('refresh_token');
    $CI->session->unset_userdata('refresh_before');
    $CI->session->unset_userdata('scope');
    $CI->session->unset_userdata('token_type');
}

function getRefreshedToken($refreshToken) {

    $CI = & get_instance();
    $CI->load->library('session');
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://maatwerk.works/oauth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=refresh_token&refresh_token=" . $refreshToken,
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic " . base64_encode(Login::CLIENT_ID . ':' . Login::CLIENT_SECRET),
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $json = json_decode($response, true);
        if ($json != null) {
            if(isset($json['error'])) {
                return false;
            }
            $CI->session->set_userdata($json);
            $CI->session->set_userdata('refresh_before', time() + $json['expires_in'] - 2000);
            $CI->session->unset_userdata('expires_in');
            return($json['access_token']);
        }
    }
}