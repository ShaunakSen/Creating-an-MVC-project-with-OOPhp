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
