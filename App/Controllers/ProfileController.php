<?php

namespace App\Controllers;
use App\Models\ProfileModel;

class ProfileController{ 

        public $connexion;

        public static function getUser(){

            
            $connexion = ProfileModel::getUser();
            

            $_SESSION ['user_id']= $connexion['id'];
            $_SESSION ['user_name']= $connexion['name'];
            $_SESSION ['user_email']= $connexion['email'];
            $_SESSION ['user_image']= $connexion['image'];
            

            if ($connexion === false) {
                echo 'Aucune donnée recupérer';
            }
          
        }
}
