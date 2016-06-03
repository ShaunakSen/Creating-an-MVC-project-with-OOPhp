<?php

// this is gonna be abstract class. we dont need to initiate it. we are gonna have other controllers extend from it

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