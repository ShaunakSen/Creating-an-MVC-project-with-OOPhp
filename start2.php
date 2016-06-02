<?php

class First
{
    public $id = 13;
    protected $name = "Mini Sen";

    public function doSomething($msg)
    {
        echo $msg;
    }
}

class Second extends First
{
    public function getName()
    {
        echo $this->name;
    }
}

$second = new Second;
$second->doSomething('blaaah');
$second->getName();

class User
{
    public static $minPassLength = 5;

    public static function validatePassword($password)
    {
        if(strlen($password) >= self::$minPassLength){
            return true;
        }
        else{
            return false;
        }
    }
}
$password = 'pass';
if(User::validatePassword($password)){
    echo'Password is valid';
}
else{
    echo 'Password  is invalid';
}

?>