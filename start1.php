<?php

class User
{

    private $id = 13;
    private $username;
    private $email;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function register()
    {
        echo "User registered";
    }

    public function login($username, $password)
    {

        $this->authUser();
    }

    public function authUser()
    {
        echo $this->username . " with id: " . $this->id . " is authenticated";
    }

    public function __destruct()
    {
        echo "<br/>Destructor called";
    }
}

$user = new User('Mini', 'buddhumini');
$user->register();
echo "<br/>";
$user->login("shaunak", "littlemini");

?>

<br/>
<?php

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

    public function __isset($name){
        echo "Is ".$name.' set?<br/>';
        return isset($this->name);
    }
}

$post = new Post;
$post->name = "Testing";
echo $post->name;
var_dump(isset($post->name));

?>


















