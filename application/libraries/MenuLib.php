<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuLib {

    public function getMenuAsArray()
    {
        return array(
            'home' => 'Home',
            'pubs' => 'Pubs/Bars',
            'pubs/create' => 'Create Bar',
            'quiz' => 'Quiz',
            'contact' => 'Contact',
            'login' => 'Log in',
            'logout' => 'Log Out'
        );
    }
}