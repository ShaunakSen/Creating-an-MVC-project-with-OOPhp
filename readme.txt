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

DATABASES

We are going to build a class which will connect and interact with database

We will be using PDO

Create folder classes
classes
->Database.php

In Database.php:

class Database
{
    private $host = '127.0.0.1';
    private $user = 'root';
    private $password = 'littlemini';
    private $dbname = 'myblog';

    private $dbh; //database handler
    private $error; //error
    private $stmt; // statement

    public function __construct()
    {
        // set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //create new pdo

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password);
            echo 'it works';
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
}

In start5.php

require 'classes/Database.php';
$database = new Database;

Now that we have set up our database conn its time to write some queries

Just under constructor

We create functions.. see Database.php


Now to access the database in start5.php

require 'classes/Database.php';
$database = new Database;

$database->query('SELECT * FROM posts WHERE id = :id');
$database->bind(':id', 1);
$database->bind(':id', 2);
$rows = $database->resultset();
?>
<h2>Posts</h2>

<div>
    <?php foreach ($rows as $row): ?>
        <div>
            <h3>
                <?php echo $row['title']; ?>
            </h3>

            <p>
                <?php echo $row['body']; ?>
            </p>
        </div>

    <?php endforeach; ?>


if we wanted to select all
$database->query('SELECT * FROM posts');
no need of bind method here

In statement: $database->query('SELECT * FROM posts');
query compiles

Then we can use $rows = $database->resultset(); many times without compiling it again and again


To sanitize strings:

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (isset($_POST['submit'])) {
    $title = $post['title'];
    $body = $post['body'];
}

INSERT INTO Db:

if (isset($_POST['submit'])) {
    $title = $post['title'];
    $body = $post['body'];
    $database->query('INSERT INTO posts(title,body) VALUES (:title, :body)');
    $database->bind(':title', $title);
    $database->bind(':body', $body);
    $database->execute();
    if ($database->lastInserId()) {
        echo '<div class="alert  alert-success" role="alert">Ok.. Inserted</div>';
    }
}

Similar for UPDATE and DELETE


Starting with our PROJECT

Create MVC folder structure
in classes->bootstrap.php
This takes in our request and performs actions
eg: say we have users controller and a method in that called register,
base_url/users/register
This should call register method inside users class
For this we have to create our own .htaccess file

Options +FollowSymLinks
RewriteEngine on
RewriteRule ^([a-zA-Z]*)/?([a-zA-Z]*)?/?([a-zA-Z0-9]*)?/?$ index.php?controller=$1&action=$2&id=$3 [NC,L]


What this file does is:
Suppose we have a url as: http://localhost/series/MVC/project/User/register
It will define User to be the controller and register to be the action

In bootstrap.php

class Bootstrap{
    private $controller;
    private $action;
    private $request;

    public function __construct($request){
        $this->request=$request;
        if($this->request['controller']==""){
            //this is root..url is like: http://localhost/series/MVC/project/
            $this->controller="home";
        }
        else{
            $this->controller=$this->request['controller'];
        }

        if($this->request['action']==""){
            $this->action="index";
        }
        else{
            $this->action=$this->request['action'];
        }

        echo $this->controller;
        echo $this->action;
    }
}

For eg if we have http://localhost/series/MVC/project/User/register
$this->controller = User
echo $this->action = register

if url: http://localhost/series/MVC/project/
$this->controller = home
echo $this->action = index


In index.php

//Include Config
require('config.php');
require('classes/bootstrap.php');
$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();


We create method createController in bootstrap.php

public function createController()
    {
        //Check Class

        if (class_exists($this->controller)) {
            $parents = class_parents($this->controller);
            //Check Extend
            if (in_array("Controller", $parents)) {
                if (method_exists($this->controller, $this->action)) {
                    return new $this->controller($this->action, $this->request);
                } else {
                    //Method does not exist
                    echo '<h1>Method Does Not Exist</h1>';
                    return;
                }
            } else {
                echo '<h1>Base Controller Does Not Exist</h1>';
                return;
            }
        } else {
            echo '<h1>Controller Class Does Not Exist</h1>';
            return;
        }
    }

