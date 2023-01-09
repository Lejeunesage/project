<?php

namespace App\Models;
use App\Controllers\Connexion;
use App\Controllers\CardController;
use PDO;

class CardModel extends Connexion {
  

    public $connexion;

    public  static function check_cart_numbers() {
        
        $connexion = new Connexion ;
        $conn = $connexion->connect();
        session_start();
        
        $infoCard = CardController::infoCard();

        $p_name = $_SESSION['p_name'];

        $user_id = $_SESSION['user_id'];

        $check_cart_numbers = $conn->prepare("SELECT * FROM `shop_db`.cart WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$p_name, $user_id]);

       return $check_cart_numbers;
        
    }

    public static function insert_cart(){

        $connexion = new Connexion ;
        $conn = $connexion->connect();
        session_start();
        
        $infoCard = CardController::infoCard();

        $p_name = $_SESSION['p_name'];

        $user_id = $_SESSION['user_id'];

        $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
       

        return $insert_cart;
    }
}