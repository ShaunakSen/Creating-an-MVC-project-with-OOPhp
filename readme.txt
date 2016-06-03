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
                    return new $this->controller($this->action, $this->request); - A
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

Let us first write all the code.. then we will understand


classes->Controllers.php

<?php

// this is gonna be abstract class. we dont need to initiate it. we are gonna have other controllers
 extend from it

abstract class Controller
{
    // 2 properties..and they will be protected so that other extending classes can access them

    protected $request;
    protected $action;

    public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
    }
    public function extecuteAction(){
        return $this->{$this->action}();
    }

    protected function returnView($viewModel, $fullView){
        $view = 'views/'.get_class($this).'/'.$this->action.'.php';
        if($fullView){
            require('views/main.php');
        }
        else{
            require($view);
        }
    }
}

?>

In index:
if($controller){
    $controller->extecuteAction();
}

Create controller in controllers->Home.php
class Home extends Controller
{
    protected function index()
    {
        echo 'Home/index';
    }
}

Ok so if all goes well, we kno we come to line A in bootstrap.php
Say url : http://localhost/series/MVC/project/

So return new home(index, request..ie GET super global) - B

Also in index.php we have require('controllers/Home.php');
So we do have access to this class


In index we have:
if($controller){
    $controller->extecuteAction();
}

$controller is nothing but an object of class Home as we saw in B

Now this class extends from abstract class Controller

In abstract class Controller, we have

public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
    }

Also in bootstrap.php in line A we are doing
return new Home(index, $_GET);
Since Home extends Controller this constructor is called probably
So in Controller class
$this->action = index;
$this->request = $_GET;

Now in Controller class we have
public function extecuteAction(){
        return $this->{$this->action}();
    }
basically it does return $this->index()

This index function is defined in Home Class


Like we have created abstract class Controller.php we create abstract class Model.php

We want to set up the constants for database parameters in config.php
see config.php

We create models Home,Share and User
We create index function inside Home model. We are not getting anything out of database in Home
class HomeModel{
    public function index(){
        return;
    }
}

Now go to Home controller

protected function index()
    {
        $viewmodel = new HomeModel;
        $this->returnView($viewmodel->index(),true);
    }

Include stuff in index.php


Now we construct other models like Home Model
Share.php:
class ShareModel{
    public function index(){
        return;
    }
}

User.php:
class UserModel{
    public function index(){
        return;
    }
}

In shares controller:

protected function index()
    {
        $viewmodel = new ShareModel;
        $this->returnView($viewmodel->index(),true);
    }


In Users controller we dont need an index

class Users extends Controller
{

}

Now lets work on base model ie Model.php

We complete PDO code here...
see Model.php
Basically we have bind, query, execute and resultSet functions

Now we can make queries

In Shares controller we have already instantiated the Share Model
$viewmodel = new ShareModel;
$this->returnView($viewmodel->index(),true);

In Share  model extend from Model and we have index function defined
In Share Model
public function index(){
        $this->query("SELECT * FROM shares");
        $rows=$this->resultSet();
        print_r($rows);
    }

So when Shares controller calls index function of Share model the data is printed
But we are printing them i the model itself which is not good
So we simply return the data so that the controller can call the view with the data
instead of print_r($rows).. return $rows

Note one thing: In index we generally display data. So in index function of Share Model we
are doing select * from shares

Let us create main.php
views->main.php

Let us set up other views
views
->home
    ->index.php
->shares
    ->add.php
    ->index.php
->users
    ->login.php
    ->register.php

Now in main.php:


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Share Board</title>
</head>
<body>
<?php
require($view);
?>
</body>
</html>

In view share index.php
THIS IS SHARES/INDEX

In view home index.php
THIS IS Home/INDEX


when we go to http://localhost/series/MVC/project/shares what happens?

control goes to function index() of Shares controller
This does:

$viewmodel = new ShareModel;
$this->returnView($viewmodel->index(),true);

$viewmodel->index() is nothing but index function of Share model class
It does:
public function index(){
        $this->query("SELECT * FROM Shares");
        $rows=$this->resultSet();
        return $rows;
    }


It simply returns a row

now this returnView function is written in base controller:

protected function returnView($viewModel, $fullView){
        $view = 'views/'.get_class($this).'/'.$this->action.'.php';
        if($fullView){
            require('views/main.php');
        }
        else{
            require($view);
        }
    }


get_class($this).. $this is object of class Shares so get_class($this)=Shares

$this-> action is index

so $view = 'views/Shares/index.php'

fullView is true so we require main.php

inside main.php we have require $view. So we require inside it 'views/Shares/index.php'

