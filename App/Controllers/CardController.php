<?php
namespace  App\Controllers;
use  App\Models\CardModel;

/**
 * 
 */
class CardController {

    /**
     * $conn
     */
    public $connexion;
    public $pid;
    public $p_name;
    public $p_image;
    public $p_qty;


    public static function infoCard(){
        session_start();

        if(isset($_POST['add_to_cart'])){

            $user_id = $_SESSION['user_id'];
            if(!isset($user_id)){
                  header('location:/login');
            }
         
            $pid = htmlspecialchars($_POST['pid']);
            $p_name = htmlspecialchars($_POST['p_name']);
            $p_price = htmlspecialchars($_POST['p_price']);
            $p_image = htmlspecialchars($_POST['p_image']);
            $p_qty = htmlspecialchars($_POST['p_qty']);


            $_SESSION['pid'] =  $pid;
            $_SESSION['p_name'] =  $p_name;
            $_SESSION['p_price'] =  $p_price;
            $_SESSION['_image'] =  $p_image;
            $_SESSION['p_qty'] =  $p_qty;

            header('location:/');
        }

    }




   

    public static function addToCard (){

        $addToCard = CardModel::insert_cart();
        return $addToCard;

    }


    public function returnAll() {
       $count= count($this->ray->selectAll());
       if($count>0) {
        return $this->ray->selectAll();
       } else {
        return false;
       }
    }

    public function returnDistinct() {
       $count= count($this->ray->selectDistinct());
       if($count>0) {
        return $this->ray->selectDistinct();
       } else {
        return false;
       }
    }

}

?>