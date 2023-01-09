<?php

namespace App\Models;
use App\Controllers\Connexion;
use PDO;

class ProductModel extends Connexion {
  

    public $connexion;

    public  static function getProduct() {

        $connexion = new Connexion ;
        $conn = $connexion->connect();

        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products LIMIT 6");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    
        return 'Aucune donnée récupérer';
    }
}


