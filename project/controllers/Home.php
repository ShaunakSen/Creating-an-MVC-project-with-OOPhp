<?php

class Home extends Controller
{
    protected function index()
    {
        $viewmodel = new HomeModel;
        $this->returnView($viewmodel->index(),true);
    }
}

?>