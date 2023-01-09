<?php

namespace App\Models;
use App\Controllers\Connexion;
use PDO;

class ProfileModel{ 

        public $connexion;

        public static function getUser(){

            $connexion = new Connexion ;
            $conn = $connexion->connect();
          
            $user_email = $_SESSION ['user_email'];
            

            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
            $select_profile->execute([$user_email]);

            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                return $fetch_profile;
            }

            return false;
        }
}