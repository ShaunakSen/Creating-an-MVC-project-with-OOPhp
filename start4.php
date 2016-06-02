<?php

class People{
    public $person1 = 'Mini';
    public $person2 = 'Paddy';
    public $person3 = 'Saurav';
    protected $person4 = 'Pappi';
    private $person5 = 'Bhagu';

    public function iterateObject(){
        foreach($this as $key=>$value){
            print "$key => $value ";
        }
    }

}
$people = new People;
$people->iterateObject();
echo '<br/>';
foreach($people as $key=>$value){
    print "$key => $value ";
}

?>