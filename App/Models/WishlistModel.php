<?php

namespace App\Models;
use App\Controllers\Connexion;
use App\Controllers\CardController;
use PDO;

class WishlistModel extends Connexion {
  

    public $connexion;

   

    public  static function count_wishlist_items() {
        
        $connexion = new Connexion ;
        $conn = $connexion->connect();
       
        session_start();
        
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
         }else{
            $user_id = '';
         };

        
        $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $count_wishlist_items->execute([$user_id]);
        $result = $count_wishlist_items->rowCount();
        
        // print_r($result);
        // exit();
       return $result;
        
    }

    public static function insertWishlist($user_id, $pid, $p_name, $p_price, $p_qty, $p_image){

        $connexion = new Connexion ;
        $conn = $connexion->connect();
        // session_start();
        
        $sql = "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)";
        $insert_cart = $conn->prepare($sql);
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
       
    }

    public  static function check_wishlist_numbers($p_name, $user_id) {
        
        $connexion = new Connexion ;
        $conn = $connexion->connect();
  

        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

       return $check_wishlist_numbers;
        
    }

    public  static function delete_wishlist($p_name, $user_id) {
        
        $connexion = new Connexion ;
        $conn = $connexion->connect();
        session_start();

        $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
        $delete_wishlist->execute([$p_name, $user_id]);

       return $delete_wishlist;
        
    }



   
}



