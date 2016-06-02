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



