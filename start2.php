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

echo '<br/>';

abstract class Animal{
    public $name;
    public $color;
    public function describe(){
        return $this->name . " is of color: " . $this->color;
    }
    abstract public function makeSound();

}

class Duck extends Animal{
    public function describe(){
        return parent::describe();
    }
    public function makeSound(){
        return 'Quack!';
    }
}

class Dog extends Animal{
    public function describe(){
        return parent::describe();
    }
    public function makeSound(){
        return 'Woof!';
    }
}

$duck = new Duck;
$duck->name="little mini";
echo '<br/>';
$duck->color='white';
echo $duck->describe();
echo '<br/>';
echo $duck->makeSound();
echo '<br/>';














?>