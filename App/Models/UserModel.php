<?php
namespace App\Models;
use App\Controllers\Connexion;


/**
 * 
 */
class UserModel extends Connexion {

    /**
     * $conn
     */
    public $connection;

    public $name;
    public $email;
    public $pass;

    /**
     * verify()
     */
    public function verify($email) {
        $this->email = $email;

        /**
         * 
         */
        $connection = $this->connect();
        /**
         * $request
         */
        $request = "SELECT * FROM `shop_db`.users WHERE email = ?;";
        /**
         * $inst
         */
        $inst = $connection->prepare($request);
        $inst->execute([$this->email]);
        $result = $inst->fetchAll();
        return $result;
    }

    /**
     * insertUser()
     */
    public function insertUser($name, $email, $pass) {

        $connection = $this->connect();

        
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;

        /**
         * $request
         */
        $request = "INSERT INTO `shop_db`.users VALUES(NULL, :name, :email, :pass, 'user', 'default-img.jpg')";
        
        $inst = $connection->prepare($request);
        $inst->execute([
            ":name" => $this->name,
            ":email" => $this->email,
            ":pass" => password_hash($this->pass, PASSWORD_DEFAULT) 
        ]);

    }
}