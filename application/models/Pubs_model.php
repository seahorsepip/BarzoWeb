<?php

class Pubs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPubs() {
        //TODO: Code so this data gets pulled from the API

        //Name, Description, Street, Zipcode, City
        //Kan netter i guess, met een aparte class. Alhoewel CI daar n beetje gay mee doet.
        return array(
            array(
                0,
                'Millertime Eindhoven',
                'Het gezelligste café op \'t stratumseind!',
                'Stratumseind 51',
                '5611 EP',
                'Eindhoven'
            ),
            array(
                1,
                'Karaokebar Ameezing Eindhoven',
                'De beste en enigste karaokebar in Eindhoven!',
                'Stratumseind 62',
                '5611 EP',
                'Eindhoven'
            ),
            array(
                2,
                'Feestfabriek Eindhoven',
                'Shots! Shots! Shots!',
                'Stratumseind 56',
                '5611 EP',
                'Eindhoven'
            ),
            array(
                3,
                'Schrik Millertime Breda',
                'Breda! Breda! Breda!',
                'Visserstraat 12',
                '4811 WJ',
                'Breda'
            ),
            array(
                4,
                'Karaokebar Ameezing',
                'Liedjes Zinguh! Liedjes Zinguh!',
                'Visserstraat 9',
                '4811 WH',
                'Breda'
            ),
            array(5,
                'De Feestfabriek',
                'PUBBBBBBBBBBBBBBBBB!',
                'Visserstraat 7',
                '4811 WH',
                'Breda'
            )
        );
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