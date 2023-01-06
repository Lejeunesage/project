<?php
namespace App\Controllers;
use App\Models\UserModel;
use Core\View;

class LoginController {

    /**
     * $usermodel
     */
    public $usermodel;

    public $email;
    public $pass;

    // public function __construct($email, $password) {
    //     $this->email = $email;
    //     $this->password = $password;
    //     $this->usermodel = new UserModel();
    // }

    /**
     * verifyControl()
     */
    public function verifyLoginControl() {
        $this->usermodel = new UserModel();
        $result = $this->usermodel->verify($this->email);
        $count = count($result);

       if($count>0) {
           $pass = password_verify($this->pass, $result[0]["password"]);

           if($pass === true & $result[0]["user_type"] === "admin") {
               header("Location:admin/home?msg=dashboard_admin");
               exit();
            } 

            elseif($pass === true & $result[0]["user_type"] !== "admin") {
                // View::render("home.php");
                header("Location:/route/home");
                exit();
            }

             else {
                // View::render("login.php",
                // [
                //     'message' => [
                //         'message'=> 'password_error',
                //         'email'=> $this->email,
                //     ]
                // ]);
               
               header("Location:/route/login?&email=$this->email");
               exit();
           }
        } 
        else {
            header("Location:/route/login?msg=user_not_found&email=$this->email");
            exit();
        }
    }



    public function macth() {

        if($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST["submit"])) {
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            $this->email = $email;
            $this->pass = $pass;
        
        $this->verifyLoginControl();
        } 
        else {
            header("Location:/login?msg=error");
            exit();
        }
    }


}