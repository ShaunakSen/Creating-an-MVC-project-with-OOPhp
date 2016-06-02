Public - Accessible outside of class
Protected - Accessible in class and any extended class
Private - Accessible only in owner class

Inheritance Syntax
Class ChildClass extends ParentClass{

}

To create instance...
$user = new User;
echo $user->firstName;
$user->register();

Abstract Classes:

abstract Class SomeClass{
    abstract public function someFunction(){

    }
}

cannot be instantiated and used directly
must be extended by another class
if property or method is abstract then class also must be abstract


Constructor:
public function __construct(){
        echo "Contructor called";
    }

When the class is instantiated this code will run. We can set up default properties etc

Destructor:
public function __destruct(){
        echo "Destructor called";
    }
This will get called last. So we can use it to close off db connections etc


Default Access Specifier in PHP is public


Getters and Setters

__get and __set are called magic methods

We can access pvt property outside class through get and set methods

class Post
{
    private $name;

    public function __set($name, $value)
    {
        echo "Setting " . $name . ' to <strong>' . $value . '</strong><br/>';
        $this->name = $value;
    }

    public function __get($name){
        echo "Getting " . $name . ' value:  <strong>' . $this->name . '</strong><br/>';
    }
}

$post = new Post;
$post->name = "Testing"; // member has pvt access but class has magic method __set
echo $post->name;  // member has pvt access but class has magic method __get

There is another magic method: __isset

public function __isset($name){
        echo "Is ".$name.' set?<br/>';
        return isset($this->name);
    }

Outside class:
var_dump(isset($post->name));


INHERITANCE:

class First{
    public $id=13;
    protected $name="Mini Sen";
    public function doSomething($msg){
        echo $msg;
    }
}
class Second extends First{
    public function getName(){
        echo $this->name;
    }
}

$second = new Second;
$second->doSomething('blaaah');
$second->getName();

protected vars can be accessed within other classes that inherit from parent class


Static Methods and Properties:

We don't have to use objects to call static members
Syntax:
class::member

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
    echo 'Password is invalid';
}

Static should be used for stuff which are constant


Abstract Class:

Abstract Class is a base class. u cant instantiate them. it is used to have other classes extend from
if u have an abstract method inside a class then that class has to be abstract itself

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

Note the parent keyword

Autoloading classes
Suppose we have 2 files start3_foo.php and start3_bar.php
Now we have start3_index.php

In start3_foo.php
class Foo{
    public function sayHello(){
        echo 'Hello Mini..';
    }
}
In start3_bar.php
class Bar{
}

In start3_index.php

include 'start3_foo.php';
include 'start3_bar.php';

$foo = new Foo;
$bar = new Bar;
$foo->sayHello();

This is OK for 2 or 3 classes.When we want to include 15 20 classes we dont want so many include statements
Here Autoload comes in

spl_autoload_register(function($class_name){
  include $class_name . '.php';
});

Please note it wont work here.. this function tries to include Foo.php and Bar.php bcoz these are
the class names. So we have to change them

final preceding a function means that function cant be overriden by inheritance
Similarly final class_name => this class cant be inherited

eg:
in Bar.php

class Bar extends Foo{
    public function sayHello(){
        echo '<br/>Hi... Mini.. From Bar';
    }
}

sayHello method of Foo will get overriden.
But if
class Foo{
    final public function sayHello(){
        echo 'Hello Mini..';
    }
}

As the method is final it cant be overriden


