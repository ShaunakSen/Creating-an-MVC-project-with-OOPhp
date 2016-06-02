<?php

class User{

    public function __construct(){
        echo "Contructor called<br/>";
    }

    public function register(){
        echo "User registered";
    }
    public function login($username, $password){
        $this->authUser($username, $password);
    }

    public function authUser($username, $password){
        echo $username . " is authenticated";
    }

    public function __destruct(){
        echo "<br/>Destructor called";
    }
}

$user = new User;
$user->register();
echo "<br/>";
$user->login("shaunak", "littlemini");

?>