<?php

namespace App\Controllers;
use App\Models\ProductModel;


class ProductController {

    public $getting;

    public static function getProduct(){

        
        return $getting = ProductModel::getProduct();
        
        echo "<pre>";
        print_r($getting);
        echo "<pre>";
        exit();

        // $_SESSION ['user_id']= $connexion['id'];
        // $_SESSION ['user_name']= $connexion['name'];
        // $_SESSION ['user_email']= $connexion['email'];
        // $_SESSION ['user_image']= $connexion['image'];
        

        if ($getting === false) {
            echo 'Aucune donnée recupérer';
        }
      
    }

}